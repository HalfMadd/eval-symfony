<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Discovery;
use App\EventSubscriber\Form\DiscoveryFormSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class DiscoveryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
            	'constraints' => [
            		new NotBlank([
            		    'message' => "Le nom est obligatoire"
		            ])
	            ]
            ])
            ->add('description', TextareaType::class, [
	            'constraints' => [
		            new NotBlank([
                         'message' => "La description est obligatoire"
                     ])
                ]
            ])

	        ->add('country', EntityType::class, [
				'class' => Country::class,
	            'choice_label' => 'name',
	            'placeholder' => '',
	            'constraints' => [
	            	new NotBlank([
	            	    'message' => 'Le pays est obligatoire'
		            ])
	            ]
            ])
        ;

        // ajout d'un soucripteur de formulaire
	    $builder->addEventSubscriber( new DiscoveryFormSubscriber() );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Discovery::class,
        ]);
    }
}
