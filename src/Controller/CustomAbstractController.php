<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Provides shortcuts for HTTP-related features in controllers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class CustomAbstractController extends SymfonyAbstractController
{
    public ?UserInterface $user;
    protected              $logger;
    private                $user_uuid;


    public function __construct(
        Security $security,
        LoggerInterface $logger,
    )
    {
        if($security->getUser() !== null) {
            $this->user_uuid = $security->getUser()->getUuid();
            $this->user = $security->getUser();
        }

        $this->logger = $logger;
    }

}
