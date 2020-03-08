<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class HomepageController extends AbstractController
{
	/**
	 * @Route("/", name="admin.homepage.index")
	 */
	public function index(Request $request):Response
	{
		return $this->render('admin/homepage/index.html.twig', [

		]);
	}
}