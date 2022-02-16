<?php

namespace App\Form;

use App\Entity\Memo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class MemoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu', TextareaType::class, [
                'label'=> 'Contenu',
                'required'=>'true',
                'attr'=>[
                    'placeholder'=> 'Contenu de ta memo',
                ],
                'constraints' => [
                    new NotBlank([
                        'message'=> 'Merci dajouter votre contenu'
                    ])
                ]
            ])
            ->add('expiration', IntegerType::class, [
                'attr' => [
                    'min'=>1,
                    'max'=>180
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Memo::class,
        ]);
    }
}
