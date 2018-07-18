<?php

namespace App\Controller;

use App\Services\BrokenConfigLoader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RemoteCodeExecutionController.
 *
 * @author Manuel Voss <manuel.voss@i22.de>
 */
class RemoteCodeExecutionController extends Controller
{
    /**
     * @param Request $request
     */
    public function simpleRemoteCodeExecution(Request $request)
    {
        $configFile = $request->request->get('filename');
        if (file_exists($configFile)) {
            $config = unserialize(file_get_contents($configFile));
        }
    }

    /**
     * @param Request $request
     */
    public function hiddenRemoteCodeExecution(Request $request, BrokenConfigLoader $configLoader)
    {
        return $this->json($configLoader->loadConfigFile($request->get('config')));
    }
}
