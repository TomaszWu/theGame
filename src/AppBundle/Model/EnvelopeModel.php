<?php

namespace AppBundle\Model;


use AppBundle\Entity\Envelopes;
use AppBundle\Repository\EnvelopesRepository;
use Doctrine\ORM\EntityManager;

class EnvelopeModel
{
    /**
     * @var EntityManager $entityManager
     */
    private $entityManager;
    /**
     * @var EnvelopesRepository $envelopeRepository
     */
    private $envelopeRepository;

    public function __construct(EntityManager $entityManager, EnvelopesRepository $envelopesRepository)
    {
        $this->entityManager = $entityManager;
        $this->envelopeRepository = $envelopesRepository;
    }

    public function save(Envelopes $envelopes){
        $this->entityManager->persist($envelopes);
        $this->entityManager->flush();
    }

    public function getAllEnvelopes(){
        return $this->envelopeRepository->findAll();
    }
    
     public function getEnvelopeById($id) {
        return $this->envelopeRepository->findOneById($id);
    }
}
