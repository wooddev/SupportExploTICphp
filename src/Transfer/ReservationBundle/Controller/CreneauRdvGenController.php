<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\CreneauModele;
use Transfer\ReservationBundle\Entity\CreneauRdv;
use Transfer\ReservationBundle\Generateurs\CreneauRdvGen;
use Transfer\ReservationBundle\Form\CreneauRdvGenType;


/**
 * CreneauRdvGen controller.
 *
 */
class CreneauRdvGenController extends Controller
{
     /**
     * Displays a form to generate CreneauRdv.
     *
     */
    public function generateAction()
    {
        
        $generateurRdv = new CreneauRdvGen();
        $generateurRdv->setWeek(date('W'));
        $generateurRdv->setYear(date('Y'));
        
                
        $form   = $this->createForm(new CreneauRdvGenType(), $generateurRdv);

        return $this->render('TransferReservationBundle:CreneauRdv:generate.html.twig', array(
            'generateurRdv' => $generateurRdv,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Creates a new CreneauRdv Collection
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        
//        Version sans formulaire, à partir du constructeur modifié
//        $posteAutonome = $em->getRepository('TransferReservationBundle:TypePoste')->find(1);
//        $generateur  = new CreneauModeleGen(6,0, 0, 19, 20,$posteAutonome->getDisponibilite() , $posteAutonome);                
// 
        
        
        $generateur = new CreneauRdvGen();
        $form = $this->createForm(new CreneauRdvGenType(), $generateur);
        $form->bind($request);        
        
        if ($form->isValid()){            
           
            $statutActif = $em->getRepository('TransferReservationBundle:StatutCreneau')->findOneByNom('Actif');
            $creneauxModeles = $em->getRepository('TransferReservationBundle:CreneauModele')->findAll();
            
            $generateur->setCreneauxModeles($creneauxModeles);
            $generateur->setStatut($statutActif);
            
            $generateur->generateCreneauxRdvs(); 
            $persistCollection = new \Doctrine\Common\Collections\ArrayCollection();
            foreach ($generateur->getCreneauxRdvs() as $creneauRdv){
                if(!$em->getRepository('TransferReservationBundle:CreneauRdv')->testExist($creneauRdv)){
                    $persistCollection->add($creneauRdv);
                    $em->persist($creneauRdv);
                }
            }            
            $em->flush();  
            if(!$persistCollection->isEmpty()){
                $this->get('transfer_reservation.reservation')->fixDisponibilites($persistCollection,array('persist'=>true));
            }            
        }
       
        return $this->redirect($this->generateUrl('planning_semaine', array(
            'year' => $generateur->getYear(),
            'week'=> $generateur->getWeek(),
            )));

    }    
    
}
