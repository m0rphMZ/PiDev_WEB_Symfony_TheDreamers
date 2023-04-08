<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\NotBlank;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez remplir ce champ',
                    ]),
                ],
            ])
            ->add('type', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez remplir ce champ',
                    ]),
                ],
            ])
            ->add('description', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez remplir ce champ',
                    ]),
                ],
            ])
            ->add('startdate', DateType::class, [
                'attr' => [
                    'class' => 'datepicker'
                ],
            ])
            ->add('enddate')
            ->add('ticketcount', NumberType::class, [
                'invalid_message' => 'Le nombre des tickets doit être numérique.'])
            ->add('affiche', FileType::class, [
                'label' => 'Affiche',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2Mi',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif'
                        ],
                        'mimeTypesMessage' => 'Veuillez choisir une image',
                    ]),
                    new NotBlank([
                        'message' => 'Veuillez choisir une image',
                    ]),
                ],
            ])
            ->add('ticketprice', NumberType::class, [
                'invalid_message' => 'Le prix du ticket doit être numérique.'])
            //->add('host')
            //->add('location')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
