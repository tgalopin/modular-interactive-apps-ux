<?php

namespace App\Twig;

use App\Repository\CartRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CartExtension extends AbstractExtension
{
    public function __construct(
        private readonly CartRepository $repository,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('count_cart_items', $this->countCartItems(...)),
        ];
    }

    public function countCartItems()
    {
        return $this->repository->getCart()->count();
    }
}
