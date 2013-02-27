<?php
namespace Explotic\TiersBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persisitence\ObjectManager;
use Explotic\TiersBundle\Entity\Bureau;
use Explotic\TiersBundle\Entity\Localisation;
use Explotic\TiersBundle\Entity\Geometry;
use Explotic\MainBundle\Model\GMapsAddress;

class BureauToGMapsAddressTransformer implements DataTransformerInterface
{
    /**
     * Transforms an object (Bureau) to an other object (GMapsAddress).
     *
     * @param  Bureau|null $bureau
     * @return GMapsAddress
     */
    public function transform($bureau)
    {
        if (null === $bureau) {
            return null;
        }
        
        $gmapsAddress = new GMapsAddress();
        
        $gmapsAddress->setCity($bureau->getLocalisation()->getCommune());
        $gmapsAddress->setPostalCode($bureau->getLocalisation()->getCp());
        $gmapsAddress->setLat($bureau->getLocalisation()->getGeometry()->getLat());
        $gmapsAddress->setLon($bureau->getLocalisation()->getGeometry()->getLon());
        $gmapsAddress->setStreet($bureau->getAdresseRue());
        $gmapsAddress->autoAddress();
        return $gmapsAddress;
    }

    /**
     * Transforms an object (GMapsAddress) to an object (bureau).
     *
     * @param  GMapsAddress $gmapsAddress
     * @return Bureau|null
     * @throws TransformationFailedException if object (bureau) is not found.
     */
    public function reverseTransform($gmapsAddress)
    {
        if (!$gmapsAddress) {
            return null;
        }
        
        $bureau = new Bureau();
        
        try{

            $geometry = new geometry();
            $geometry->setLat($gmapsAddress->getLat());
            $geometry->setLon($gmapsAddress->getLon());          
            $localisation = new Localisation();
            $localisation->setCommune($gmapsAddress->getCity());
            $localisation->setCp($gmapsAddress->getPostalCode());
            $localisation->setGeometry($geometry);
            $bureau->setlocalisation($localisation);
            $bureau->setAdresseRue($gmapsAddress->getStreet());
            
        }
        catch(Exception $e){
            throw new TransformationFailedException(sprintf(
                    'Impossible de récupérer cette adresse google',
                    $gmapsAddress));
        }
        
        return $bureau;
    }
}

?>
