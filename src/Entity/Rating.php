<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=RatingRepository::class)
 */
class Rating
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $number;

    /**
     * @ORM\OneToOne(targetEntity=Company::class, mappedBy="rating", cascade={"persist", "remove"})
     */
    private $relatedCompany;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?float
    {
        return $this->number;
    }

    public function setNumber(float $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getRelatedCompany(): ?Company
    {
        return $this->relatedCompany;
    }

    public function setRelatedCompany(Company $relatedCompany): self
    {
        // set the owning side of the relation if necessary
        if ($relatedCompany->getRating() !== $this) {
            $relatedCompany->setRating($this);
        }

        $this->relatedCompany = $relatedCompany;

        return $this;
    }
}
