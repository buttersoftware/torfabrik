<?php

namespace pspiess\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportController extends Controller {

    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function Action(Request $request) {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = null;
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);
        return array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error' => $error,
        );
    }

    /**
     * @Route("/test", name="login")
     * @Template()
     */
    public function testAction(Request $request) {

    }
} 