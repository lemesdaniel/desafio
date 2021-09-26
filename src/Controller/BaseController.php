<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getJsonData(Request $request)
    {
        return json_decode($request->getContent());
    }
}