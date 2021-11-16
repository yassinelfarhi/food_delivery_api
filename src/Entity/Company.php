<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
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
     * @ORM\Column(type="string", length=255)
     */
    private $imprint;

    /**
     * @ORM\Column(type="float")
     */
    private $minDeliveryAmount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=DeliveryTime::class, inversedBy="relatedCompanies")
     */
    private $deliveryTimes;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="relatedCompany")
     */
    private $paymentMethods;

    /**
     * @ORM\OneToMany(targetEntity=Postcode::class, mappedBy="relatedCompany")
     */
    private $deliveryPostcodes;

    /**
     * @ORM\OneToOne(targetEntity=Rating::class, inversedBy="relatedCompany", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $rating;

    /**
     * @ORM\OneToMany(targetEntity=EMail::class, mappedBy="company")
     */
    private $relatedEmails;

    public function __construct()
    {
        $this->deliveryTimes = new ArrayCollection();
        $this->paymentMethods = new ArrayCollection();
        $this->deliveryPostcodes = new ArrayCollection();
        $this->relatedEmails = new ArrayCollection();
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

    public function getImprint(): ?string
    {
        return $this->imprint;
    }

    public function setImprint(string $imprint): self
    {
        $this->imprint = $imprint;

        return $this;
    }

    public function getMinDeliveryAmount(): ?float
    {
        return $this->minDeliveryAmount;
    }

    public function setMinDeliveryAmount(float $minDeliveryAmount): self
    {
        $this->minDeliveryAmount = $minDeliveryAmount;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|DeliveryTime[]
     */
    public function getDeliveryTimes(): Collection
    {
        return $this->deliveryTimes;
    }

    public function addDeliveryTime(DeliveryTime $deliveryTime): self
    {
        if (!$this->deliveryTimes->contains($deliveryTime)) {
            $this->deliveryTimes[] = $deliveryTime;
        }

        return $this;
    }

    public function removeDeliveryTime(DeliveryTime $deliveryTime): self
    {
        $this->deliveryTimes->removeElement($deliveryTime);

        return $this;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getPaymentMethods(): Collection
    {
        return $this->paymentMethods;
    }

    public function addPaymentMethod(Payment $paymentMethod): self
    {
        if (!$this->paymentMethods->contains($paymentMethod)) {
            $this->paymentMethods[] = $paymentMethod;
            $paymentMethod->setRelatedCompany($this);
        }

        return $this;
    }

    public function removePaymentMethod(Payment $paymentMethod): self
    {
        if ($this->paymentMethods->removeElement($paymentMethod)) {
            // set the owning side to null (unless already changed)
            if ($paymentMethod->getRelatedCompany() === $this) {
                $paymentMethod->setRelatedCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Postcode[]
     */
    public function getDeliveryPostcodes(): Collection
    {
        return $this->deliveryPostcodes;
    }

    public function addDeliveryPostcode(Postcode $deliveryPostcode): self
    {
        if (!$this->deliveryPostcodes->contains($deliveryPostcode)) {
            $this->deliveryPostcodes[] = $deliveryPostcode;
            $deliveryPostcode->setRelatedCompany($this);
        }

        return $this;
    }

    public function removeDeliveryPostcode(Postcode $deliveryPostcode): self
    {
        if ($this->deliveryPostcodes->removeElement($deliveryPostcode)) {
            // set the owning side to null (unless already changed)
            if ($deliveryPostcode->getRelatedCompany() === $this) {
                $deliveryPostcode->setRelatedCompany(null);
            }
        }

        return $this;
    }

    public function getRating(): ?Rating
    {
        return $this->rating;
    }

    public function setRating(Rating $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return Collection|EMail[]
     */
    public function getRelatedEmails(): Collection
    {
        return $this->relatedEmails;
    }

    public function addRelatedEmail(EMail $relatedEmail): self
    {
        if (!$this->relatedEmails->contains($relatedEmail)) {
            $this->relatedEmails[] = $relatedEmail;
            $relatedEmail->setCompany($this);
        }

        return $this;
    }

    public function removeRelatedEmail(EMail $relatedEmail): self
    {
        if ($this->relatedEmails->removeElement($relatedEmail)) {
            // set the owning side to null (unless already changed)
            if ($relatedEmail->getCompany() === $this) {
                $relatedEmail->setCompany(null);
            }
        }

        return $this;
    }
}
