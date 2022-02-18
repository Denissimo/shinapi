<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CommonController extends AbstractController
{
    public function buildWSDL(string $soapUrl): Response
    {
        $response =  $this->render(
            'wsdl.1C.html.twig',
            [
                'soap_url' => $soapUrl
            ]
        );

        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }

}