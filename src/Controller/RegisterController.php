<?php

namespace App\Controller;

use App\Service\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/api/register", name="apiRegister_register")
     */
    public function register(Request $request, RegisterService $registerService, UserPasswordEncoderInterface $encoder)
    {
        $content = $request->getContent();
        $data = json_decode($content, true);

        return $registerService->addUser($data, $encoder);
    }
}
