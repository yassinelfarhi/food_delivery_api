<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderStatusRepository;
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
 *    collectionOperations={"get", "post"},
 *     itemOperations={"get", "put", "delete"},
 *     shortName="orderstatus",
 *     normalizationContext={"groups"={"orderstatus:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"orderstatus:write"}, "swagger_definition_name"="Write"},
 * )
 * @ORM\Entity(repositoryClass=OrderStatusRepository::class)
 */
class OrderStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"orderstatus:read", "orderstatus:write"})
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Order::class, mappedBy="status", cascade={"persist", "remove"})
     * @Groups({"orderstatus:read", "orderstatus:write"})
     */
    private $relatedOrder;

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

    public function getRelatedOrder(): ?Order
    {
        return $this->relatedOrder;
    }

    public function setRelatedOrder(Order $relatedOrder): self
    {
        // set the owning side of the relation if necessary
        if ($relatedOrder->getStatus() !== $this) {
            $relatedOrder->setStatus($this);
        }

        $this->relatedOrder = $relatedOrder;

        return $this;
    }
}
