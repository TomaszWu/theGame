<?php

namespace AppBundle\Entity;

/**
 * Game
 */
class Game
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $money;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set money
     *
     * @param integer $money
     *
     * @return Game
     */
    public function setMoney($money)
    {
        $this->money = $money;

        return $this;
    }

    /**
     * Get money
     *
     * @return int
     */
    public function getMoney()
    {
        return $this->money;
    }
    /**
     * @var \UserBundle\Entity\User
     */
    private $users;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $game_questions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $game_envelopes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->game_questions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->game_envelopes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set users
     *
     * @param \UserBundle\Entity\User $users
     *
     * @return Game
     */
    public function setUsers(\UserBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \UserBundle\Entity\User
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add gameQuestion
     *
     * @param \AppBundle\Entity\Questions $gameQuestion
     *
     * @return Game
     */
    public function addGameQuestion(\AppBundle\Entity\Questions $gameQuestion)
    {
        $this->game_questions[] = $gameQuestion;

        return $this;
    }

    /**
     * Remove gameQuestion
     *
     * @param \AppBundle\Entity\Questions $gameQuestion
     */
    public function removeGameQuestion(\AppBundle\Entity\Questions $gameQuestion)
    {
        $this->game_questions->removeElement($gameQuestion);
    }

    /**
     * Get gameQuestions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGameQuestions()
    {
        return $this->game_questions;
    }

    /**
     * Add gameEnvelope
     *
     * @param \AppBundle\Entity\Envelopes $gameEnvelope
     *
     * @return Game
     */
    public function addGameEnvelope(\AppBundle\Entity\Envelopes $gameEnvelope)
    {
        $this->game_envelopes[] = $gameEnvelope;

        return $this;
    }

    /**
     * Remove gameEnvelope
     *
     * @param \AppBundle\Entity\Envelopes $gameEnvelope
     */
    public function removeGameEnvelope(\AppBundle\Entity\Envelopes $gameEnvelope)
    {
        $this->game_envelopes->removeElement($gameEnvelope);
    }

    /**
     * Get gameEnvelopes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGameEnvelopes()
    {
        return $this->game_envelopes;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $questions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $envelopes;


    /**
     * Add questions
     *
     * @param \AppBundle\Entity\Questions $questions
     * @return Game
     */
    public function addQuestion(\AppBundle\Entity\Questions $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \AppBundle\Entity\Questions $questions
     */
    public function removeQuestion(\AppBundle\Entity\Questions $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Add envelopes
     *
     * @param \AppBundle\Entity\Envelopes $envelopes
     * @return Game
     */
    public function addEnvelope(\AppBundle\Entity\Envelopes $envelopes)
    {
        $this->envelopes[] = $envelopes;

        return $this;
    }

    /**
     * Remove envelopes
     *
     * @param \AppBundle\Entity\Envelopes $envelopes
     */
    public function removeEnvelope(\AppBundle\Entity\Envelopes $envelopes)
    {
        $this->envelopes->removeElement($envelopes);
    }

    /**
     * Get envelopes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnvelopes()
    {
        return $this->envelopes;
    }
    
    
    public function __toString() {
        return (string) $this->getQuestions();
    }
    
}
