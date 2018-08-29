<?php
namespace AppBundle\Resolver;

use Symfony\Component\HttpFoundation\ParameterBag;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Author;
use AppBundle\Exceptions\UserErrorException;

class AuthorsResolver extends EmAwareResolver
{

    public function repo($entityName = 'AppBundle:Author') {
        return parent::repo($entityName);
    }
    
    public function delete($args)
    {
        $author = $this->repo()->find( $args['id'] );
        $this->em->remove($author);
        $this->em->flush();
        return $this->repo()->findAll();
    }

    public function edit($args)
    {
        $author = $this->repo()->find( $args['id'] );
        $author->setName($args['name']);
        $this->em->flush();
        return $author;
    }

     public function register($args)
    {
        $name = $args['name'];
        $bio = $args['bio'];
        $author = new Author;
        $author->setName($name);
        $author->setBio($bio);
        $this->em->persist($author);
        $this->em->flush();
        return $author;
    }

    public function findOne($args)
    {   
        $id = $args['id'];
        $author = $this->repo()->find( $id );
        if(!$author) throw new \RuntimeException("Author not found for id " . $id, 1);
        return $author;
    }

    public function find($args)
    {
        return $this->repo()->findAll();
    }
    
}