<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name = "student")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentRepository")
 * @UniqueEntity("email")
 * @ORM\HasLifecycleCallbacks()
 */
class Student implements AdvancedUserInterface
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @ORM\OneToMany(targetEntity="Notes", mappedBy="student")
     */
    protected $id;


    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *      pattern="^[A-Z]'?[- a-zA-Z]( [a-zA-Z])*$^",
     *      match=false,
     *      message="Numele nu poate contine numere"
     *      )
     * @ORM\Column(name="first_name", type="string", length=128)
     */
    protected $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *      pattern="^[A-Z]'?[- a-zA-Z]( [a-zA-Z])*$^",
     *      match=false,
     *      message="Numele nu poate contine numere"
     *      )
     * @ORM\Column(name="last_name", type="string")
     */
    protected $lastName;

    /**
     * @Assert\NotBlank()
     * @Assert\Email(
     *      message = "E-mail-ul '{{ value }}' nu este unul valid.",
     *      checkMX=true
     *      )
     * @ORM\Column(name="email", type="string", length=128, unique = true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=72, nullable = true)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $deleted = false;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $enabled = true;

    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getDeleted() {
        return $this->deleted;
    }

    function getEnabled() {
        return $this->enabled;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() {
        
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        
    }

    public function isAccountNonExpired() {
        
    }

    public function isAccountNonLocked() {
        
    }

    public function isCredentialsNonExpired() {
        
    }

    public function isEnabled() {
        
    }

}
