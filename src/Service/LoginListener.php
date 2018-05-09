<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

/**
 * Class AfterLoginRedirection
 *
 */
class LoginListener implements AuthenticationSuccessHandlerInterface
{
    private $router;

    /**
     * AfterLoginRedirection constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request        $request
     *
     * @param TokenInterface $token
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);
        
        dump($rolesTab);

        if (in_array('ROLE_DECLARANT', $rolesTab, true)) {
            // DONNER LA ROUTE POUR LES ROLE_MEMBRE
            $redirection = new RedirectResponse($this->router->generate('dashboard_declarant'));
        } 
        elseif (in_array('ROLE_MAIRIE', $rolesTab, true)) {
            // DONNER LA ROUTE POUR LES ROLE_ADMIN
            $redirection = new RedirectResponse($this->router->generate('dashboard_mairie'));
        }
        
        else {
            $redirection = new RedirectResponse($this->router->generate('connexion'));
        }

        return $redirection;
    }
}