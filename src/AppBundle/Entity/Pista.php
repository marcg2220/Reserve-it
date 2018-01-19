<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 10/01/2018
 * Time: 16:03
 */

namespace AppBundle\Entity;

use AppBundle\Entity\TipusPista;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pista
 *
 * @ORM\Table(name="pista")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PistaRepository")
 */
class Pista
{

    /**
     * @ORM\Column(name="id", type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipusPista")
     */
    protected $tipus_pista;

    /**
     * @var string
     *
     * @ORM\Column(name="num_pista", type="integer")
     */
    protected $num_pista;


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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tipus_pista
     *
     * @param TipusPista $tipus_pista
     * @return Pista
     */
    public function setTipusPista(TipusPista $tipus_pista = null)
    {
        $this->tipus_pista = $tipus_pista;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipusPista()
    {
        return $this->tipus_pista;
    }

    /**
     * @return mixed
     */
    public function getNumPista()
    {
        return $this->num_pista;
    }

    /**
     * @param mixed $num_pista
     */
    public function setNumPista($num_pista)
    {
        $this->num_pista = $num_pista;
    }

    function __toString()
    {
        return "Pista ".$this->getId()."-".$this->getTipusPista();
    }

}
