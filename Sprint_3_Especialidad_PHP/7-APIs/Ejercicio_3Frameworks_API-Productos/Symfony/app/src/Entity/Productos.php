<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\Double;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductosRepository")
 */
class Productos
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

    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */

     private $description;

    /**
     * @ORM\Column(type="integer")
     */

    private $stock;
    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    // Getters y Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }


}

?>