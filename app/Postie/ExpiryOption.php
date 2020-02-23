<?php

namespace App\Postie;

/**
 * An expiry option for a post.
 */
class ExpiryOption
{
    public $name;
    public $seconds;

    /**
     * @param string $name Name of the expiry option.
     * @param int $seconds Amount of seconds that will pass before the file expires. 
     */
    public function __construct(string $name, int $seconds)
    {
        $this->name = $name;
        $this->seconds = $seconds;
    }
}