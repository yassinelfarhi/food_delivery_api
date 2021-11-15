<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AddonRepository::class)
 */
class Addon
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
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=OrderItem::class, inversedBy="selectedAddons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $relatedOrderItem;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="addons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $relatedProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRelatedOrderItem(): ?OrderItem
    {
        return $this->relatedOrderItem;
    }

    public function setRelatedOrderItem(?OrderItem $relatedOrderItem): self
    {
        $this->relatedOrderItem = $relatedOrderItem;

        return $this;
    }

    public function getRelatedProduct(): ?Product
    {
        return $this->relatedProduct;
    }

    public function setRelatedProduct(?Product $relatedProduct): self
    {
        $this->relatedProduct = $relatedProduct;

        return $this;
    }
}
