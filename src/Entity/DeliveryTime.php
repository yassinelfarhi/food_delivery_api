<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DeliveryTimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=DeliveryTimeRepository::class)
 */
class DeliveryTime
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
    private $sender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $receiver;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\ManyToMany(targetEntity=Company::class, mappedBy="deliveryTimes")
     */
    private $relatedCompanies;

    public function __construct()
    {
        $this->relatedCompanies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiver(): ?string
    {
        return $this->receiver;
    }

    public function setReceiver(string $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection|Company[]
     */
    public function getRelatedCompanies(): Collection
    {
        return $this->relatedCompanies;
    }

    public function addRelatedCompany(Company $relatedCompany): self
    {
        if (!$this->relatedCompanies->contains($relatedCompany)) {
            $this->relatedCompanies[] = $relatedCompany;
            $relatedCompany->addDeliveryTime($this);
        }

        return $this;
    }

    public function removeRelatedCompany(Company $relatedCompany): self
    {
        if ($this->relatedCompanies->removeElement($relatedCompany)) {
            $relatedCompany->removeDeliveryTime($this);
        }

        return $this;
    }
}
