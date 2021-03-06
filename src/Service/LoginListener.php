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
        $user = $token->getUser();

            $rolesTab = array_map(function ($role) {
                return $role->getRole();
            }, $roles);
    
            if (in_array('ROLE_DECLARANT', $rolesTab, true)) {
                // DONNER LA ROUTE POUR LES ROLE_MEMBRE
                $redirection = new RedirectResponse($this->router->generate('dashboard_declarant'));
            } 
            elseif (in_array('ROLE_MAIRIE', $rolesTab, true)) {
                // DONNER LA ROUTE POUR LES ROLE_ADMIN
                $redirection = new RedirectResponse($this->router->generate('dashboard_mairie'));
            }
            elseif (in_array('ROLE_ADMIN', $rolesTab, true)) {
                // DONNER LA ROUTE POUR LES ROLE_ADMIN
                $redirection = new RedirectResponse($this->router->generate('website-admin'));
            }
            elseif (in_array('ROLE_INACTIF', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('logout'));
            }
            else {
                $redirection = new RedirectResponse($this->router->generate('inscription'));
            }
        
        return $redirection;
    }
}