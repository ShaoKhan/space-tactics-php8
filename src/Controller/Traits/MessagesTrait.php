<?php

namespace App\Controller\Traits;

use App\Repository\MessagesRepository;

trait MessagesTrait
{
    private function getMessages(
        $security,
        $managerRegistry
    ): array
    {
        $messagesRepo = new MessagesRepository($managerRegistry);
        return $messagesRepo->findBy(['to_uuid' => $security->getUser()->getUuid(), 'deleted' => FALSE]);
    }
}
