<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CrossSiteScriptingController.
 *
 * @author Manuel Voss <manuel.voss@i22.de>
 */
class CrossSiteScriptingController extends Controller
{
    /**
     * @Route("/xss/basic")
     */
    public function basicCrossSiteScripting()
    {
        echo $_GET['test'];
    }

    /**
     * @Route("/xss/advanced")
     *
     * @param Request $request
     * @return Response
     */
    public function advancedCrossSiteScripting(Request $request)
    {
        return $this->render('xss/advanced.html.twig', [
            'output' => $request->get('test')
        ]);
    }
}
