<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClientRepository;
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
 *     shortName="clients",
 *     normalizationContext={"groups"={"clients:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"clients:write"}, "swagger_definition_name"="Write"},
 * )
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clients:read", "clients:write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clients:read", "clients:write"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clients:read", "clients:write"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clients:read", "clients:write"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clients:read", "clients:write"})
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clients:read", "clients:write"})
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clients:read", "clients:write"})
     */
    private $preferedDeliveryTime;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="client", cascade={"persist"})
     * @Groups({"clients:read", "clients:write"})
     */
    private $relatedOrders;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="client", cascade={"persist"})
     * @Groups({"clients:read", "clients:write"})
     */
    private $relatedPayments;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, inversedBy="relatedClient", cascade={"persist", "remove"})
     * @Groups({"clients:read", "clients:write"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    public function __construct()
    {
        $this->relatedOrders = new ArrayCollection();
        $this->relatedPayments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getPreferedDeliveryTime(): ?string
    {
        return $this->preferedDeliveryTime;
    }

    public function setPreferedDeliveryTime(string $preferedDeliveryTime): self
    {
        $this->preferedDeliveryTime = $preferedDeliveryTime;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getRelatedOrders(): Collection
    {
        return $this->relatedOrders;
    }

    public function addRelatedOrder(Order $relatedOrder): self
    {
        if (!$this->relatedOrders->contains($relatedOrder)) {
            $this->relatedOrders[] = $relatedOrder;
            $relatedOrder->setClient($this);
        }

        return $this;
    }

    public function removeRelatedOrder(Order $relatedOrder): self
    {
        if ($this->relatedOrders->removeElement($relatedOrder)) {
            // set the owning side to null (unless already changed)
            if ($relatedOrder->getClient() === $this) {
                $relatedOrder->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getRelatedPayments(): Collection
    {
        return $this->relatedPayments;
    }

    public function addRelatedPayment(Payment $relatedPayment): self
    {
        if (!$this->relatedPayments->contains($relatedPayment)) {
            $this->relatedPayments[] = $relatedPayment;
            $relatedPayment->setClient($this);
        }

        return $this;
    }

    public function removeRelatedPayment(Payment $relatedPayment): self
    {
        if ($this->relatedPayments->removeElement($relatedPayment)) {
            // set the owning side to null (unless already changed)
            if ($relatedPayment->getClient() === $this) {
                $relatedPayment->setClient(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Address
    {
        return $this->client;
    }

    public function setClient(Address $client): self
    {
        $this->client = $client;

        return $this;
    }
}
