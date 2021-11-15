<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="float")
     */
    private $streetNo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="float")
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $floor;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, mappedBy="client", cascade={"persist", "remove"})
     */
    private $relatedClient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getStreetNo(): ?float
    {
        return $this->streetNo;
    }

    public function setStreetNo(float $streetNo): self
    {
        $this->streetNo = $streetNo;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostcode(): ?float
    {
        return $this->postcode;
    }

    public function setPostcode(float $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getRelatedClient(): ?Client
    {
        return $this->relatedClient;
    }

    public function setRelatedClient(Client $relatedClient): self
    {
        // set the owning side of the relation if necessary
        if ($relatedClient->getClient() !== $this) {
            $relatedClient->setClient($this);
        }

        $this->relatedClient = $relatedClient;

        return $this;
    }
}
