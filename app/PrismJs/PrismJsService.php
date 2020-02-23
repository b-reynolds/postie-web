<?php 

namespace App\PrismJs;

/**
 * PrismJS service.
 */
class PrismJsService {
    public $supportedLanguages;

    /**
     * @param array $supportedLanguages Languages that can be highlighted by PrismJS.
     */
    public function __construct(array $supportedLanguages) {
        $this->supportedLanguages = $supportedLanguages;
    }
}