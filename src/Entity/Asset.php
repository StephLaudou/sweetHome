<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetRepository")
 */
class Asset
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Descript;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dailyRate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPerson;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $floor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $accomodationType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gps;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Actor", inversedBy="assets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $actor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="asset_id", orphanRemoval=true)
     */
    private $pictures;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Condition", mappedBy="assetid", cascade={"persist", "remove"})
     */
    private $conditionAsset;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AvailibilityCalendar", mappedBy="assetid", cascade={"persist", "remove"})
     */
    private $availibilityCalendar;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="assetid", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="assetId", orphanRemoval=true)
     */
    private $reservations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Equipment", inversedBy="assets")
     */
    private $equipment;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->equipment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescript(): ?string
    {
        return $this->Descript;
    }

    public function setDescript(?string $Descript): self
    {
        $this->Descript = $Descript;

        return $this;
    }

    public function getDailyRate(): ?int
    {
        return $this->dailyRate;
    }

    public function setDailyRate(?int $dailyRate): self
    {
        $this->dailyRate = $dailyRate;

        return $this;
    }

    public function getNbPerson(): ?int
    {
        return $this->nbPerson;
    }

    public function setNbPerson(?int $nbPerson): self
    {
        $this->nbPerson = $nbPerson;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(?string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getAccomodationType(): ?string
    {
        return $this->accomodationType;
    }

    public function setAccomodationType(string $accomodationType): self
    {
        $this->accomodationType = $accomodationType;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getGps(): ?string
    {
        return $this->gps;
    }

    public function setGps(?string $gps): self
    {
        $this->gps = $gps;

        return $this;
    }

    public function getActor(): ?Actor
    {
        return $this->actor;
    }

    public function setActor(?Actor $actor): self
    {
        $this->actor = $actor;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setAsset($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getAsset() === $this) {
                $picture->setAsset(null);
            }
        }

        return $this;
    }

    public function getConditionAsset(): ?Condition
    {
        return $this->conditionAsset;
    }

    public function setConditionAsset(Condition $conditionAsset): self
    {
        $this->conditionAsset = $conditionAsset;

        // set the owning side of the relation if necessary
        if ($this !== $conditionAsset->getAsset()) {
            $conditionAsset->setAsset($this);
        }

        return $this;
    }

    public function getAvailibilityCalendar(): ?AvailibilityCalendar
    {
        return $this->availibilityCalendar;
    }

    public function setAvailibilityCalendar(AvailibilityCalendar $availibilityCalendar): self
    {
        $this->availibilityCalendar = $availibilityCalendar;

        // set the owning side of the relation if necessary
        if ($this !== $availibilityCalendar->getAsset()) {
            $availibilityCalendar->setAsset($this);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAsset($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAsset() === $this) {
                $comment->setAsset(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setAsset($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getAsset() === $this) {
                $reservation->setAsset(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Equipment[]
     */
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment[] = $equipment;
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        if ($this->equipment->contains($equipment)) {
            $this->equipment->removeElement($equipment);
        }

        return $this;
    }
}
