<?php
namespace Transfer\MainBundle\Model;
use Transfer\MainBundle\Model\AgendaCreneau;
use Doctrine\Common\Collections\Criteria;
/**
 * Description of AgendaDay
 *
 * @author adrien
 */
class AgendaDay{
    private $creneaux; // AgendaCreneau
    private $val;
    private $textVal;
    private $date;
    private $minuteDebut;
    private $minuteFin;
    private $dateTimeDebut;
    private $dateTimeFin;
    
    
    /**
     * 
     * @param type $creneaux // agendaCreneau
     */
    public function setCreneaux($creneaux) {
        $this->creneaux = $creneaux;
    }

    public function setDateTimeDebut() {           
        $this->dateTimeDebut= clone $this->date;
        $this->dateTimeDebut->setTime(floor($this->minuteDebut/60), 
                                      $this->minuteDebut-(floor($this->minuteDebut/60)*60),
                                      0);
        $this->setTextVal();
    }

    public function setDateTimeFin() {
        $this->dateTimeFin= clone $this->date;
        $this->dateTimeFin->setTime(floor($this->minuteFin/60), 
                                      $this->minuteFin-(floor($this->minuteFin/60)*60),
                                      0);
    }
    
    
    public function __construct(){         
        $this->creneaux = new \Doctrine\Common\Collections\ArrayCollection();
    }   
    
    public function getDateTimeDebut() {
        return $this->dateTimeDebut;        
    }

    public function getDateTimeFin() {
        return $this->dateTimeFin;
        
    }
    
    public function getMinuteDebut() {
        return $this->minuteDebut;
    }

    public function setMinuteDebut($minuteDebut) {
        $this->minuteDebut = $minuteDebut;
    }

    public function getMinuteFin() {
        return $this->minuteFin;
    }

    public function setMinuteFin($minuteFin) {
        $this->minuteFin = $minuteFin;
        
    }
    
    public function getCreneaux(){
        return $this->creneaux;
    }
    public function addCreneau($var){
        $this->creneaux->add($var);
        return $this;
    }   
    
    public function getVal(){
        return $this->val;
    }
    public function setVal($var){
        $this->val = $var;
        return $this;
    }
    public function getTextVal() {
        return $this->textVal;
    }

    public function setTextVal() {
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $this->textVal = strftime('%A',$this->getDateTimeDebut()->getTimestamp());
    }

        
    public function getDate(){
        return $this->date;
    }
    public function setDate($var){
        $this->date = $var;
        return $this;
    }
    /**
     * Génére une journée d'Agenda sur la base des créneaux passés en paramètres
     * Les créneaux de structure doivent etre ordonnées par dates croissantes
     * 
     * @param type $j
     * @param type $year
     * @param type $s
     * @param type $creneauxStructureJour
     * @param type $creneauxAffichesJour
     */
    public function init($j,$year,$s,$creneauxStructureJour, $creneauxAffichesJour){
        
        $this->setVal($j);// Création d'un jour d'agenda portant le numéro $s
        $this->setDate(new \DateTime());
        $this->getDate()->setISODate($year,$s,$j);
        
        $this->setDateTimeDebut();
        $this->setDateTimeFin();
        
        if(null===$creneauxStructureJour){
            $this->addCreneau(new AgendaCreneau(null,
                                        $this->getDateTimeDebut(),
                                        $this->getDateTimeFin(),
                                        'vide'));
        }
        elseif($creneauxStructureJour->count()==0){
            $this->addCreneau(new AgendaCreneau(null,
                                        $this->getDateTimeDebut(),
                                        $this->getDateTimeFin(),
                                        'vide'));
        }
        else{      
        
            //########Récupération des créneaux de structure dans l'agenda############
            //création d'un premier créneau vide
            if(!(null==$this->minuteDebut)){
                $this->addCreneau(new AgendaCreneau(null,
                                            $this->getDateTimeDebut(),
                                            $creneauxStructureJour->first()->getHeureDebut(),
                                            'vide'));
            }
            // Parcours des créneaux de la collection
            foreach ($creneauxStructureJour as $creneau){
                //Si le créneau en cours ne suit pas directement le créneau précédent
                //cad encours(heure de début) != précédent(heure de fin)
                //==> création d'un créneau vide
                if($this->getCreneaux()->last()->getDateTimeFin()!=$creneau->getHeureDebut()){
                    $this->addCreneau(new AgendaCreneau(null,
                                                $this->getCreneaux()->last()->getDateTimeFin(),
                                                $creneau->getHeureDebut(),
                                                'vide'));               
                }
                //Création et ajout d'une instance de creneauAgenda sur le modèle du créneau en cours
                $this->addCreneau(new AgendaCreneau($creneau,                                    
                                            $creneau->getHeureDebut(),
                                            $creneau->getHeureFin(),
                                            'structure'));
            }
            // création du dernier créneau vide
            if(!(null==$this->minuteFin)){
                $this->addCreneau(new AgendaCreneau(null,
                                            $this->getCreneaux()->last()->getDateTimeFin(),
                                            $this->getDateTimeFin(),                                    
                                            'vide'));
            }

            //########Récupération des créneaux affichés pour l'utilisateur dans l'agenda############
            // Parcours des créneaux de la collection
            foreach ($creneauxAffichesJour as $creneau){
                //Recherche du creneauAgenda associé et modification 
                //(on exploite le lien entre les classes de creneau)
                $creneauModeleCrit = Criteria::create()
                                    ->where(Criteria::expr()->eq("creneauStructure",$creneau->getCreneauStructure()));          

                if(($key = $this->getCreneaux()->matching($creneauModeleCrit)->key())){
                    $this->getCreneaux()->get($key)->AddCreneauAffiche($creneau);
                    $this->getCreneaux()->get($key)->setType('affiche');
                }
            }
        }
    }    
   
    
}

?>
