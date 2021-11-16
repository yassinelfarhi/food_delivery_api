<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put", "delete"},
 *     shortName="order_items",
 *     normalizationContext={"groups"={"order_items:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"order_items:write"}, "swagger_definition_name"="Write"},
 * )
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
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"order_items:read", "order_items:write"})
     */
    private $relatedOrder;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="relatedOrderItems")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"order_items:read", "order_items:write"})
     */
    private $product;

    /**
     * @ORM\OneToMany(targetEntity=Addon::class, mappedBy="relatedOrderItem")
     * @Groups({"order_items:read", "order_items:write"})
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
