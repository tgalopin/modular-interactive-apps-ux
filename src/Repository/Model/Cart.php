<?php

namespace App\Repository\Model;

class Cart implements \Countable
{
    public function __construct(
        private array $books = [],
    ) {
    }

    public function setQuantity(Book $book, int $quantity)
    {
        $this->books[$book->getId()] = [
            'book' => $book,
            'quantity' => $quantity,
        ];
    }

    public function removeBook(int $id)
    {
        unset($this->books[$id]);
    }

    public function count(): int
    {
        return array_sum(array_column($this->books, 'quantity'));
    }

    public function getBooks(): iterable
    {
        foreach ($this->books as $item) {
            yield $item['book'] => $item['quantity'];
        }
    }
}
