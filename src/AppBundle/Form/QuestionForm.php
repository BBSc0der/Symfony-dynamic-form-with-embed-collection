<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Constraints\CallbackValidator;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class QuestionForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('content', TextType::class, array('label' => 'Treść pytania:',
                    'attr' => array(
                        'class' => 'question_content')))
                ->add('answers', CollectionType::class, array(
                    'entry_type' => AnswerForm::class,
                    'entry_options' => array('label' => false),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'by_reference' => false,
                    'empty_data' => new ArrayCollection(),
                    'constraints' => array(
                        new Callback(array($this, 'validateQuestion'))
                    )
        ));
    }

    public function validateQuestion($answers, ExecutionContext $context) {
        $anyChecked = false;
        foreach ($answers as $answer) {
            if ($answer->getCorrect()) {
                $anyChecked = true;
            }
        }
        if (!$anyChecked) {
            $context->addViolation("Brak odpowiedzi do pytania");
        }
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Question',
            'csrf_protection' => false,
        ));
    }

}
