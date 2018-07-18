<?php

namespace App\Services;

/**
 * Class BrokenSqlEscaper.
 *
 * @author Manuel Voss <manuel.voss@i22.de>
 */
class BrokenSqlEscaper
{
    /**
     * @param $value
     * @return mixed
     */
    public function escapeValue($value)
    {
        $escapedValue = mysqli_real_escape_string('test', $value);
        return $value;
    }
}
