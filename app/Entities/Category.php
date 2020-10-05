<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package App\Entities
 *
 * @ORM\Entity(repositoryClass="\App\Repositories\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category extends BaseEntity {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
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
     * @var Collection
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    private $products;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $pageTitle;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $pageDescription;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $pageKeywords;

    public function __construct() {
        $this->products = new ArrayCollection();
    }

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

    public function getProducts() {
        return $this->products;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function getPageTitle(): ?string {
        return $this->pageTitle;
    }

    public function setPageTitle(string $title): self {
        $this->pageTitle = $title;
        return $this;
    }

    public function getPageDescription(): ?string {
        return $this->pageDescription;
    }

    public function setPageDescription(string $description): self {
        $this->pageDescription = $description;
        return $this;
    }

    public function getPageKeywords(): ?string {
        return $this->pageKeywords;
    }

    public function setPageKeywords(string $keywords): self {
        $this->pageKeywords = $keywords;
        return $this;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'file' => $this->getFile()->getPath(),
            'pageTitle' => $this->getPageTitle(),
            'pageDescription' => $this->getPageDescription(),
            'pageKeywords' => $this->getPageKeywords(),
        ];
    }
}
