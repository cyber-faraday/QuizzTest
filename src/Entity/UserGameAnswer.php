<?php

namespace App\Entity;

use App\Repository\UserGameAnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserGameAnswerRepository::class)]
class UserGameAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $good = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $delayAnswer = null;

    #[ORM\ManyToOne(inversedBy: 'userGameAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Answer $answer = null;

    #[ORM\ManyToOne(inversedBy: 'userGameAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

    #[ORM\ManyToOne(inversedBy: 'userGameAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isGood(): ?bool
    {
        return $this->good;
    }

    public function setGood(bool $good): self
    {
        $this->good = $good;

        return $this;
    }

    public function getDelayAnswer(): ?string
    {
        return $this->delayAnswer;
    }

    public function setDelayAnswer(string $delayAnswer): self
    {
        $this->delayAnswer = $delayAnswer;

        return $this;
    }

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(?Answer $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
