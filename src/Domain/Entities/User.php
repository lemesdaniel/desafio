<?php
declare(strict_types=1);

namespace Challenge\Domain\Entities;

use Challenge\Domain\Contracts\HashPasswordInterface;
use Challenge\Domain\Document;
use Challenge\Domain\Email;

class User
{
    /**
     * @var Document
     */
    private Document $document;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var Email
     */
    private Email $email;
    /**
     * @var string
     */
    private string $password;

    /**
     * @param string $name
     * @param string $email
     * @param string $document
     * @param string $password
     * @return $this
     */
    public function create(string $name, string $email, string $document, string $password): User
    {
        $this->setName($name)
            ->setDocument($document)
            ->setEmail($email)
            ->setPassword($password);
        return $this;
    }

    /**
     * @param string $document
     * @return User
     */
    public function setDocument(string $document): self
    {
        $this->document = new Document($document);
        return $this;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = new Email($email);
        return $this;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocument(): string
    {
        return (string) $this->document;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param $name
     * @param $email
     * @param $document
     * @return $this
     */
    public function load($name, $email, $document): User
    {
        $this->setName($name)
            ->setDocument($document)
            ->setEmail($email);

        return $this;
    }

    public function __serialize(): array
    {
        return [
            $this->getName(),
            $this->getDocument(),
            $this->getEmail(),
            $this->getPassword()
        ];
    }

}