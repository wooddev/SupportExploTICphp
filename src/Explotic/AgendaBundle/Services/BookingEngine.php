<?php
namespace Explotic\AgendaBundle\Services;

use Doctrine\ORM\EntityManager;


/**
 * Description of BookingEngine
 *
 * @author Grumpf
 */
class BookingEngine {
    //put your code here
    private $em,
            $bookingTypes;
    public function __construct(EntityManager $em, array $bookingTypes) {
        $this->em = $em;
        $this->bookingTypes = $bookingTypes;
    }
}

?>
