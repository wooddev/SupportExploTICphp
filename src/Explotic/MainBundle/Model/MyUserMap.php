<?php
namespace Explotic\MainBundle\Model;
/**
 * Description of myUserMap
 *
 * @author arraiolosa
 */

class MyUserMap {
    //put your code here
    private $user;
    private $map;
    private $markersCollections;
    private $profils;
    
    /**
     * Constructeur de la classe
     * 
     * @param $map (Ivory map service), $user (fos user service)
     * 
     */
    
    
    public function __construct($map,$user)
    {
        $this->map = $map;
        $this->user= $user;
        $this->profils  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->markersCollections  = new \Doctrine\Common\Collections\ArrayCollection(); // of Markers
        return $this;
    }
    
   /**
    * 
    * generate Markers --> Récupère les markers à partir des profils enregistrés
    *  
    * 
    */
    
    private function generateMarkers()
    {
        foreach($this->profils as $profil){
            $this->markersCollections->add($profil->getMyMarkers()); // Récupérations des objet "Markers" pour chaque profil
        }
    }
    
    /**
     * Add Profil
     * Ajoute le profil donné à la collection des profils
     * 
     * @param $profil (class de type stagaiire, entreprise, formateur, recruteur
     * @return $this   
     */
        
    public function addProfil($profil)
    {
        $this->profils->Add($profil);
        return $this;
    }
            
    
    /**
     * add MarkersToGmaps
     * 
     * Transforme la collection de Markers en gmapsMarkers (service Ivory)
     * Assigne les gmapsMarkers à $this->map
     * 
     *  
     */
    
    
    public function addMarkersToGMaps(){
        $gMapsMarkers = new \Doctrine\Common\Collections\ArrayCollection();      
        if($this->profils->count()>0){        
            $this->generateMarkers();
            foreach($this->markersCollections as $markers)
            {        
                foreach($markers->getMarkers() as $key=>$marker){

                    $gMapsMarkers->add(new \Ivory\GoogleMap\Overlays\Marker());

                    $gMapsMarkers->last()->setPosition($marker->getLat(),$marker->getLon());
                    $gMapsMarkers->last()->setIcon($marker->getIcoPath());
                    $gMapsMarkers->last()->setInfoWindow(new \Ivory\GoogleMap\Overlays\InfoWindow());
                    $gMapsMarkers->last()->getInfoWindow()
                                                    ->setContent('<h3>'.$marker->getLabel().'</h3><br><p>'.$marker->getComment().'</p>');   
                                        
                    $this->map->AddMarker($gMapsMarkers->last());
                }
            }
        }
    }
    
    public function getMap(){
        return $this->map;
    }
    
    
    
}

?>
