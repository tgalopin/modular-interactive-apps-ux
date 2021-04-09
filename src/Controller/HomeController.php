<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("", name="homepage")
     */
    public function index(BookRepository $repository): Response
    {
        return $this->render('home/index.html.twig', [
            'books' => $repository->getBooks(),
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(Request $request): Response
    {
        dump($request);exit;
        // TODO
    }
}
