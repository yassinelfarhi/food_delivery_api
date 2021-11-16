<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderRepository;
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
 *     shortName="orders",
 *     normalizationContext={"groups"={"orders:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"orders:write"}, "swagger_definition_name"="Write"},
 *     )
 * @ApiFilter(SearchFilter::class, properties={"Search"})
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"orders:read","orders:write"})
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"orders:read","orders:write"})
     */
    private $deliveryDate;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"orders:read","orders:write"})
     */
    private $complete;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="relatedOrder", cascade={"persist"})
     * @Groups({"orders:read","orders:write"})
     */
    private $orderItems;

    /**
     * @ORM\OneToOne(targetEntity=OrderStatus::class, inversedBy="relatedOrder", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"orders:read","orders:write"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="relatedOrders")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"orders:read","orders:write"})
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=Coupon::class, mappedBy="relatedOrder")
     * @Groups({"orders:read","orders:write"})
     */
    private $coupon;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
        $this->coupon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getComplete(): ?bool
    {
        return $this->complete;
    }

    public function setComplete(bool $complete): self
    {
        $this->complete = $complete;

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems[] = $orderItem;
            $orderItem->setRelatedOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getRelatedOrder() === $this) {
                $orderItem->setRelatedOrder(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(OrderStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|Coupon[]
     */
    public function getCoupon(): Collection
    {
        return $this->coupon;
    }

    public function addCoupon(Coupon $coupon): self
    {
        if (!$this->coupon->contains($coupon)) {
            $this->coupon[] = $coupon;
            $coupon->setRelatedOrder($this);
        }

        return $this;
    }

    public function removeCoupon(Coupon $coupon): self
    {
        if ($this->coupon->removeElement($coupon)) {
            // set the owning side to null (unless already changed)
            if ($coupon->getRelatedOrder() === $this) {
                $coupon->setRelatedOrder(null);
            }
        }

        return $this;
    }
}
