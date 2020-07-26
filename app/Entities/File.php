<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class File
 * @package App\Entities
 *
 * @ORM\Entity(repositoryClass="\App\Repositories\FileRepository")
 * @ORM\Table(name="files")
 */
class File {

    /**
     * @var int $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string $path
     * @ORM\Column(type="string")
     */
    private $path;

    /**
     * @var string $type
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @var int $entityId
     * @ORM\Column(type="integer")
     */
    private $entityId;

    public function getId(): int {
        return $this->id;
    }

    public function getPath(): string {
        return $this->path;
    }

    public function setPath($path): self {
        $this->path = $path;
        return $this;
    }

    public function getType(): string {
        return $this->type;
    }

    public function setType($type): self {
        $this->type = $type;
        return $this;
    }

    public function getEntityId(): int {
        return $this->entityId;
    }

    public function setEntityId($entityId): self {
        $this->entityId = $entityId;
        return $this;
    }
}
