<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CommonController extends AbstractController
{
    public function buildWSDL(string $proxyUrl): Response
    {
        $response =  $this->render(
            'wsdl.1C.html.twig',
            [
                'proxy_url' => $proxyUrl
            ]
        );

        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }

}