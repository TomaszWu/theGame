<?php

namespace AppBundle\Model;


use AppBundle\Entity\Answers;
use AppBundle\Repository\AnswersRepository;
use Doctrine\ORM\EntityManager;

class AnswersModel
{
    /**
     * @var EntityManager $entityManager
     */
    private $entityManager;
    /**
     * @var AnswersRepository $answersRepository
     */
    private $answersRepository;

    public function __construct(EntityManager $entityManager, AnswersRepository $answersRepository)
    {
        $this->entityManager = $entityManager;
        $this->answersRepository = $answersRepository;
    }

    public function save(Answers $answers){
        $this->entityManager->persist($answers);
        $this->entityManager->flush();
    }

    public function getAllAnswers(){
        return $this->answersRepository->findAll();
    }
    
    public function getAllAnswersByQuestionId($id){
        return $this->answersRepository->findByQuestion($id);
    }
    
   public function getAnswerById($id){
       return $this->answersRepository->findOneById($id);
   }
    
  
    
}
