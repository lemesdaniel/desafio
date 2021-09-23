<?php
declare(strict_types=1);

namespace Challenge\Domain\Entities;

use Challenge\Domain\Contracts\HashPasswordInterface;
use Challenge\Domain\Document;
use Challenge\Domain\Email;

class User
{
    private Document $document;
    private string $name;
    private Email $email;
    private HashPasswordInterface $password;


}