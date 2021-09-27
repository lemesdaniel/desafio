<?php
declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Document;
use App\Domain\Email;

class User
{
    /**
     * @var string
     */
    private string $id;
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
    private string $password = '';

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
        return (string)$this->document;
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
        return (string)$this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param $id
     * @param $name
     * @param $email
     * @param $document
     * @return $this
     */
    public function load($id, $name, $email, $document): User
    {
        $this->setName($name)
            ->setId($id)
            ->setDocument($document)
            ->setEmail($email);

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'document' => $this->getDocument(),
            'email' => $this->getEmail(),
        ];
    }

    /**
     * @param $id
     * @return \App\Domain\Entities\User
     */
    public function setId($id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

}