<?php
declare(strict_types=1);


namespace App\Domain\Contracts;

interface AuthorizingService
{

    /**
     * @return bool
     */
    public function execute():bool;
}