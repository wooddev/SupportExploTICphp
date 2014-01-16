<?php

namespace Explotic\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * ExploticAdminController controller.
 *
 */
class ExploticAdminController extends Controller {
    //put your code here
    
    
    public function receiveStagiaireFileAction(){
        
        if(!$this->get('security.context')->isGranted('ROLE_ADMIN')){
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('Vous ne possédez pas les droits !');
        }
        
        $form = $this
                    ->createFormBuilder()
                    ->add('submitFile','file',array('label'=>'Fichier d\'import'))
                    ->getForm();
        
        
        return $this->render('ExploticAdminBundle:Import:receiveStagiaireFile.html.twig',array(
            'form'=> $form->createView(),
        ));
    }
    
    
    public function importStagiaireAction(Request $request){
        if(!$this->get('security.context')->isGranted('ROLE_ADMIN')){
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('Vous ne possédez pas les droits !');
        }
        $form = $this
                    ->createFormBuilder()
                    ->add('submitFile','file',array('label'=>'Fichier d\'import'))
                    ->getForm();
        
        $form->bind($request);
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $file = $form->get('submitFile')->getData();
            $name = 'stagiaire_'.date('YmdHms');
            $file->move('uploads/imports',$name);
            
            $csv = fopen('uploads/imports/'.$name,'r');
            $stagiaires=array();
            while(($data = fgetcsv($csv,0,';',"'"))!= false){
                
                $stagiaireTest1 = $em->getRepository('ExploticTiersBundle:Stagiaire')
                        ->findOneBy(array(
                            'username' => $data[13]
                        ));
                $stagiaireTest2 = $em->getRepository('ExploticTiersBundle:Stagiaire')
                        ->findOneBy(array(
                            'firstname'=>$data[17],
                            'lastname'=>$data[18],
                        ));
                
                if(!$stagiaireTest1 && !$stagiaireTest2){// Si aucun stagiaire identique trouvé dans la base                  
                    $entreprise = $em->getRepository('ExploticTiersBundle:Entreprise')->findOneBy(array('raisonSociale'=>$data[0]));
                    if(!$entreprise){
                        $entreprise = new \Explotic\TiersBundle\Entity\Entreprise();
                        $entreprise->setRaisonSociale($data[0]);
                        $entreprise->setSiret($data[1]);
                        $entreprise->setApe($data[2]);
                        $entreprise->setCnil($data[3]);
                        $entreprise->setVersionExplotic($data[4]);
                        $entreprise->setCommentaires($data[5]);
                        $entreprise->setDonneurOrdre($data[6]);
                        $bureau = new \Explotic\TiersBundle\Entity\Bureau();
                        $bureau->setAdresseNumero($data[7]);
                        $bureau->setAdresseRue($data[8]);
                        $localisation = new \Explotic\TiersBundle\Entity\Localisation();
                        $localisation->setCommune($data[9]);
                        $localisation->setCp($data[10]);
                        $geom = new \Explotic\TiersBundle\Entity\Geometry();
                        $geom->setLat($data[11]);
                        $geom->setLon($data[12]);
                        $localisation->setGeometry($geom);
                        $bureau->setLocalisation($localisation);  
                        $bureau->setEntreprise($entreprise);                        
                        $entreprise->setBureau($bureau);   
                        $em->persist($entreprise);
                        $em->persist($geom);                        
                        $em->persist($localisation);
                        $em->persist($bureau);
                        $em->flush();
                        
                    }// end if création entreprise

                    $userManager = $this->get('fos_user.user_manager');                   
                    
                    $stagiaire = $userManager->createStagiaire();
                    $stagiaire->setEntreprise($entreprise);
                    $stagiaire->setUsername($data[13]);
                    $stagiaire->setEmail($data[14]);
                    $stagiaire->setPlainPassword($data[15]);
                    $stagiaire->setDateOfBirth(new \DateTime($data[16]));
                    $stagiaire->setFirstname($data[17]);
                    $stagiaire->setLastname($data[18]);
                    $stagiaire->setPhone($data[19]);
                    $stagiaire->setGerant($data[20]);
                    $stagiaire->setTypeEmploi($data[21]);
                    $stagiaire->setOpca($data[22]);
                    $stagiaire->setNiveauInfo($data[23]);
                    $stagiaire->setMarchePiedInfo($data[24]);
                    for($i=25; $i<=27; $i++){
                        $module = $em->getRepository('ExploticFormationBundle:Module')->findOneByReference($data[$i]);

                        if ($module){
                            $prog = new \Explotic\FormationBundle\Entity\Programme();
                            $prog->setAccompagnement('nonRealise');
                            $prog->setFormationSalle('nonRealise');
                            $prog->setModule($module);
                            $prog->setStagiaire($stagiaire);
                            $em->persist($prog);
                        }
                    }
                    $stagiaire->setNumDevis($data[28]);
                    $stagiaire->setDateDevis(new \DateTime($data[29]));                                   

                    $userManager->updateUser($stagiaire);
                    $em->persist($stagiaire);
                    
                    $em->flush();     
                    
                    $stagiaires[]= clone $stagiaire;                            
                }
            }         
            return   $this->render('ExploticAdminBundle:Import:importedStagiaires.html.twig',array(
                            'stagiaires'=> $stagiaires,
                            ));         
        }
        
        return   $this->render('ExploticAdminBundle:Import:echec.html.twig');

    }
    
    
}

?>
