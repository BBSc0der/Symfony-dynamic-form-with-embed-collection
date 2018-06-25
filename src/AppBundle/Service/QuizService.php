<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Quiz;
use AppBundle\Entity\Question;
use AppBundle\Entity\Answer;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Extra\QuizResult;

class QuizService {

    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function prepareDefaultQuiz() {
        $question = new Question();
        $question->addAnswers(new Answer());
        $newQuiz = new Quiz();
        for ($i = 0; $i < 10; $i++) {
            $newQuiz->addQuestions(new Question());
            $newQuiz->getQuestions()->get($i)->setQuiz($newQuiz);
            for ($j = 0; $j < 4; $j++) {
                $newQuiz->getQuestions()->get($i)->addAnswers(new Answer());
                $newQuiz->getQuestions()->get($i)->getAnswers()->get($j)->setQuestion($newQuiz->getQuestions()->get($i));
            }
        }
        return $newQuiz;
    }
}
