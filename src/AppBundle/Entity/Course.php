<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "course")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CourseRepository")
 */
class Course {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="course", type="string", length=128 )
     */
    private $course;
    
    /**
     * @ORM\ManyToOne(targetEntity="Faculty")
     * @ORM\JoinColumn(name="faculty", referencedColumnName="id"))
     */
    private $faculty;
    
    function getId() {
        return $this->id;
    }

    function getCourse() {
        return $this->course;
    }

    function getFaculty() {
        return $this->faculty;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCourse($course) {
        $this->course = $course;
    }

    function setFaculty($faculty) {
        $this->faculty = $faculty;
    }


}
