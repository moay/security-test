<?php

namespace App\Controller;

use App\Entity\User;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VariousIssuesController.
 *
 * @author Manuel Voss <manuel.voss@i22.de>
 */
class VariousIssuesController extends Controller
{
    /**
     * @Route("/various/unsafe-redirect")
     */
    public function unsafeRedirect()
    {
        if ($_SESSION['user_logged_in'] !== true) {
            header('Location: /login.php');
        }

        $this->render('sensibleInformation.html.twig');
    }

    /**
     * @Route("/various/dynamic-globals)
     */
    public function dynamicGlobalsUsage()
    {
        $user = new \stdClass;

        $adminRights = $user->hasAdminRights();

        foreach ($_REQUEST as $var => $val) {
            $$var = $val;
        }

        if ($adminRights) {
            $this->render('sensibleInformation.html.twig');
        }
    }

    /**
     * @Route("/various/missing-csrf-protection")
     *
     * @param Request $request
     */
    public function missingCsrfProtection(Request $request)
    {
        $user = new User();
        $user->setUsername($request->get('username'));

        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();
    }
}
