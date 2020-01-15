<?php
namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class InstructorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('firstname', TextType::class)
            ->add('preposition', TextType::class, [
                'required' => false,
            ])
            ->add('lastname', TextType::class)
            ->add('dateofbirth', BirthdayType::class)
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'Man' => 'Man',
                    'Vrouw' => 'Vrouw',
                    'Zeg ik liever niet' => 'Zeg ik liever niet',
                )
            ))
            ->add('Instructeur toevoegen', SubmitType::class);
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}