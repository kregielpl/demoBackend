<?php

namespace App\Controller;

use App\Service\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{

    /**
     * @Route("/api/addUserMessage", name="apiMessage_addUserMessage")
     */
    public function addUserMessage (Request $request, MessageService $messageService) {
        $content = $request->getContent();
        $data = json_decode($content, true);

        return $messageService->addUserMessage($data, $this->getCurrentUser());
    }

    /**
     * @Route("/api/getAllMessage", name="apiMessage_getAllMessage")
     */
    public function getAllMessage (Request $request, MessageService $messageService) {
        return $messageService->getAllMessage();
    }

    public function getCurrentUser() {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

}
