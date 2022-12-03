<?php

namespace App\Form;

use App\Entity\Events;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ["attr" => ["placeholder" => "Please enter the Event's Name...", "class" => "form-control mb-3"] ])
            ->add('description', TextareaType::class, ["attr" => ["placeholder" => "Please enter the Event's Description...", "class" => "form-control mb-3"] ])
            ->add('image', TextType::class, ["attr" => ["placeholder" => "Please enter an Image URL for the Event...", "class" => "form-control mb-3"] ])
            ->add('capacity', IntegerType::class, ["attr" => ["placeholder" => "Please enter the Event's Capacity...", "class" => "form-control mb-3"] ])
            ->add('e_mail', TextType::class, ["attr" => ["placeholder" => "Please enter the Event's Contact E-Mail...", "class" => "form-control mb-3"] ])
            ->add('phone_number', TextType::class, ["attr" => ["placeholder" => "Please enter the Event's Contact Phone Number...", "class" => "form-control mb-3"] ])
            ->add('address', TextType::class, ["attr" => ["placeholder" => "Please enter the Event's Address...", "class" => "form-control mb-3"] ])
            ->add('url', UrlType::class, ["attr" => ["placeholder" => "Please enter the Event's URL...", "class" => "form-control mb-3"] ])
            ->add('date_and_time', DateTimeType::class, ["attr" => ["class" => "form-control mb-3"] ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Music' => 'music',
                    'Sport' => 'sport',
                    'Movie' => 'movie',
                    'Theater' => 'theater'
                ]
                , "attr" => ["class" => "form-control"]])
            ->add('Create', SubmitType::class, ["attr" => ["class" => "btn btn-primary mt-3"] ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver -> setDefaults([
            'date_class' => Events::class,
        ]);
    }
}