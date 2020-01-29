<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegistrationRepository")
 */
class Registration
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lesson", inversedBy="registrations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lesson_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\lesson", inversedBy="registrations")
     */
    private $lesson;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="registrations")
     */
    private $user;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayment(): ?bool
    {
        return $this->payment;
    }

    public function setPayment(?bool $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getLessonId(): ?Lesson
    {
        return $this->lesson_id;
    }

    public function setLessonId(?Lesson $lesson_id): self
    {
        $this->lesson_id = $lesson_id;

        return $this;
    }

    public function getLesson(): ?lesson
    {
        return $this->lesson;
    }

    public function setLesson(?lesson $lesson): self
    {
        $this->lesson = $lesson;

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
