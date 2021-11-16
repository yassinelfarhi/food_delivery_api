<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $info;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inStock;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="product")
     */
    private $relatedOrderItems;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="relatedProducts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Addon::class, mappedBy="relatedProduct")
     */
    private $addons;

    public function __construct()
    {
        $this->relatedOrderItems = new ArrayCollection();
        $this->addons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getInStock(): ?bool
    {
        return $this->inStock;
    }

    public function setInStock(bool $inStock): self
    {
        $this->inStock = $inStock;

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getRelatedOrderItems(): Collection
    {
        return $this->relatedOrderItems;
    }

    public function addRelatedOrderItem(OrderItem $relatedOrderItem): self
    {
        if (!$this->relatedOrderItems->contains($relatedOrderItem)) {
            $this->relatedOrderItems[] = $relatedOrderItem;
            $relatedOrderItem->setProduct($this);
        }

        return $this;
    }

    public function removeRelatedOrderItem(OrderItem $relatedOrderItem): self
    {
        if ($this->relatedOrderItems->removeElement($relatedOrderItem)) {
            // set the owning side to null (unless already changed)
            if ($relatedOrderItem->getProduct() === $this) {
                $relatedOrderItem->setProduct(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Addon[]
     */
    public function getAddons(): Collection
    {
        return $this->addons;
    }

    public function addAddon(Addon $addon): self
    {
        if (!$this->addons->contains($addon)) {
            $this->addons[] = $addon;
            $addon->setRelatedProduct($this);
        }

        return $this;
    }

    public function removeAddon(Addon $addon): self
    {
        if ($this->addons->removeElement($addon)) {
            // set the owning side to null (unless already changed)
            if ($addon->getRelatedProduct() === $this) {
                $addon->setRelatedProduct(null);
            }
        }

        return $this;
    }
}
