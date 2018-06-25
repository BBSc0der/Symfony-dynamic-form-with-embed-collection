<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppBundle\Entity\Answer
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Answer {


    /**
     * @var integer $idAnswer
     *
     * @ORM\Column(name="idAnswer", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAnswer;

    /**
     * @var string $content
     *
     * @ORM\Column(name="content", type="string", length=200)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers")
     * @ORM\JoinColumn(name="idQuestion", referencedColumnName="idQuestion",nullable=false)
     */
    protected $question;

    /**
     * @var boolean $correct
     *
     * @ORM\Column(name="correct", type="boolean")
     */
    private $correct;
    
    /**
     * Get idAnswer
     *
     * @return integer
     */
    function getIdAnswer() {
        return $this->idAnswer;
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
     * Get question
     *
     * @return AppBundle\Entity\Question
     */
    function getQuestion() {
        return $this->question;
    }

    /**
     * Set idAnswer
     *
     * @param integer $idAnswer
     */
    function setIdAnswer($idAnswer) {
        $this->idAnswer = $idAnswer;
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
     * @param AppBundle\Entity\Question $question
     */
    function setQuestion($question) {
        $this->question = $question;
    }
        /**
     * Get correct
     *
     * @return boolean
     */
    function getCorrect() {
        return $this->correct;
    }
    /**
     * Set correct
     *
     * @param boolean $correct
     */
    function setCorrect($correct) {
        $this->correct = $correct;
    }



}
