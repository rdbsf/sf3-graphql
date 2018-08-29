<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Book;
use AppBundle\Entity\Author;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    
    // Very important to remove this route since graphql will use it
    // /**
    //  * @Route("/", name="homepage")
    //  */
    // public function indexAction(Request $request)
    // {
    //     // replace this example code with whatever you need
    //     return $this->render('default/index.html.twig', [
    //         'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
    //     ]);
    // }

    /**
     * @Route("/add", name="book_add")
     */
    public function createAction()
    {
        
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $author = new Author();
        $author->setName('Ray Bradbury');
        $author->setBio('Here is some info about him.');
        $entityManager->persist($author);

        $book = new Book();
        $book->setTitle('First Book');
        $book->setPages(134);
        $book->setDescription('this is the 1st book description!');
        $book->addAuthor($author);
        
        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new book with id '.$book->getId());
    }

}
