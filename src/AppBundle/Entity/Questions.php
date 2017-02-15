<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Answers
 * 
 * @ORM\Table(name="questions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionsRepository")
 */
class Questions {

    private $answers;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $question;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $game;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->game = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return Questions
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Add answers
     *
     * @param \AppBundle\Entity\Answers $answers
     * @return Questions
     */
    public function addAnswer(\AppBundle\Entity\Answers $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \AppBundle\Entity\Answers $answers
     */
    public function removeAnswer(\AppBundle\Entity\Answers $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add game
     *
     * @param \AppBundle\Entity\Game $game
     * @return Questions
     */
    public function addGame(\AppBundle\Entity\Game $game)
    {
        $this->game[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param \AppBundle\Entity\Game $game
     */
    public function removeGame(\AppBundle\Entity\Game $game)
    {
        $this->game->removeElement($game);
    }

    /**
     * Get game
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGame()
    {
        return $this->game;
    }
}
