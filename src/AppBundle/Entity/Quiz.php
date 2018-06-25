<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppBundle\Entity\Quiz
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Quiz {

    public function __construct() {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var integer $idquiz
     *
     * @ORM\Column(name="idquiz", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idquiz;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var boolean $multipleChoice
     *
     * @ORM\Column(name="multipleChoice", type="boolean")
     */
    private $multipleChoice;

    /**
     * @var boolean $numberOfQuestions
     *
     * @ORM\Column(name="numberOfQuestions", type="integer")
     */
    private $numberOfQuestions;

    /**
     * @var boolean $addedAt
     *
     * @ORM\Column(name="addedAt", type="datetime")
     */
    private $addedAt;



    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="quiz", cascade={"persist", "remove"})
     */
    protected $questions;

    /**
     * Get idquiz
     *
     * @return integer
     */
    function getIdquiz() {
        return $this->idquiz;
    }

    /**
     * Get name 
     *
     * @return string
     */
    function getName() {
        return $this->name;
    }

    /**
     * Get multipleChoice
     *
     * @return boolean
     */
    function getMultipleChoice() {
        return $this->multipleChoice;
    }

    /**
     * Get numberOfQuestions
     *
     * @return integer
     */
    function getNumberOfQuestions() {
        return $this->numberOfQuestions;
    }

    /**
     * Get addedAt
     *
     * @return datetime
     */
    function getAddedAt() {
        return $this->addedAt;
    }



    /**
     * Set idquiz
     *
     * @param integer $idquiz
     */
    function setIdQuiz($idquiz) {
        $this->idquiz = $idquiz;
    }

    /**
     * Set $name
     *
     * @param string $name
     */
    function setName($name) {
        $this->name = $name;
    }

    /**
     * Set $multipleChoice
     *
     * @param boolean $multipleChoice
     */
    function setMultipleChoice($multipleChoice) {
        $this->multipleChoice = $multipleChoice;
    }

    /**
     * Set $numberOfQuestions
     *
     * @param integer $numberOfQuestions
     */
    function setNumberOfQuestions($numberOfQuestions) {
        $this->numberOfQuestions = $numberOfQuestions;
    }

    /**
     * Set $addedAt
     *
     * @param datetime $addedAt
     */
    function setAddedAt($addedAt) {
        $this->addedAt = $addedAt;
    }


    /**
     * Get questions
     *
     * @return Doctrine\Common\Collections\Collection
     */
    function getQuestions() {
        return $this->questions;
    }
    
    /**
     * Set questions
     *
     * @param \Doctrine\Common\Collections\Collection $questions
     */
    function setQuestions(\Doctrine\Common\Collections\Collection $questions) {
        $this->questions = $questions;
    }

        /**
     * Add questions
     *
     * @param AppBundle\Entity\Question $questions
     */
    function addQuestions(\AppBundle\Entity\Question $questions) {
        $this->questions[] = $questions;
    }

}
