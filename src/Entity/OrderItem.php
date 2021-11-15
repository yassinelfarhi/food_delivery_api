<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 */
class OrderItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $count;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $relatedOrder;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="relatedOrderItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\OneToMany(targetEntity=Addon::class, mappedBy="relatedOrderItem")
     */
    private $selectedAddons;

    public function __construct()
    {
        $this->selectedAddons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getRelatedOrder(): ?Order
    {
        return $this->relatedOrder;
    }

    public function setRelatedOrder(?Order $relatedOrder): self
    {
        $this->relatedOrder = $relatedOrder;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Collection|Addon[]
     */
    public function getSelectedAddons(): Collection
    {
        return $this->selectedAddons;
    }

    public function addSelectedAddon(Addon $selectedAddon): self
    {
        if (!$this->selectedAddons->contains($selectedAddon)) {
            $this->selectedAddons[] = $selectedAddon;
            $selectedAddon->setRelatedOrderItem($this);
        }

        return $this;
    }

    public function removeSelectedAddon(Addon $selectedAddon): self
    {
        if ($this->selectedAddons->removeElement($selectedAddon)) {
            // set the owning side to null (unless already changed)
            if ($selectedAddon->getRelatedOrderItem() === $this) {
                $selectedAddon->setRelatedOrderItem(null);
            }
        }

        return $this;
    }
}
