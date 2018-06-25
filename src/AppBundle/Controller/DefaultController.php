<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\QuizService;
use AppBundle\Form\QuizForm;
use AppBundle\Form\EditQuizForm;
use AppBundle\Form\SolveQuizForm;
use AppBundle\Form\QuizSolveForm;
use AppBundle\Entity\Quiz;
use AppBundle\Entity\Question;
use Doctrine\Common\Collections\ArrayCollection;

class DefaultController extends Controller {

    private $quizService;

    function __construct(QuizService $quizService) {
        $this->quizService = $quizService;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $quiz = $this->quizService->prepareDefaultQuiz();
        $form = $this->createForm(QuizForm::class, $quiz);

        $form->handleRequest($request);
        $newQuiz = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $newQuiz = $form->getData();
        }
        $errors = false;
        if ($form->getErrors()->count() > 0) {
            $errors = true;
        }

        return $this->render('default/index.html.twig', [
                    'form' => $form->createView(),
                    'errors' => $errors,
                    'quiz' => $newQuiz
        ]);
    }
}
