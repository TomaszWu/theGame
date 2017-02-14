<?php

namespace AppBundle\Model;

use AppBundle\Entity\Game;
use AppBundle\Repository\GameRepository;
use Doctrine\ORM\EntityManager;

class GameModel {

    /**
     * @var EntityManager $entityManager
     */
    private $entityManager;

    /**
     * @var GameRepository $gameRepository
     */
    private $gameRepository;

    public function __construct(EntityManager $entityManager, GameRepository $gameRepository) {
        $this->entityManager = $entityManager;
        $this->gameRepository = $gameRepository;
    }

    public function save(Game $game) {
        $this->entityManager->persist($game);
        $this->entityManager->flush();
    }

    public function getAllGames() {
        return $this->gameRepository->findAll();
    }

    public function getGameById($id) {
        return $this->gameRepository->findOneById($id);
    }
    
    
    

}
