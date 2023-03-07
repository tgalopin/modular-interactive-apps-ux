<?php

namespace App\Repository;

use App\Repository\Model\Book;
use App\Repository\Model\Cart;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartRepository
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly BookRepository $bookRepository,
    ) {
    }

    public function getCart(): Cart
    {
        $cart = new Cart();
        foreach ($this->getSession()->get('books', []) as $id => $quantity) {
            if ($book = $this->bookRepository->getBook((int) $id)) {
                $cart->setQuantity($book, $quantity);
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
        $cart->removeBook($book->getId());

        return $this->persist($cart);
    }

    private function persist(Cart $cart): Cart
    {
        $items = [];
        foreach ($cart->getBooks() as $book => $quantity) {
            $items[$book->getId()] = $quantity;
        }

        $this->getSession()->set('books', $items);

        return $cart;
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}
