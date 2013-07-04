<?php
namespace Transfer\MainBundle\Model;

use \Doctrine\Common\Collections\ArrayCollection;


/**
 * Description of objectCollectionCreator
 *
 * @author adarr
 */
class objectCollectionCreator {
    private $className;
    private $commonAttributes;
    private $specificAttributes;
    private $objectsCollection;
    
    public function init($className,$commonAttributes, $specificAttributes){
        $this->className = $className;
        $this->commonAttributes = $commonAttributes;
        $this->specificAttributes = $specificAttributes;
        $this->objectsCollection = new ArrayCollection();
    }
    
    public function createCollection() {
        
        $this->objectsCollection->add(new $this->className());
        foreach($this->commonAttributes as $attribute=>$value){
            $setter = set.ucfirst($attribute);
            $this->objectsCollection->last()->$setter($value);
        }
        
    }
        
    
    
}

?>
