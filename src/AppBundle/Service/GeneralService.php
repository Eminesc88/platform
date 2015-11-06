<?php

namespace AppBundle\Service;

use AppBundle\Entity\Faculty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Controller\Admin;

class GeneralService {
    
    private $em;
    
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    
    public function getFaculty()
    {
        return $this->em->getRepository("AppBundle:Faculty")->findAll();
    }
    
    public function getFacultyId($name)
    {
        return $this->em->getRepository("AppBundle:Faculty")->findOneBy(array('faculty' => $name));
    }
    
    public function getCourse()
    {
        return $this->em->getRepository("AppBundle:Course")->findAll();
    }
    
    public function getCourseId()
    {
        return $this->em->getRepository("AppBundle:Course")->findAll();
    }
}
