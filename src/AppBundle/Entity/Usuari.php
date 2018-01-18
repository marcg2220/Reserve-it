<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Usuari
 *
 * @ORM\Table(name="usuari")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuariRepository")
 * @UniqueEntity("email")
 * @Assert\Callback(callback={"esDniValid"})
 */
class Usuari implements UserInterface
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
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="cognoms", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $cognoms;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"registre"})
     * @Assert\Length(min=6)
     */
    private $passwordEnClar;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=9, unique=true)
     */
    private $dni;

    /**
     * @var bool
     *
     * @ORM\Column(name="accepta_email", type="boolean")
     * @Assert\Type(type="bool")
     */
    private $acceptaEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_alta", type="datetime")
     * @Assert\DateTime()
     */
    private $dataAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_naixement", type="datetime")
     * @Assert\Date()
     */
    private $dataNaixement;

    public function __construct()
    {
        $this->dataAlta = new \DateTime();
        $this->acceptaEmail = true;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set cognoms
     *
     */
    public function setCognoms($cognoms)
    {
        $this->cognoms = $cognoms;
    }

    /**
     * Get cognoms
     *
     * @return string 
     */
    public function getCognoms()
    {
        return $this->cognoms;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPasswordEnClar()
    {
        return $this->passwordEnClar;
    }

    /**
     * @param string $password
     */
    public function setPasswordEnClar($password)
    {
        $this->passwordEnClar = $password;
    }


    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get pasword
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set dni
     *
     * @param string $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set acceptaEmail
     *
     * @param boolean $acceptaEmail
     */
    public function setAcceptaEmail($acceptaEmail)
    {
        $this->acceptaEmail = $acceptaEmail;
    }

    /**
     * Get acceptaEmail
     *
     * @return boolean 
     */
    public function getAcceptaEmail()
    {
        return $this->acceptaEmail;
    }

    /**
     * Set dataAlta
     *
     * @param \DateTime $dataAlta
     */
    public function setDataAlta($dataAlta)
    {
        $this->dataAlta = $dataAlta;
    }

    /**
     * Get dataAlta
     *
     * @return \DateTime 
     */
    public function getDataAlta()
    {
        return $this->dataAlta;
    }

    /**
     * Set dataNaixement
     *
     * @param \DateTime $dataNaixement
     */
    public function setDataNaixement($dataNaixement)
    {
        $this->dataNaixement = $dataNaixement;
    }

    /**
     * Get dataNaixement
     *
     * @return \DateTime 
     */
    public function getDataNaixement()
    {
        return $this->dataNaixement;
    }

    function __toString()
    {
        return $this->getNom().' '.$this->getCognoms();
    }

    /**
     * @param ExecutionContextInterface $context
     * @Assert\Callback
     */
    public function esDniValid(ExecutionContextInterface $context)
    {
        $dni = $this->getDni();



        if (0 === preg_match('/^[XYZ]?([0-9]{7,8})([A-Z])$/i', $dni))
        {
            $context->buildViolation("El DNI no te el format correcte: entre 1 i 8 números seguits d'una lletra (sense guions ni espais)")
                ->atPath('dni')
                ->addViolation();
            return;
        }

        $numero = substr($dni, 0, -1);
        $lletra = strtoupper(substr($dni,-1));
        if ($lletra !== substr('TRWAGMYFPDXBNJZSQVHLCKE', strtr($numero,'XYZ','012') % 23, 1))
        {
            $context->buildViolation('La lletra del DNI no és correcta pel número indicat')
                ->atPath('dni')
                ->addViolation();
        }
    }


    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_USUARI');
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->passwordEnClar = null;
    }
}
