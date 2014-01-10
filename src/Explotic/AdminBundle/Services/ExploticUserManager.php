<?php
namespace Explotic\AdminBundle\Services;
 

use FOS\UserBundle\Entity\UserManager;
use Explotic\TiersBundle\Entity\Stagiaire;

/**
 * Description of UserManager
 *
 * @author adrien
 */
class ExploticUserManager extends UserManager{
    //put your code here
    
    public function createStagiaire(){
        $user = new Stagiaire();
        return $user;
    }
}

?>
