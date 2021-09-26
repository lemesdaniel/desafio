<?php
declare(strict_types=1);

namespace App\Application\User;

class UserDto
{
    public string $id;
    public string $document;
    public string $name;
    public string $email;
    public string $password;

    /**
     * @param string $document
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(string $document, string $name, string $email, string $password)
    {
        $this->document = $document;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }


}