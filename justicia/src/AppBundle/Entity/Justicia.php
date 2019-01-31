<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Justicia
 *
 * @ORM\Table(name="justicia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JusticiaRepository")
 */
class Justicia implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50)
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "La contraseña debe tener mínimo 5 carácteres"
     * )
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="superpoder", type="string", length=100)
     * @Assert\NotBlank
     */
    private $superpoder;

    /**
     * @var array
     *
     * @ORM\Column(name="role", type="string")
     */
    private $role;


    public function __construct()
    {
        $this->role = array('ROLE_RESTO');
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Justicia
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Justicia
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set superpoder
     *
     * @param string $superpoder
     *
     * @return Justicia
     */
    public function setSuperpoder($superpoder)
    {
        $this->superpoder = $superpoder;

        return $this;
    }

    /**
     * Get superpoder
     *
     * @return string
     */
    public function getSuperpoder()
    {
        return $this->superpoder;
    }

    /**
     * Set role
     *
     * @param array $role
     *
     * @return Justicia
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return array
     */
    public function getRole()
    {
        return $this->role;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
        //return this->role;
    }

    public function eraseCredentials()
    {
    }
}

