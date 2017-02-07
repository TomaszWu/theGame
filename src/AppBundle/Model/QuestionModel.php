<?php

namespace AppBundle\Model;

use AppBundle\Entity\Questions;
use AppBundle\Model\GameModel;
use AppBundle\Entity\Game;
use AppBundle\Repository\QuestionsRepository;
use Doctrine\ORM\EntityManager;
use AppBundle\UserBundle\Dql;

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

    public function drawAnUnaskedQuestion($alreadyAskedQuestions) {
        $drawQuestion = $this->getARandomQuestion();

        if ($this->compareQuestions($alreadyAskedQuestions, $drawQuestion)) {
            $drawQuestion = $this->drawAnUnaskedQuestion($alreadyAskedQuestions);
        } else {
            return $drawQuestion;
        }
    }

    public function compareQuestions($alreadyAskedQuestions, $singleQuestion) {
        foreach ($alreadyAskedQuestions as $question) {
            if ($question == $singleQuestion) {
                return false;
            } else {
                return true;
            }
        }
    }

}
