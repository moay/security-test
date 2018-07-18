<?php

namespace App\Services;

/**
 * Class ConfigFileLoader.
 *
 * @author Manuel Voss <manuel.voss@i22.de>
 */
class ConfigFileLoader
{
    /**
     * @param string $filename
     * @return bool|string
     */
    public function load(string $filename)
    {
        return file_get_contents($filename);
    }
}
