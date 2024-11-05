<?php

namespace App\Domain\Wine\Entity;

use App\Domain\Measurement\Entity\Measurement;
use App\Domain\Wine\Repository\WineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WineRepository::class)]
class Wine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $year = null;

    #[ORM\OneToMany(targetEntity: Measurement::class,mappedBy: "wine")]
    private Collection $measurements;


    public function __construct()
    {
        $this->measurements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Measurement>
     */
    public function getMeasurements(): Collection
    {
        return $this->measurements;
    }

    public function addMeasurement(Measurement $measurement): static
    {
        if (!$this->measurements->contains($measurement)) {
            $this->measurements->add($measurement);

            $measurement->setWineId($this->id);
        }

        return $this;
    }

    public function removeMeasurement(Measurement $measurement): static
    {
        $this->measurements->removeElement($measurement);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }
}
