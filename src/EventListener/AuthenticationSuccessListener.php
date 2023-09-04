<?php

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        /** @var App\Entity\User $user */
        $user = $event->getUser();

        if (!$user instanceof User) {
            return;
        }

        $data['data'] = array(
            'roles' => $user->getRoles(),
            'nickname' => $user->getNickname(),
            'email' => $user->getEmail()
        );

        $event->setData($data);
    }
}
