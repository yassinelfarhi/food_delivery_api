<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PaymentRepository::class)
 */
class Payment
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
     * @ORM\OneToOne(targetEntity=PaymentStatus::class, inversedBy="relatedPayment", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $paymentStatus;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="relatedPayments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=Link::class, mappedBy="relatedPayment")
     */
    private $links;

    /**
     * @ORM\OneToOne(targetEntity=Coupon::class, inversedBy="relatedPayment", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $coupon;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="paymentMethods")
     * @ORM\JoinColumn(nullable=true)
     */
    private $relatedCompany;

    public function __construct()
    {
        $this->links = new ArrayCollection();
    }

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

    public function getPaymentStatus(): ?PaymentStatus
    {
        return $this->client;
    }

    public function setPaymentStatus(PaymentStatus $client): self
    {
        $this->client = $client;

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
     * @return Collection|Link[]
     */
    public function getLinks(): Collection
    {
        return $this->links;
    }

    public function addLink(Link $link): self
    {
        if (!$this->links->contains($link)) {
            $this->links[] = $link;
            $link->setRelatedPayment($this);
        }

        return $this;
    }

    public function removeLink(Link $link): self
    {
        if ($this->links->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getRelatedPayment() === $this) {
                $link->setRelatedPayment(null);
            }
        }

        return $this;
    }

    public function getCoupon(): ?Coupon
    {
        return $this->coupon;
    }

    public function setCoupon(Coupon $coupon): self
    {
        $this->coupon = $coupon;

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
