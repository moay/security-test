<?php

namespace App\Services;

/**
 * Class BrokenConfigLoader.
 *
 * @author Manuel Voss <manuel.voss@i22.de>
 */
class BrokenConfigLoader
{
    /** @var ConfigFileLoader */
    private $configFileLoader;

    /**
     * BrokenConfigLoader constructor.
     * @param ConfigFileLoader $configFileLoader
     */
    public function __construct(ConfigFileLoader $configFileLoader)
    {
        $this->configFileLoader = $configFileLoader;
    }

    /**
     * @param string $filename
     * @return mixed
     */
    public function loadConfigFile(string $filename)
    {
        $unserialized = $this->configFileLoader->load($filename);
        return unserialize($unserialized);
    }
}
