<?php
namespace Transfer\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParamReservationAdmin
 *
 * @author adarr
 */

class ParamReservationAdmin extends Admin {

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('parametres','array',array(
                'required'=>false,
                'keys'=>array(
                    array(
                        'DisponibiliteTotale','integer',array(
                            'required'=>true,
                            'label'=> 'Nombre max de camion par poste'
                            )),
                    array('DisponibiliteFondMouvant','integer',array(
                            'required'=>true,
                            'label'=>'Nombre max de camion à fond mouvant par poste'
                            )),
                    array('DisponibiliteAutresTypes','integer',array(
                            'required'=>true,
                            'label'=>'Nombre max de camion non autonomes par poste'
                            )),                        
                    array('IntervalVidangeProvisoires','string',array(
                            'required'=>true,
                            'label'=>'Délai d\'annulation des réservation provisoires'
                            )),                        
                    array('DebutVidangeInact','text',array(
                            'required'=>true,
                            'label'=>'Début d\'inactivation des annulations automatiques des réservation provisoires'
                            )),                        
                    array('FinVidangeInact','text',array(
                            'required'=>true,
                            'label'=>'Fin d\'inactivation des annulations automatiques des réservation provisoires'
                            )),                        
                    array('DebutReservations','text',array(
                            'required'=>true,
                            'label'=>'Date de lancement des réservations de la semaine'
                            )),                        
                    array('IntervalleRecherche','text',array(
                            'required'=>true,
                            'label'=>'Amplitude horaire de recherche de créneaux'
                            )),                        
                        )
                    )
                )    
            ;
    }
     /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
//        $filterMapper
//            ->add('nom')
//            ->add('quota')
//            ->add('priorite')                
//        ;
    }
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('parametres','sonata_type_immutable_array',array(
                'required'=>false,
                'keys'=>array(
                    array(
                        'DisponibiliteTotale','integer',array(
                            'required'=>true,
                            'label'=> 'Nombre max de camion par poste'
                            )),
                    array('DisponibiliteFondMouvant','integer',array(
                            'required'=>true,
                            'label'=>'Nombre max de camion à fond mouvant par poste'
                            )),
                    array('DisponibiliteAutresTypes','integer',array(
                            'required'=>true,
                            'label'=>'Nombre max de camion non autonomes par poste'
                            )),                        
                    array('IntervalVidangeProvisoires','text',array(
                            'required'=>true,
                            'label'=>'Délai d\'annulation des réservation provisoires'
                            )),                        
                    array('DebutVidangeInact','text',array(
                            'required'=>true,
                            'label'=>'Début d\'inactivation des annulations automatiques des réservation provisoires'
                            )),                        
                    array('FinVidangeInact','text',array(
                            'required'=>true,
                            'label'=>'Fin d\'inactivation des annulations automatiques des réservation provisoires'
                            )),                        
                    array('DebutReservations','text',array(
                            'required'=>true,
                            'label'=>'Date de lancement des réservations de la semaine'
                            )),                        
                    array('IntervalleRecherche','text',array(
                            'required'=>true,
                            'label'=>'Amplitude horaire de recherche de créneaux'
                            )),                      
                        )
                    )
                )            
        ;
    }
 
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')            
            ->add('parametres','array',array(
                'required'=>false,
                'keys'=>array(
                    array(
                        'DisponibiliteTotale','integer',array(
                            'required'=>true,
                            'label'=> 'Nombre max de camion par poste'
                            )),
                    array('DisponibiliteFondMouvant','integer',array(
                            'required'=>true,
                            'label'=>'Nombre max de camion à fond mouvant par poste'
                            )),
                    array('DisponibiliteAutresTypes','integer',array(
                            'required'=>true,
                            'label'=>'Nombre max de camion non autonomes par poste'
                            )),                        
                        )
                    )
                )    
            ->add('_action', 'actions', array(
                 'actions' => array(
                     'view' => array(),
                     'edit' => array())))
        ;
    }
}

?>
