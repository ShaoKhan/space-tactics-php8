<?php

namespace App\Service;

use Doctrine\Persistence\ManagerRegistry;

class ResourceProductionSaver
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function saveResourceProduction($data): array
    {




        return ['message' => 'Resource production saved successfully'];
    }
}