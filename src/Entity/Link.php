<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=LinkRepository::class)
 */
class Link
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
    private $href;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $method;

    /**
     * @ORM\ManyToOne(targetEntity=Payment::class, inversedBy="links")
     * @ORM\JoinColumn(nullable=true)
     */
    private $relatedPayment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHref(): ?string
    {
        return $this->href;
    }

    public function setHref(string $href): self
    {
        $this->href = $href;

        return $this;
    }

    public function getRel(): ?string
    {
        return $this->rel;
    }

    public function setRel(string $rel): self
    {
        $this->rel = $rel;

        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getRelatedPayment(): ?Payment
    {
        return $this->relatedPayment;
    }

    public function setRelatedPayment(?Payment $relatedPayment): self
    {
        $this->relatedPayment = $relatedPayment;

        return $this;
    }
}
