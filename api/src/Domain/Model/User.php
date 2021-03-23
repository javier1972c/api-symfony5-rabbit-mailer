<?php

declare(strict_types=1);

namespace App\Domain\Model;

use DateTimeImmutable;
use LogicException;
use Symfony\Component\Uid\Uuid;

class User
{
    private string $id;
    private string $name;
    private string $email;
    private ?string $password;
    private ?string $avatar;
    private ?string $token;
    private ?string $resetPasswordToken;
    private bool $active;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updateAt;

    /**
     * User constructor.
     * @param string $name
     * @param string $email
     */
    public function __construct(string $name, string $email)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->setEmail($email);
        $this->password = null;
        $this->avatar = null;
        $this->token = sha1(uniqid());
        $this->resetPasswordToken = null;
        $this->active = false;
        $this->createdAt = new DateTimeImmutable();
        $this->markAsUpdated();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new LogicException(sprintf('Invalid email'));
        }

        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param string|null $avatar
     */
    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string|null
     */
    public function getResetPasswordToken(): ?string
    {
        return $this->resetPasswordToken;
    }

    /**
     * @param string|null $resetPasswordToken
     */
    public function setResetPasswordToken(?string $resetPasswordToken): void
    {
        $this->resetPasswordToken = $resetPasswordToken;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdateAt(): DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function markAsUpdated(): void
    {
        $this->updateAt = new DateTimeImmutable();
    }
}