<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package App\Entities
 *
 * @ORM\Entity(repositoryClass="\App\Repositories\ProductRepository")
 * @ORM\Table(name="products")
 */
class Product extends BaseEntity {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="File", cascade={"remove"})
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     */
    private $file;

    /**
     * @var Category $category
     * @ORM\ManyToOne(targetEntity="Category",inversedBy="products" cascade={"null"})
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $discount;

    /**
     * @ORM\Column(type="string")
     */
    private $stock;

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName($name): self {
        $this->name = $name;
        return $this;
    }

    public function getFile(): File {
        return $this->file;
    }

    public function setFile(File $file): self {
        $this->file = $file;
        return $this;
    }

    public function getCategory(): Category {
        return $this->category;
    }

    public function setCategory(Category $category): self {
        $this->category = $category;
        return $this;
    }

    public function getPrice(): int {
        return $this->price;
    }

    public function setPrice(int $price): self {
        $this->price = $price;
        return $this;
    }

    public function getDiscount(): int {
        return $this->discount;
    }

    public function setDiscount(int $discount): self {
        $this->discount = $discount;
        return $this;
    }

    public function getStock(): string {
        return $this->stock;
    }

    public function setStock(string $stock): self {
        $this->stock = $stock;
        return $this;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'file' => $this->getFile()->getPath(),
            'category' => $this->category->getId(),
            'price' => $this->getPrice(),
            'discount' => $this->getDiscount(),
            'stock' => $this->getStock(),
        ];
    }
}
