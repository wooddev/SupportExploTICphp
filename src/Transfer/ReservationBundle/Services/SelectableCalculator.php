<?php
namespace Transfer\ReservationBundle\Services;

use Doctrine\Common\Collections\Criteria;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SelectableCalculator
 *
 * @author Adrien Arraiolos
 */
class SelectableCalculator {
    //put your code here
    
    public function calculate(\Transfer\MainBundle\Model\Agenda $agenda, \Transfer\ReservationBundle\Entity\TypeCamion $typeCamion){        
        foreach ($agenda->getAgendasYear() as $agendaYear){
            foreach($agendaYear->getAgendasWeek() as $agendaWeek){
                foreach($agendaWeek->getAgendasDay() as $agendaDay){
                    foreach($agendaDay->getCreneaux() as $creneau){
                        //$creneau = new \Transfer\MainBundle\Model\AgendaCreneau($creneauStructure, $creneauAffiche, $dateTimeDebut, $dateTimeFin, $type);
                        if($creneau->getType() <>'vide'){
                            $creneauModele = $creneau->getCreneauStructure();

                            //$creneauModele = new \Transfer\ReservationBundle\Entity\CreneauModele();

                            $dispoTotale = $creneauModele->getDisponibiliteTotale();

                            $criteria = Criteria::create()
                                            ->where(Criteria::expr()->eq("typeCamion",$typeCamion));         

                            $dispoCamion = $creneauModele->getDisponibilites()->matching($criteria)->first();

                            if ($dispoTotale>0  && $dispoCamion->getValeur() >0){
                                $creneau->setType('selectable');
                            }else{
                                $creneau->setType('unselectable');
                            }  
                        }
                    }
                }
            }
        }
        
        
        
    }
    
    
    
}

?>
