<?php

namespace App\Entity;

use App\Repository\ConvertRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConvertRepository::class)]
#[ORM\Table(name: '`convert`')]
class Convert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

 
    #[ORM\Column(type: 'float')]
    private $amount;

    #[ORM\Column(type: 'string', length: 3)]
    private $from_currency;

    #[ORM\Column(type: 'string', length: 3)]
    private $to_currency;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\Column(type: 'float')]
    private $convertion_amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getFromCurrency(): ?string
    {
        return $this->from_currency;
    }

    public function setFromCurrency(string $from_currency): self
    {
        $this->from_currency = $from_currency;

        return $this;
    }

    public function getToCurrency(): ?string
    {
        return $this->to_currency;
    }

    public function setToCurrency(string $to_currency): self
    {
        $this->to_currency = $to_currency;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getConvertionAmount(): ?float
    {
        return $this->convertion_amount;
    }

    public function setConvertionAmount(float $convertion_amount): self
    {
        $this->convertion_amount = $convertion_amount;

        return $this;
    }


}
