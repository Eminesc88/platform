<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "faculty")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FacultyRepository")
 */
class Faculty {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="faculty", type="string", length=128 )
     */
    protected $faculty;
    
    
    function getId() {
        return $this->id;
    }

    function getFaculty() {
        return $this->faculty;
    }

    
    function setId($id) {
        $this->id = $id;
    }

    function setFaculty($faculty) {
        $this->faculty = $faculty;
    }
}
