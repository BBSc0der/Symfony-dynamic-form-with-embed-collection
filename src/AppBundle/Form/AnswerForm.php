<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AnswerForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('content', TextType::class, array('label' => 'Odpowiedź:',
                    'attr' => array('class' => 'answer_content')))
                ->add('correct', CheckboxType::class, array(
                    'label' => false,
                    'required' => false
        ));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Answer',
            'csrf_protection' => false,
        ));
    }

}
