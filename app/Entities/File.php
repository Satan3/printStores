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
}
