<?php

namespace AppBundle\Model;

use AppBundle\Entity\Questions;
use AppBundle\Repository\QuestionsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;

class QuestionModel {

    /**
     * @var EntityManager $entityManager
     */
    private $entityManager;

    /**
     * @var QuestionsRepository $questionsRepository
     */
    private $questionsRepository;

    public function __construct(EntityManager $entityManager, QuestionsRepository $questionsRepository) {
        $this->entityManager = $entityManager;
        $this->questionsRepository = $questionsRepository;
    }

    public function save(Questions $questions) {
        $this->entityManager->persist($questions);
        $this->entityManager->flush();
        return $questions->getId();
    }

    public function delete(Questions $questions) {
        $this->entityManager->remove($questions);
        $this->entityManager->flush();
    }
    
     public function getQuestionById($id) {
        return $this->questionsRepository->findOneById($id);
    }

    public function getAllQuestion() {
        return $this->questionsRepository->findAll();
    }

    public function getARandomQuestion() { {
            $max = $this->entityManager->createQuery('
            SELECT MAX(q.id) FROM AppBundle:Questions q
            ')
                    ->getSingleScalarResult();
            return $question = $this->entityManager->createQuery('
            SELECT q FROM AppBundle:Questions q 
            WHERE q.id >= :rand
            ORDER BY q.id ASC
            ')
                    ->setParameter('rand', rand(0, $max))
                    ->setMaxResults(1)
                    ->getSingleResult();
        }
    }

    public function drawAUnAskedQuestion($arrayOfAlreadyAskedQuestions) {
        $allQurstions = $this->getAllQuestion();
        // number of already asked questions is equal to all questions in DB
        // it means that all questions have been already asked and the game is over
        if (count($arrayOfAlreadyAskedQuestions) !== count($allQurstions)) {
            do {
                $i = 0;
                $newQuestion = $this->getARandomQuestion();
                foreach ($arrayOfAlreadyAskedQuestions as $singleQuestion) {
//                    var_dump($singleQuestion->getQuestion());
//                    var_dump($newQuestion->getQuestion());
////                
//                    var_dump((strcmp($newQuestion->getQuestion(), $singleQuestion->getQuestion())));
//                if the draw question is different to the one in DB then $i++
                    if (strcmp($newQuestion->getQuestion(), $singleQuestion->getQuestion()) !== 0) {
                        $i++;
                    }
                }
                // if in every loop draw question was different to the all single 
                // questions from DB it emans that it is a good one
                if ($i == count($arrayOfAlreadyAskedQuestions)) {
                    return $newQuestion;
                } else {
                    $i = 0;
                }
//            exit;
            } while ($i == 0);
        } else {
            return null;
        }
    }

}
