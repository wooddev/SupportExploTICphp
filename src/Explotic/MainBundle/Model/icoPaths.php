<?php
namespace Explotic\MainBundle\Model;


class icoPaths {
    private $paths,
            $container;
    
    
    
    public function __construct($sallePath,$postePath, $bureauPath, \Symfony\Component\DependencyInjection\Container $container) {
        $this->container = $container; 
        $this->paths = array(
            'salle'=>  $this->container->get('templating.helper.assets')->getUrl($sallePath),
            'poste'=>  $this->container->get('templating.helper.assets')->getUrl($postePath),
            'bureau'=> $this->container->get('templating.helper.assets')->getUrl($bureauPath),
        );
    }
    
    public function getPaths() {
        return $this->paths;
    }


}
?>
