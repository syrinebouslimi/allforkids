<?php

namespace UserBundle\Redirection;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

/**
 * Class AfterLoginRedirection
 *
 * @package AppBundle\Redirection
 */
class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
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
     * @return Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

       if (in_array('ROLE_PARENT', $rolesTab, true)) {
            // c'est un aministrateur : on le rediriger vers l'espace admin
           $redirection = new RedirectResponse($this->router->generate('espace_parent'));
        } else if (in_array('ROLE_PRESTATAIRE', $rolesTab, true)) {
            // c'est un utilisaeur lambda : on le rediriger vers l'accueil
           $redirection = new RedirectResponse($this->router->generate('espace_prestataire'));
        } else {
           $redirection = new RedirectResponse($this->router->generate('kids_backend_homepage'));

       }


        return $redirection;
    }
}