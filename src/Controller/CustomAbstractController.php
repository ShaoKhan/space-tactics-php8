<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;
use Symfony\Bundle\SecurityBundle\Security;
/**
 * Provides shortcuts for HTTP-related features in controllers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class CustomAbstractController extends SymfonyAbstractController
{

    public function __construct(
        Security $security,
    )
    {
        if($security->getUser() !== null) {
            $this->user_uuid = $security->getUser()->getUuid() ?? null;
        }
    }

}
