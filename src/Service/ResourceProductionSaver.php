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
        // Your resource production save logic here
        // Access POST data from $data

        // Example response
        return ['message' => 'Resource production saved successfully'];
    }
}