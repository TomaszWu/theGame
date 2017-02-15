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


    /**
     * Add user_answers
     *
     * @param \AppBundle\Entity\Answers $userAnswers
     * @return User
     */
    public function addUserAnswer(\AppBundle\Entity\Answers $userAnswers)
    {
        $this->user_answers[] = $userAnswers;

        return $this;
    }

    /**
     * Remove user_answers
     *
     * @param \AppBundle\Entity\Answers $userAnswers
     */
    public function removeUserAnswer(\AppBundle\Entity\Answers $userAnswers)
    {
        $this->user_answers->removeElement($userAnswers);
    }

    /**
     * Get user_answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserAnswers()
    {
        return $this->user_answers;
    }
}
