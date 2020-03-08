<?php

namespace App\Controller;

use App\Repository\DiscoveryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscoveryController extends AbstractController
{
	/**
	 * @Route("/discoveries/{page}", name="discovery.index")
	 */
	public function index(DiscoveryRepository $discoveryRepository, int $page = 1):Response
	{

		$discoveriesPerPage = $this->getParameter('discoveries_per_page');
		$totalDiscoveries = $discoveryRepository->count([]);
		$results = $discoveryRepository->findBy([], [], $discoveriesPerPage, (--$page * $discoveriesPerPage));

		return $this->render('discovery/index.html.twig', [
			'discoveriesPerPage' => $discoveriesPerPage,
			'totalDiscoveries' => $totalDiscoveries,
			'results' => $results
		]);
	}

	/**
	 * @Route("/discovery/{slug}", name="discovery.details")
	 */

	public function details(string $slug, DiscoveryRepository $discoveryRepository):Response
	{

		$discovery = $discoveryRepository->findOneBy([
			'slug' => $slug
		]);

		return $this->render('discovery/details.html.twig', [
			'discovery' => $discovery
		]);
	}

}








