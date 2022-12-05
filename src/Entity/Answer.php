<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'answer', targetEntity: QuestionAnswer::class, orphanRemoval: true)]
    private Collection $questionAnswers;

    #[ORM\OneToMany(mappedBy: 'answer', targetEntity: UserGameAnswer::class)]
    private Collection $userGameAnswers;

    public function __construct()
    {
        $this->questionAnswers = new ArrayCollection();
        $this->userGameAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, QuestionAnswer>
     */
    public function getQuestionAnswers(): Collection
    {
        return $this->questionAnswers;
    }

    public function addQuestionAnswer(QuestionAnswer $questionAnswer): self
    {
        if (!$this->questionAnswers->contains($questionAnswer)) {
            $this->questionAnswers->add($questionAnswer);
            $questionAnswer->setAnswer($this);
        }

        return $this;
    }

    public function removeQuestionAnswer(QuestionAnswer $questionAnswer): self
    {
        if ($this->questionAnswers->removeElement($questionAnswer)) {
            // set the owning side to null (unless already changed)
            if ($questionAnswer->getAnswer() === $this) {
                $questionAnswer->setAnswer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserGameAnswer>
     */
    public function getUserGameAnswers(): Collection
    {
        return $this->userGameAnswers;
    }

    public function addUserGameAnswer(UserGameAnswer $userGameAnswer): self
    {
        if (!$this->userGameAnswers->contains($userGameAnswer)) {
            $this->userGameAnswers->add($userGameAnswer);
            $userGameAnswer->setAnswer($this);
        }

        return $this;
    }

    public function removeUserGameAnswer(UserGameAnswer $userGameAnswer): self
    {
        if ($this->userGameAnswers->removeElement($userGameAnswer)) {
            // set the owning side to null (unless already changed)
            if ($userGameAnswer->getAnswer() === $this) {
                $userGameAnswer->setAnswer(null);
            }
        }

        return $this;
    }
}
