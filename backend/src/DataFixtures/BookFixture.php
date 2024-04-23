<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $books = $this->getDummyBooks();
        foreach ($books as $bookData) {
            $book = new Book();
            $book->setTitle($bookData['title']);
            $book->setAuthor($bookData['author']);
            $book->setDate($bookData['date']);
            $book->setStatus($bookData['status']);

            // Persist the entity
            $manager->persist($book);
        }

        $manager->flush();
    }

    private function getDummyBooks(): array
    {
        return [
                [
                    'title' => 'Oedipus at Colonus',
                    'author' => 'Jebb, Richard Claverhouse, Sir, 1841-1905',
                    'date' => '1930',
                    'status' => 'free'
                ],
                [
                    'title' => 'The Iliad',
                    'author' => 'Bryant, William Cullen, 1794-1878',
                    'date' => 'c1870',
                    'status' => 'free'
                ],
                [
                    'title' => 'The Prometheus',
                    'author' => 'Buckley, Theodore Alois, 1825-1856',
                    'date' => '1899',
                    'status' => 'free'
                ],
                [
                    'title' => 'Parmenides',
                    'author' => 'Maguire, Thomas, 1831-1889',
                    'date' => '1882',
                    'status' => 'free'
                ],
                [
                    'title' => 'Caesar (Anthologized)',
                    'author' => 'Dryden, John, 1631-1700;Clough, Arthur Hugh, 1819-1861',
                    'date' => 'c1909',
                    'status' => 'free'
                ],
                [
                    'title' => 'Enneads',
                    'author' => 'Mackenna, Stephen, 1872-1934',
                    'date' => '1921',
                    'status' => 'free'
                ],
                [
                    'title' => 'Divine Comedy (Inferno, vol 1)',
                    'author' => 'Dante Alighieri, trans, Longfellow',
                    'date' => '1867',
                    'status' => 'free'
                ],
                [
                    'title' => 'The prince',
                    'author' => 'Machiavelli, Niccolo, 1469-1527;Marriott, W. K. (William K.)',
                    'date' => '1908',
                    'status' => 'free'
                ],
                [
                    'title' => 'The Tempest',
                    'author' => 'Shakespeare, William, 1564-1616;Sprague, Homer Baxter, 1829-1918',
                    'date' => '1896',
                    'status' => 'free'
                ],
                [
                    'title' => 'Hamlet',
                    'author' => 'Shakespeare, William, 1564-1616;Booth, Edwin, 1833-1893;Winter, William, 1836-1917',
                    'date' => '1878',
                    'status' => 'free'
                ],
                [
                    'title' => 'Sonnets',
                    'author' => 'Shakespeare, William, 1564-1616;Oxford University Press;Lee, Sidney, Sir, 1859-1926',
                    'date' => '1905',
                    'status' => 'free'
                ],
                [
                    'title' => 'Middlemarch',
                    'author' => 'Eliot, George, 1819-1880',
                    'date' => '1902',
                    'status' => 'free'
                ],
                [
                    'title' => 'Theologico-Political Treatise',
                    'author' => 'Benedictus de Spinoza',
                    'date' => '1862',
                    'status' => 'free'
                ],
                [
                    'title' => 'Principia',
                    'author' => 'Newton, Isaac, Sir, 1642-1727;Frost, Percival, 1817-1898',
                    'date' => '1854',
                    'status' => 'free'
                ],
                [
                    'title' => 'Treatise on Human Nature (2 volumes)',
                    'author' => 'Hume, David, 1711-1776',
                    'date' => '1911',
                    'status' => 'free'
                ],
                [
                    'title' => 'Social Contract',
                    'author' => 'Rousseau, Jean-Jacques, 1712-1778;Cole, G. D. H. (George Douglas Howard), 1889-1959',
                    'date' => '1923',
                    'status' => 'free'
                ],
                [
                    'title' => 'Discourses',
                    'author' => 'Rousseau, Jean-Jacques, 1712-1778',
                    'date' => '1761',
                    'status' => 'free'
                ],
                [
                    'title' => 'Le Misanthrope (Anthologized)',
                    'author' => 'Moliere, 1622-1673;Wormeley, Katharine Prescott, 1830-1908',
                    'date' => '1909',
                    'status' => 'free'
                ],
                [
                    'title' => 'The Wealth of Nations (vol. 1)',
                    'author' => 'Smith, Adam, 1723-1790',
                    'date' => '1910',
                    'status' => 'free'
                ],
                [
                    'title' => 'Pride and Prejudice',
                    'author' => 'Austen, Jane, 1775-1817;Thomson, Hugh, 1860-1920, ill',
                    'date' => '1906',
                    'status' => 'free'
                ],

            ];
    }
}
