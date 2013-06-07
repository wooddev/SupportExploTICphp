<?php
namespace Explotic\AgendaBundle\Model;

use Explotic\PlanningBundle\Entity\CalendrierRepository;
use Explotic\AgendaBundle\Entity\TypeRdvRepository;
use Explotic\AgendaBundle\Entity\RdvRepository;
use Explotic\AgendaBundle\Entity\CreneauRdvRepository;
use Explotic\AdminBundle\Entity\User;
use Symfony\Component\Security\Core\SecurityContext;
    

/**
 * Description of RdvSelector
 *
 * @author arraiolosa
 */
class RdvSelector {
    //put your code here
    private $calendriers;
    private $user;
    private $creneauxRdvs;
    private $rdvs;
    private $typeRdv;    
    private $rdvRepository;
    private $calendrierRepository;
    private $creneauRdvRepository;

    public function __construct(RdvRepository $rdvRepository, 
                                TypeRdvRepository $typeRdvRepository,
                                CreneauRdvRepository $CreneauRdvRepository,
                                CalendrierRepository $calendrierRepository,
                                SecurityContext $securityContext) {
        $this->rdvRepository = $rdvRepository;
        $this->typeRdv = $typeRdvRepository->findAll();
        $this->creneauRdvRepository = $CreneauRdvRepository;
        $this->calendrierRepository = $calendrierRepository;
        $this->user = $securityContext->getToken()->getUser();
        $this->calendriers = $calendrierRepository->findAutorises($this->user);        
    }
    
    public function generateSelector($dateDebut,$dateFin){
        $this->creneauxRdvs = $this->creneauRdvRepository->findByPeriod($dateDebut, $dateFin);
        // Question : COMMENT AFFICHER LES RDV pris ?? ==> générer calendriers tiers ??
        
    }
    
        
}

?>
