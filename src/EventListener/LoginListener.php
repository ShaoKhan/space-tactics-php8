<?php

namespace App\EventListener;

use App\Entity\Planet;
use App\Entity\User;
use App\Service\BuildingCalculationService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginListener implements AuthenticationSuccessHandlerInterface
{

    use TargetPathTrait;

    private EntityManagerInterface     $entityManager;
    private BuildingCalculationService $buildingCalculationService;
    private ManagerRegistry            $managerRegistry;

    public function __construct(
        EntityManagerInterface $entityManager,
        ManagerRegistry        $managerRegistry,
    )
    {
        $this->entityManager              = $entityManager;
        $this->buildingCalculationService = new BuildingCalculationService();
        $this->managerRegistry            = $managerRegistry;
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationSuccess(
        Request        $request,
        TokenInterface $token,
    ): ?Response
    {
        $user = $token->getUser();

        if($user instanceof User) {

            $user->setLoginOn(new \DateTime());
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $lastLogout = $user->getLogoutOn();
            $planetRepository = $this->entityManager->getRepository(Planet::class);
            $planets = $planetRepository->findBy(['user_uuid' => $user->getUuid()]);
            $now = new DateTime();

            foreach ($planets as $planet) {
                $interval = $lastLogout->diff($now);
                $seconds = $interval->s + $interval->i * 60 + $interval->h * 3600 + $interval->d * 86400;

                if ($seconds > 0) {
                    $buildingProd = $this->buildingCalculationService->calculateActualBuildingProduction(
                        $planet->getMetalBuilding(),
                        $planet->getCrystalBuilding(),
                        $planet->getDeuteriumBuilding(),
                        $this->managerRegistry
                    );

                    $metal = $buildingProd[0] * $seconds;
                    $crystal = $buildingProd[1] * $seconds;
                    $deuterium = $buildingProd[2] * $seconds;

                    $planet->setMetal($planet->getMetal() + $metal);
                    $planet->setCrystal($planet->getCrystal() + $crystal);
                    $planet->setDeuterium($planet->getDeuterium() + $deuterium);
                }
            }
            $this->entityManager->flush();

        }
        return null;
    }
}