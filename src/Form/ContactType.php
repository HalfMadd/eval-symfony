<?php

namespace App\Form;

use App\Form\Model\ContactFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
        $builder
            ->add('firstname', TextType::class, [
				'constraints' => [
					new NotBlank([
						'message' => "Le prénom est obligatoire"
					]),
					new Length([
						'min' => 2,
						'max' => 25,
						'minMessage' => "Votre prénom doit contenir {{ limit }} caractères au minimum",
						'maxMessage' => "Votre prénom doit contenir {{ limit }} caractères au maximum"
					])
				]
            ])
            ->add('lastname', TextType::class, [
	            'constraints' => [
		            new NotBlank([
                         'message' => "Le nom est obligatoire"
                     ]),
		            new Length([
	                       'min' => 2,
	                       'max' => 50,
	                       'minMessage' => "Votre nom doit contenir {{ limit }} caractères au minimum",
	                       'maxMessage' => "Votre nom doit contenir {{ limit }} caractères au maximum"
                       ])
	            ]
            ])
            ->add('email', EmailType::class, [
            	'constraints' => [
            		new NotBlank([
            		    'message' => "L'email est obligatoire"
            		]),
		            new Email([
		            	'message' => "L'email est incorrect"
		            ])
	            ]
            ])
            ->add('message', TextareaType::class, [
	            'constraints' => [
		            new NotBlank([
                         'message' => "Le message est obligatoire"
                    ]),
		            new Length([
		            	'min' => 10,
	                    'minMessage' => "Votre message doit contenir {{ limit }} caractères au minimum"
                    ])
	            ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactFormModel::class
        ]);
    }
}
