<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PaymentStatusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PaymentStatusRepository::class)
 */
class PaymentStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $name = [];

    /**
     * @ORM\OneToOne(targetEntity=Payment::class, mappedBy="client", cascade={"persist", "remove"})
     */
    private $relatedPayment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?array
    {
        return $this->name;
    }

    public function setName(array $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRelatedPayment(): ?Payment
    {
        return $this->relatedPayment;
    }

    public function setRelatedPayment(Payment $relatedPayment): self
    {
        // set the owning side of the relation if necessary
        if ($relatedPayment->getClient() !== $this) {
            $relatedPayment->setClient($this);
        }

        $this->relatedPayment = $relatedPayment;

        return $this;
    }
}
