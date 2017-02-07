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
        do {
            $i = 0;
            $newQuestion = $this->getARandomQuestion()->getQuestion();
            foreach ($arrayOfAlreadyAskedQuestions as $singleQuestion) {
                var_dump($singleQuestion->getQuestion());
                var_dump($newQuestion . 'nowe pytanie');
//                
                var_dump((strcmp($newQuestion, $singleQuestion->getQuestion())));
//                exit;
                if (strcmp($newQuestion, $singleQuestion->getQuestion()) !== 0) {
                    $i++;
                }
            }

            if ($i == count($arrayOfAlreadyAskedQuestions)) {
                return $newQuestion . 'test';
            } else {
                $i = 0;
            }
//            exit;
        } while ($i == 0);
    }

}
