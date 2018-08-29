<?php
namespace AppBundle\Resolver;

use Symfony\Component\HttpFoundation\ParameterBag;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Book;
use AppBundle\Exceptions\UserErrorException;

class BooksResolver extends EmAwareResolver
{

    public function repo($entityName = 'AppBundle:Book') {
        return parent::repo($entityName);
    }
    
    public function delete($args)
    {
        $book = $this->repo()->find( $args['id'] );
        $this->em->remove($book);
        $this->em->flush();
        return $this->repo()->findAll();
    }

    public function edit($args)
    {
        $book = $this->repo()->find( $args['id'] );
        $book->setTitle($args['title']);
        $this->em->flush();
        return $book;
    }

     public function register($args)
    {
        $title = $args['title'];
        $book = new Book;
        $book->setTitle($title);
        $this->em->persist($book);
        $this->em->flush();
        return $book;
    }

    public function findOne($args)
    {   
        $id = $args['id'];
        $book = $this->repo()->find( $id );
        if(!$book) throw new \RuntimeException("Book not found for id " . $id, 1);
        return $book;
    }

    public function find($args)
    {
        return $this->repo()->findAll();
    }
    
}