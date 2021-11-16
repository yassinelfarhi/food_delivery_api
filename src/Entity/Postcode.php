<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostcodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PostcodeRepository::class)
 */
class Postcode
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
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="deliveryPostcodes")
     * @ORM\JoinColumn(nullable=true)
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

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getRelatedCompany(): ?Company
    {
        return $this->relatedCompany;
    }

    public function setRelatedCompany(?Company $relatedCompany): self
    {
        $this->relatedCompany = $relatedCompany;

        return $this;
    }
}
