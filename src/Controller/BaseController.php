<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController {

    public function checkRequest(Request $request): bool {
        return !!$request;
    }
}