<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\CartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book")
 */
class BookController extends AbstractController
{
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/{id}", name="book_view")
     */
    public function view(int $id): Response
    {
        if (!$book = $this->repository->getBook($id)) {
            throw $this->createNotFoundException();
        }

        return $this->render('book/view.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/{id}/add-to-cart", name="book_add_to_cart")
     */
    public function addToCart(CartRepository $cart, int $id): Response
    {
        if (!$book = $this->repository->getBook($id)) {
            throw $this->createNotFoundException();
        }

        $cart->setQuantity($book, 1);

        return $this->redirectToRoute('my_cart');
    }
}
