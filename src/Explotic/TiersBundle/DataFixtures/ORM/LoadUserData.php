<?php
// src/Explotic/TiersBundle/DataFixtures/ORM/LoadUserData.php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadUserData
 *
 * @author arraiolosa
 */

namespace Explotic\TiersBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Explotic\TiersBundle\Entity\Entreprise;


class LoadUserData implements FixtureInterface
{
    //put your code here
    public function load(ObjectManager $manager){
        $cfppa= new Entreprise();
        $cfppa->setRaisonSociale('CFPPA');
        $cfppa->setTelephone('05...');
        $cfppa->setBureau(new Explotic\TiersBundle\Entity\Bureau());
        $cfppa->getBureau()->setLocalisation(new Explotic\TiersBundle\Entity\Localisation());
        $cfppa->getBureau()->getLocalisation()->setCommune('Bazas');
        $cfppa->getBureau()->getLocalisation()->setCp('33');
        $cfppa->getBureau()->getLocalisation()->setGeometry(new \Explotic\TiersBundle\Entity\Geometry());
        $cfppa->getBureau()->getLocalisation()->getGeometry()->setX= '55';
        $cfppa->getBureau()->getLocalisation()->getGeometry()->setY= '-0.45';
        
        $manager->persist($cfppa);
        $manager->flush();

        
    }
    
    
    
    
}

?>
