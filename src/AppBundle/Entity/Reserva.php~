<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservaRepository")
 */
class Reserva
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
     * @var Pista
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pista")
     */
    private $pista;

    /**
     * @var Usuari
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuari")
     */
    private $usuari;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dia_reserva", type="datetime")
     */
    private $diaReserva;

    /**
     * @var string
     *
     * @ORM\Column(name="hora_entrada", type="string", length=255)
     */
    private $horaEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="hora_sortida", type="string", length=255)
     */
    private $horaSortida;


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
     * Set pista
     *
     * @param string $pista
     * @return Reserva
     */
    public function setPista($pista)
    {
        $this->pista = $pista;

        return $this;
    }

    /**
     * Get pista
     *
     * @return string 
     */
    public function getPista()
    {
        return $this->pista;
    }

    /**
     * Set usuari
     *
     * @param string $usuari
     * @return Reserva
     */
    public function setUsuari($usuari)
    {
        $this->usuari = $usuari;

        return $this;
    }

    /**
     * Get usuari
     *
     * @return string 
     */
    public function getUsuari()
    {
        return $this->usuari;
    }

    /**
     * Set diaReserva
     *
     * @param \DateTime $diaReserva
     * @return Reserva
     */
    public function setDiaReserva($diaReserva)
    {
        $this->diaReserva = $diaReserva;

        return $this;
    }

    /**
     * Get diaReserva
     *
     * @return \DateTime 
     */
    public function getDiaReserva()
    {
        return $this->diaReserva;
    }

    /**
     * Set horaEntrada
     *
     * @param string $horaEntrada
     * @return Reserva
     */
    public function setHoraEntrada($horaEntrada)
    {
        $this->horaEntrada = $horaEntrada;

        return $this;
    }

    /**
     * Get horaEntrada
     *
     * @return string 
     */
    public function getHoraEntrada()
    {
        return $this->horaEntrada;
    }

    /**
     * Set horaSortida
     *
     * @param string $horaSortida
     * @return Reserva
     */
    public function setHoraSortida($horaSortida)
    {
        $this->horaSortida = $horaSortida;

        return $this;
    }

    /**
     * Get horaSortida
     *
     * @return string 
     */
    public function getHoraSortida()
    {
        return $this->horaSortida;
    }

    function __toString()
    {
        return $this->getDiaReserva().' '.$this->getHoraEntrada().' '.$this->getPista().' '.$this->getUsuari();
    }


}
