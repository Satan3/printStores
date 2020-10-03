<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Review
 * @package App\Entities
 *
 * @ORM\Entity(repositoryClass="\App\Repositories\ReviewRepository")
 * @ORM\Table(name="reviews")
 */
class Review extends BaseEntity {

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $personName;

    /** @var int
     * @ORM\Column(type="integer")
     */
    private $rating;

    /** @var string
     * @ORM\Column(type="string")
     */
    private $message;

    /** @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): int {
        return $this->id;
    }

    public function getPersonName(): string {
        return $this->personName;
    }

    public function setPersonName(string $name): self {
        $this->personName = $name;
        return $this;
    }

    public function getRating(): int {
        return $this->rating;
    }

    public function setRating(int $rating): self {
        $this->rating = $rating;
        return $this;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function setMessage(string $message): self {
        $this->message = $message;
        return $this;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'personName' => $this->getPersonName(),
            'message' => $this->getMessage(),
            'rating' => $this->getRating(),
            'date' => $this->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
