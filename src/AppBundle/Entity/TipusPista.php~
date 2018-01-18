<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 12/01/2018
 * Time: 09:39
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContext;

/**
 * Usuari
 *
 * @ORM\Table(name="tipus_pista")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TipusPistaRepository")
 */
class TipusPista
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @ORM\Column(name="descripcio", type="string", length=20)
     */
    protected $descripcio;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescripcio()
    {
        return $this->descripcio;
    }

    /**
     * @param mixed $descripcio
     */
    public function setDescripcio($descripcio)
    {
        $this->descripcio = $descripcio;
    }

    function __toString()
    {
        return $this->getDescripcio();
    }


}
