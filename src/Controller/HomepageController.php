<?php

namespace App\Controller;

use App\Repository\DiscoveryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{

	/**
	 * @Route("/", name="homepage.index")
	 */
	public function index(Request $request, DiscoveryRepository $discoveryRepository):Response
	{

		$userAgent = $request->server->get('HTTP_USER_AGENT');
		$results = $discoveryRepository->findAll();

		return $this->render('homepage/index.html.twig', [
			'param' => $userAgent,
			'results' => $results
		]);
	}


	/**
	 * @Route("/twig", name="homepage.twig")
	 */
	public function twig():Response
	{
		return $this->render('homepage/twig.html.twig');
	}
}








