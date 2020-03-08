<?php

namespace App\EventSubscriber\Entity;

use App\Entity\Discovery;
use App\Service\FileService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class DiscoveryEventSubscriber implements EventSubscriber
{

	private $slugger;
	private $fileService;

	public function __construct(SluggerInterface $slugger, FileService $fileService)
	{
		$this->slugger = $slugger;
		$this->fileService = $fileService;
	}

	public function prePersist(LifecycleEventArgs $event):void
	{
		if($event->getObject() instanceof Discovery){
			$discovery = $event->getObject();

			$discovery->setSlug( $this->slugger->slug($discovery->getName())->lower() );

			if($discovery->getImage() instanceof UploadedFile){

				$this->fileService->upload( $discovery->getImage(), 'img/discovery' );

				$discovery->setImage( $this->fileService->getFileName() );
			}
		}
	}

	public function getSubscribedEvents()
	{
		return [
			Events::prePersist,
			Events::postLoad,
			Events::preUpdate,
			Events::preRemove
		];
	}

	public function preRemove(LifecycleEventArgs $args):void
	{
		if($args->getObject() instanceof Discovery) {
			$discovery = $args->getObject();
			
			$this->fileService->delete( $discovery->prevImage, 'img/discovery' );
		}
	}

	public function preUpdate(LifecycleEventArgs $args):void
	{
		if($args->getObject() instanceof Discovery){
			$discovery = $args->getObject();
			
			if($discovery->getImage() instanceof UploadedFile){
				
				$this->fileService->upload($discovery->getImage(), 'img/discovery');
				$discovery->setImage( $this->fileService->getFileName() );

				
				$this->fileService->delete( $discovery->prevImage, 'img/discovery' );
			}
			
			else {
				
				$discovery->setImage( $discovery->prevImage );
			}
		}
	}

	public function postLoad(LifecycleEventArgs $args):void
	{
		if($args->getObject() instanceof Discovery){
			
			$discovery = $args->getObject();
			$discovery->prevImage = $discovery->getImage();
			
		}
	}
}







