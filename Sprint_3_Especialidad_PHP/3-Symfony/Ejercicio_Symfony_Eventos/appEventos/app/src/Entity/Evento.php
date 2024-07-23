<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventoRepository")
 */
class Evento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $nombre;
    /**
     * @ORM\Column(type="string", length=255)
     */

    private $ubicacion;
    /**
     * @ORM\Column(type="datetime")
     */

    private $fecha;

    private $hora;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $detalles;

    // Getters y Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(string $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }
    public function getHora(): ?\DateTimeInterface
    {
        return $this->hora;
    }

    public function setHora(\DateTimeInterface $hora): self
    {
        $this->hora = $hora;

        return $this;
    }
    public function getDetalles(): ?string
    {
        return $this->detalles;
    }

    public function setDetalles(string $detalles): self
    {
        $this->detalles = $detalles;

        return $this;
    }

    public function combinarFechaYHora()
    {
        // Combinar fecha y hora en un solo objeto DateTime
        $fechaHora = new \DateTime();
        $fechaHora->setDate($this->fecha->format('Y'), $this->fecha->format('m'), $this->fecha->format('d'));
        $fechaHora->setTime($this->hora->format('H'), $this->hora->format('i'));

        return $fechaHora;
    }
}

?>