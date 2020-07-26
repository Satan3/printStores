<?php

namespace App\Entities;

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
     * @ORM\OneToOne(targetEntity="File", mappedBy="entityId")
     */
    private $file;

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

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'file' => $this->getFile()->getPath(),
        ];
    }
}
