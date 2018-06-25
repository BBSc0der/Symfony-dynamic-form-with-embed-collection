<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppBundle\Entity\Question
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Question {

    function __construct() {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var integer $idQuestion
     *
     * @ORM\Column(name="idQuestion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idQuestion;

    /**
     * @var string $content
     *
     * @ORM\Column(name="content", type="string", length=200)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Quiz", inversedBy="questions")
     * @ORM\JoinColumn(name="idquiz", referencedColumnName="idquiz",nullable=false)
     */
    protected $quiz;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question", cascade={"persist", "remove"})
     */
    protected $answers;

    /**
     * Get idquestion
     *
     * @return integer
     */
    function getIdQuestion() {
        return $this->idQuestion;
    }

    /**
     * Get content 
     *
     * @return string
     */
    function getContent() {
        return $this->content;
    }

    /**
     * Get quiz
     *
     * @return AppBundle\Entity\Quiz
     */
    function getQuiz() {
        return $this->quiz;
    }

    /**
     * Set idQuestion
     *
     * @param integer $idQuestion
     */
    function setIdQuestion($idQuestion) {
        $this->idQuestion = $idQuestion;
    }

    /**
     * Set $content
     *
     * @param string $content
     */
    function setContent($content) {
        $this->content = $content;
    }

    /**
     * Set quiz
     *
     * @param AppBundle\Entity\Quiz $quiz
     */
    function setQuiz($quiz) {
        $this->quiz = $quiz;
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    function getAnswers() {
        return $this->answers;
    }

    /**
     * Add answer
     *
     * @param AppBundle\Entity\Answer $answers
     */
    function addAnswers(\AppBundle\Entity\Answer $answers) {
        $this->answers[] = $answers;
    }
    /**
     * Set answers
     *
     * @param \Doctrine\Common\Collections\Collection $answers
     */
    function setAnswers(\Doctrine\Common\Collections\Collection $answers){
        $this->answers = $answers;
    }

}
