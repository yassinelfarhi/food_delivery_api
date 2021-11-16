<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CouponRepository;
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
 *     shortName="coupons",
 *     normalizationContext={"groups"={"coupons:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"coupons:write"}, "swagger_definition_name"="Write"},
 * )
 * @ORM\Entity(repositoryClass=CouponRepository::class)
 */
class Coupon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"coupons:read", "coupons:write"})
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"coupons:read", "coupons:write"})
     */
    private $string;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="coupon")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"coupons:read", "coupons:write"})
     */
    private $relatedOrder;

    /**
     * @ORM\OneToOne(targetEntity=Payment::class, mappedBy="coupon", cascade={"persist", "remove"})
     * @Groups({"coupons:read", "coupons:write"})
     */
    private $relatedPayment;

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

    public function getString(): ?string
    {
        return $this->string;
    }

    public function setString(string $string): self
    {
        $this->string = $string;

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

    public function getRelatedPayment(): ?Payment
    {
        return $this->relatedPayment;
    }

    public function setRelatedPayment(Payment $relatedPayment): self
    {
        // set the owning side of the relation if necessary
        if ($relatedPayment->getCoupon() !== $this) {
            $relatedPayment->setCoupon($this);
        }

        $this->relatedPayment = $relatedPayment;

        return $this;
    }
}
