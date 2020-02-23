<?php

namespace App\PrismJs;

/**
 * PrismJS language.
 */
class PrismJsLanguage {
    public $title;
    public $alias;

    /**
     * @param string $title Display name of the language (e.g. C++).
     * @param string $alias Alias that represents the language (e.g. cpp).
     */
    public function __construct(string $title, string $alias)
    {
        $this->title = $title;
        $this->alias = $alias;
    }
}