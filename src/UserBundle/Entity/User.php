<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use \FOS\UserBundle\Model\User as BaseUser;
/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $user_answers;

    public function __construct(){
        $this->user_answers = new ArrayCollection();
        parent::__construct();
    }

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
     * Add userAnswer
     *
     * @param \AppBundle\Entity\Answers $userAnswer
     *
     * @return User
     */
    public function addUserAnswer(\AppBundle\Entity\Answers $userAnswer)
    {
        $this->user_answers[] = $userAnswer;

        return $this;
    }

    /**
     * Remove userAnswer
     *
     * @param \AppBundle\Entity\Answers $userAnswer
     */
    public function removeUserAnswer(\AppBundle\Entity\Answers $userAnswer)
    {
        $this->user_answers->removeElement($userAnswer);
    }

    /**
     * Get userAnswers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserAnswers()
    {
        return $this->user_answers;
    }
}
