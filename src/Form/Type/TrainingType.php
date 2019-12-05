<?php
// src/Form/Type/TrainingType.php
namespace App\Form\Type;

use App\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('naam', TextType::class)
            ->add('description', TextareaType::class)
            ->add('duration', IntegerType::class)
            ->add('costs', MoneyType::class)
            ->add('submit', SubmitType::class)
            ->add('naam', TextType::class, [
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
            ])
            ->add('duration', IntegerType::class, [
                'required' => true,
            ])
            ->add('costs', MoneyType::class, [
                'required' => true,
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Training::class,
        ]);
    }
}
