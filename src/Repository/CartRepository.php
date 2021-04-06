<?php

namespace App\Repository;

use App\Repository\Model\Book;
use App\Repository\Model\Cart;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartRepository
{
    private SessionInterface $session;
    private BookRepository $bookRepository;

    public function __construct(SessionInterface $session, BookRepository $bookRepository)
    {
        $this->session = $session;
        $this->bookRepository = $bookRepository;
    }

    public function getCart(): Cart
    {
        $cart = new Cart();
        foreach ($this->session->get('books', []) as $id => $quantity) {
            if ($book = $this->bookRepository->getBook((int) $id)) {
                $cart->setQuantity($this->bookRepository->getBook((int) $id), $quantity);
            }
        }

        return $this->persist($cart);
    }

    public function setQuantity(Book $book, int $quantity): Cart
    {
        $cart = $this->getCart();
        $cart->setQuantity($book, $quantity);

        return $this->persist($cart);
    }

    public function removeBook(Book $book): Cart
    {
        $cart = $this->getCart();
        $cart->remveBook($book->getId());

        return $this->persist($cart);
    }

    private function persist(Cart $cart): Cart
    {
        $items = [];
        foreach ($cart->getBooks() as $book => $quantity) {
            $items[$book->getId()] = $quantity;
        }

        $this->session->set('books', $items);

        return $cart;
    }
}
