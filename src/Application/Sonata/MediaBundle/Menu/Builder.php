<?php

namespace Application\Sonata\MediaBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array(
            'class'=>'nav',
        ));
        
        $galleries = new ArrayCollection($this->container->get('application.gallery_access')->getAuthorizedGalleries());
        
        $criteria  = Criteria::create()->where(Criteria::expr()->isNull('parent')); 
        
        $masterGalleries = $galleries->matching($criteria);

        $i=0;
        foreach($masterGalleries as $masterGallery){
            
            $menu->addChild($masterGallery->getName(),array(
                'uri'=>'#',
                'extras'=>array('safe_label'=>'true')
                )
            );    
            
            $subMenu = $menu[$masterGallery->getName()];
            
            $subMenu->setLabel($masterGallery->getName().'<b class="caret"></b>');
            $subMenu->setAttributes(array(
                        'class'=>'dropdown'
            ));
            $subMenu->setLinkAttributes(array(
                        'data-toggle'=>'dropdown',
                        'class'=>'dropdown-toggle',
            ));
            $subMenu->setChildrenAttributes(array(
                        'class'=>'dropdown-menu',
            ));
            $this->addChildrenGalleriesSubMenus($subMenu, $masterGallery,$i);
            $this->addMediasSubMenus($subMenu, $masterGallery);                    
        }
        
        
        

        
//        $menu->addChild('Gallerie1', array('route' => '#'));
//        $menu->addChild('Gallerie2', array(
//            'route' => '#',
//            'routeParameters' => array('id' => 42)
//        ));
        // ... add more children
        
        return $menu;
    }
    
    
    public function addMediasSubMenus($menu,$gallery){
        foreach($gallery->getGalleryHasMedias() as $childMedia){ 
            $menu->addChild($childMedia->getMedia()->getName(),array(
                'route'=>'my_media_show',
                'routeParameters'=>array(
                    'id'=>$childMedia->getMedia()->getId(),
                    'galId'=>$gallery->getId(),
                    ),
                'extras'=>array('safe_label'=>'true'))/*,array('route'=>'#')*/);
            $menu[$childMedia->getMedia()->getName()]->setLabel('<i class="icon-file"></i>'.$childMedia->getMedia()->getName());
        }
        return $menu;
    }
    
    public function addChildrenGalleriesSubMenus(\Knp\Menu\MenuItem $menu,$gallery,$i){

        foreach($gallery->getChildren() as $childGallery){
            if($i >5){return $menu;} //On s'arrete à 3 niveaux de menus  
            $menu->addChild($childGallery->getName(),array(
                'route'=>'my_gallery_show',
                'routeParameters'=>array(
                    'id'=>$childGallery->getId()),
                'extras'=>array('safe_label'=>'true')
                )/*,array('route'=>'#')*/);
            $subMenu = $menu[$childGallery->getName()];
            $subMenu->setAttributes(array(
                        'class'=>'dropdown-submenu'
            ));
            $subMenu->setLinkAttributes(array(
                        'tabindex'=>'-1',
            ));
            $subMenu->setChildrenAttributes(array(
                        'class'=>'dropdown-menu',
            ));
            $subMenu->setLabel("<i class='icon-th-large'></i>".$childGallery->getName());
            $this->addMediasSubMenus($subMenu, $childGallery);
            $i++;
            
            
            $this->addChildrenGalleriesSubMenus($subMenu, $childGallery, $i);
        }
        return $menu;
    }
    
    
    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array(
            'class'=>'nav nav-list',
        ));
        
        $galleries = new ArrayCollection($this->container->get('application.gallery_access')
                                ->getAuthorizedGalleries());
        //Récup des galeries racines
        if(array_key_exists('masterId',$options))
            $criteria =  Criteria::create()->where(Criteria::expr()->eq('id',$options['masterId'])); 
        else
            $criteria  = Criteria::create()->where(Criteria::expr()->isNull('parent')); 
        
        $masterGalleries = $galleries->matching($criteria);

        //$i compteur de profondeur du menu
        $i=0;
        foreach($masterGalleries as $masterGallery){
            
            $menu->addChild($masterGallery->getName(),array(
                'extras'=>array('safe_label'=>'true')
                )
            );    
            
            $subMenu = $menu[$masterGallery->getName()];
            
            $subMenu->setLabel($masterGallery->getName());
            $subMenu->setAttributes(array(
                        'class'=>'nav-header'
            ));
            $subMenu->setLinkAttributes(array(
//                        'data-toggle'=>'dropdown',
                        'class'=>'setLinkAttributes',
            ));
            $subMenu->setChildrenAttributes(array(
                        'class'=>'nav nav-list',
            ));
            $this->addSideChildrenGalleriesSubMenus($subMenu,$masterGallery,$i);
            $this->addSideMediasSubMenus($subMenu,$masterGallery);                    
        }
        
        
        

        
//        $menu->addChild('Gallerie1', array('route' => '#'));
//        $menu->addChild('Gallerie2', array(
//            'route' => '#',
//            'routeParameters' => array('id' => 42)
//        ));
        // ... add more children
        
        return $menu;
    }
     
    
    public function addSideMediasSubMenus($menu,$gallery){
        foreach($gallery->getGalleryHasMedias() as $childMedia){ 
            $menu->addChild($childMedia->getMedia()->getName(),array(
                'route'=>'my_media_show',
                'routeParameters'=>array(
                    'id'=>$childMedia->getMedia()->getId(),
                    'galId'=>$gallery->getId(),
                    ),                    
                'extras'=>array('safe_label'=>'true'))/*,array('route'=>'#')*/);

            $menu[$childMedia->getMedia()->getName()]->setLabel('<i class="icon-file"></i>'.$childMedia->getMedia()->getName());
            $menu[$childMedia->getMedia()->getName()]->setAttributes(array(
                        'class'=>'media_link',
            ));
        }
        return $menu;
    }
    
    public function addSideChildrenGalleriesSubMenus(\Knp\Menu\MenuItem $menu,$gallery,$i){
        $i++;
        foreach($gallery->getChildren() as $childGallery){
            if($i >1){return $menu;} //On s'arrete à 3 niveaux de menus  
            $menu->addChild($childGallery->getName(),array(
                'route'=>'my_gallery_show',
                'routeParameters'=>array(
                    'id'=>$childGallery->getId()),
                'extras'=>array('safe_label'=>'true')
                )/*,array('route'=>'#')*/);
            $subMenu = $menu[$childGallery->getName()];
            $subMenu->setAttributes(array(
                        'class'=>'setAttributes'
            ));

            $subMenu->setChildrenAttributes(array(
                        'class'=>'nav nav-list',
            ));
            $subMenu->setLabel("<i class='icon-th-large'></i>".$childGallery->getName());
//            $this->addSideMediasSubMenus($subMenu, $childGallery);
                       
            
            $this->addSideChildrenGalleriesSubMenus($subMenu, $childGallery, $i);
        }
        return $menu;
    }
}

?>
