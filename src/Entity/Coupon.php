<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CouponRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $string;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="coupon")
     * @ORM\JoinColumn(nullable=false)
     */
    private $relatedOrder;

    /**
     * @ORM\OneToOne(targetEntity=Payment::class, mappedBy="coupon", cascade={"persist", "remove"})
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
