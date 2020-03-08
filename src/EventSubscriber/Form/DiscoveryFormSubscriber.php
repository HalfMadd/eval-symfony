<?php

namespace App\EventSubscriber\Form;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class DiscoveryFormSubscriber implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		
		return [
			FormEvents::POST_SET_DATA => 'postSetData'
		];
	}

	public function postSetData(FormEvent $event):void
	{
		
		$data = $event->getData();
		$form = $event->getForm();
		$model = $form->getData();

		$form->add('image', FileType::class, [
			'data_class' => null, 

			'constraints' => $data->getId() ? [] : [
				new NotBlank([
		             'message' => "L'image est obligatoire"]),
				new Image([
			          'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'],
			          'mimeTypesMessage' => "L'image n'est pas dans un format Web"
		        ])
			]
		]);

	}
}




