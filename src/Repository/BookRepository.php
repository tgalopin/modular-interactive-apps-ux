<?php

namespace App\Repository;

use App\Repository\Model\Book;
use Symfony\Component\String\Slugger\SluggerInterface;

class BookRepository
{
    private const DATA = [
        1 => [
            'Don Quixote',
            'The plot revolves around the adventures of a noble (hidalgo) from La Mancha named Alonso Quixano, '.
            'who reads so many chivalric romances that he loses his mind and decides to become a knight-errant '.
            '(caballero andante) to revive chivalry and serve his nation, under the name Don Quixote de la Mancha.',
        ],
        2 => [
            'A Tale of Two Cities',
            'The novel tells the story of the French Doctor Manette, his 18-year-long imprisonment in the Bastille '.
            'in Paris and his release to live in London with his daughter Lucie, whom he had never met. The story '.
            'is set against the conditions that led up to the French Revolution and the Reign of Terror.',
        ],
        3 => [
            'The Lord of the Rings',
            'The Lord of the Rings is an epic high fantasy novel by the English author and scholar J. R. R. Tolkien. '.
            'Set in Middle-earth, the world at some distant time in the past, the story began as a sequel to Tolkien\'s '.
            '1937 children \'s book The Hobbit, but eventually developed into a much larger work.',
        ],
        4 => [
            'Harry Potter and the Sorcerer\'s Stone',
            'Harry, Ron, and Hermione deduce that the treasure under the trapdoor is the Philosopher\'s Stone, '.
            'which can transform metal into gold and can also confer immortality. They later discover that Voldemort '.
            'has been killing unicorns in the Forbidden Forest and drinking their blood, another way to achieve '.
            'immortality.',
        ],
    ];

    private SluggerInterface $slugger;

    private array $registry = [];

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    /**
     * @return Book[]
     */
    public function getBooks(): array
    {
        $this->buildRegistry();

        return array_values($this->registry);
    }

    public function getBook(int $id): ?Book
    {
        $this->buildRegistry();

        return $this->registry[$id] ?? null;
    }

    private function buildRegistry()
    {
        if ($this->registry) {
            return;
        }

        foreach (self::DATA as $id => [$name, $desc]) {
            $slug = $this->slugger->slug($name)->lower();
            $this->registry[$id] = new Book($id, $name, $slug, 'books/'.$id.'.jpg', 'books/thumbnail-'.$id.'.jpg', $desc);
        }
    }
}
