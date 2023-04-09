<?php

namespace App\Service;

use App\Repository\MessagesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

class CheckMessagesService
{
    public function checkMessages(
        Security $security,
        ManagerRegistry $managerRegistry,
    )
    {
        $messagesRepo = new MessagesRepository($managerRegistry);
        return $messagesRepo->findBy(['to_uuid' => $security->getUser()->getUuid()]);
    }

    public function checkSupportMessages()
    {

    }

}