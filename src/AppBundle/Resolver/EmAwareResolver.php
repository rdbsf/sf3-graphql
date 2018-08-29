<?php
namespace AppBundle\Resolver;
use Doctrine\ORM\EntityManager;

class EmAwareResolver
{

    protected $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function repo($entityName) {
        return $this->em->getRepository($entityName);
    }
    
}
