<?php

namespace App\Entity;

use App\Repository\AuthRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthRepository::class)]
class Auth
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idauth = null;

    #[ORM\Column(length: 255, options:["collation" => 'utf8mb4_general_ci'])]
    private ?string $login = null;

    #[ORM\Column(length: 255, options:["collation" => 'utf8mb4_general_ci'])]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->idauth;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIdauth(): ?int
    {
        return $this->idauth;
    }
}
