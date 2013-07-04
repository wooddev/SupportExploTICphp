<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Generateurs\CreneauPrefGen;
use Transfer\ReservationBundle\Form\CreneauPrefGenType;

/**
 * CreneauPref controller
 *
 */
class CreneauPrefController extends Controller
{
         /**
     * Displays a form to generate CreneauRdv.
     *
     */
    public function generateAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $generateur = new CreneauPrefGen();
        
        $generateur->setEtatReservation($em->getRepository('TransferReservationBundle:EtatReservation')
                                        ->findByNom('A réserver'));
        $generateur->setStatut($em->getRepository('TransferReservationBundle:StatutCreneau')
                                        ->findByNom('Actif'));        
                
        $form   = $this->createForm(new CreneauPrefGenType(), $generateur);

        return $this->render('TransferReservationBundle:CreneauPref:generate.html.twig', array(
            'generateur' => $generateur,
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
           

            $creneauxModeles = $em->getRepository('TransferReservationBundle:CreneauModele')->findAll();
            
            $generateur->setCreneauxModeles($creneauxModeles);
            
            $generateur->generateCreneauxRdvs(); 
            
            foreach ($generateur->getCreneauxRdvs() as $creneauRdv){
                $em->persist($creneauRdv);
            }        
            $em->flush();  
        }
       
        return $this->render('TransferReservationBundle:CreneauRdv:index.html.twig', array(
            'entities'      => $generateur->getCreneauxRdvs()
        ));
    }
}
