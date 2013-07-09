<?php
namespace Transfer\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of AgendaType
 *
 * @author adarr
 */
class AgendaType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('agenda_options'));
    }
    
    public function buildView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options) {
        parent::buildView($view, $form, $options);
        
        $var = $form;
        
        $j =1+2;
        
        $i = $j+4;
       
        
        /*
        
        if(array_key_exists('agenda_options', $options)){
            $data = $form->getData(); // récup de l'object associé au formulaire
            $agendaOpt = $options['agenda_options'];
            if(     array_key_exists('collection_name',$agendaOpt) 
                    && array_key_exists('selectable_attr', $options['agenda_options']))
            {
                $getCollectionAgenda = $agendaOpt['collection_name'];
                $collectionAgenda = $data->$getCollectionAgenda();
                
                $getSelectableAttr = $agendaOpt['selectable_attr'];
                $collectionAgenda->$getSelectableAttr();            
                $chkboxArray = array();
                
                foreach($date->$getCollectionAgenda as $entityAgenda){
                    $chkboxArray[]=array('label'=>'','entity_id','')
                }
          }
                    
            }*/         
       
    }

    public function getParent()
    {
        return 'entities';
    }

    public function getName()
    {
        return 'agenda';
    }    
    
    
}

?>
