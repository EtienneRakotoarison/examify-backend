<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?student $student = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?exam $exam = null;

    #[ORM\Column(nullable: true)]
    private ?int $response = null;

    #[ORM\Column(nullable: true)]
    private ?int $score = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?student
    {
        return $this->student;
    }

    public function setStudent(?student $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getExam(): ?exam
    {
        return $this->exam;
    }

    public function setExam(?exam $exam): static
    {
        $this->exam = $exam;

        return $this;
    }

    public function getResponse(): ?int
    {
        return $this->response;
    }

    public function setResponse(?int $response): static
    {
        $this->response = $response;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): static
    {
        $this->score = $score;

        return $this;
    }
}
