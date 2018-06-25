<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\Common\Collections\ArrayCollection;

class QuizForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, array('label' => 'Nazwa testu',
                    'attr' => array('class' => 'test_name')))
                ->add('multipleChoice', CheckboxType::class, array(
                    'label' => 'Test wielokrotnego wyboru',
                    'required' => false,
                ))
                ->add('numberOfQuestions', ChoiceType::class, array(
                    'label' => 'Liczba pytań',
                    'choices' => array(
                        '10' => 10,
                        '15' => 15,
                        '20' => 20,
                        '30' => 30,
                    ),
                ))
                ->add('numberOfAnswers', ChoiceType::class, array(
                    'label' => 'Liczba odpowiedzi w pytaniu',
                    'choices' => array(
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                    ),
                    'data' => 4,
                    'mapped' => false
                ))
                ->add('questions', CollectionType::class, array(
                    'entry_type' => QuestionForm::class,
                    'entry_options' => array('label' => false),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'by_reference' => false,
                    'empty_data' => new ArrayCollection(),
                ))
                ->add('zapisz', SubmitType::class);

        $builder->addEventListener(
                FormEvents::POST_SUBMIT, array($this, 'onPostSubmit')
        );
    }

    public function onPostSubmit(FormEvent $event) {
        
        $quiz = $event->getData();
        
        
        foreach ($quiz->getQuestions() as $question) {
            if ($question->getQuiz() == NULL)
                $question->setQuiz($quiz);
            foreach ($question->getAnswers() as $key => $answer) {
                if ($answer->getQuestion() == NULL)
                    $answer->setQuestion($question);
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Quiz',
            'csrf_protection' => false,
        ));
    }

}
