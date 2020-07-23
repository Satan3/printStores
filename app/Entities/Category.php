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
class Category {

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

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}
