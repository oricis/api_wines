<?php

namespace App\Domain\Measurement\Entity;

use App\Domain\Measurement\Repository\MeasurementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeasurementRepository::class)]
class Measurement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $year = null;

    #[ORM\Column(length: 32)]
    private ?string $color = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $temperature = null;

    #[ORM\Column]
    private ?float $ph = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $alcohol_content = null;

    #[ORM\Column]
    private ?int $sensor_id = null;

    #[ORM\Column]
    private ?int $wine_id = null;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getPh(): ?float
    {
        return $this->ph;
    }

    public function setPh(float $ph): static
    {
        $this->ph = $ph;

        return $this;
    }

    public function getAlcoholContent(): ?int
    {
        return $this->alcohol_content;
    }

    public function setAlcoholContent(int $alcohol_content): static
    {
        $this->alcohol_content = $alcohol_content;

        return $this;
    }

    public function getSensorId(): ?int
    {
        return $this->sensor_id;
    }

    public function setSensorId(int $sensor_id): static
    {
        $this->sensor_id = $sensor_id;

        return $this;
    }

    public function getWineId(): ?int
    {
        return $this->wine_id;
    }

    public function setWineId(int $wine_id): static
    {
        $this->wine_id = $wine_id;

        return $this;
    }
}
