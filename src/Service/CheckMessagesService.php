<?php

namespace App\Service;

use App\Repository\MessagesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

class CheckMessagesService
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function checkMessages(

        ManagerRegistry $managerRegistry,
    )
    {
        $messagesRepo = new MessagesRepository($managerRegistry);
        return $messagesRepo->findBy(['to_uuid' => $this->security->getUser()->getUuid(), 'deleted' => FALSE]);
    }

    public function checkSupportMessages()
    {

    }

}