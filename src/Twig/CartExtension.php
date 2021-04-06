<?php

namespace App\Twig;

use App\Repository\CartRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CartExtension extends AbstractExtension
{
    private CartRepository $repository;

    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('count_cart_items', [$this, 'countCartItems']),
        ];
    }

    public function countCartItems()
    {
        return $this->repository->getCart()->count();
    }
}
