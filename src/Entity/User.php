<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User.
 *
 * @author Manuel Voss <manuel.voss@i22.de>
 *
 * @ORM\Entity()
 */
class User
{
    private $username;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }
}
