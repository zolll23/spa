<?php

declare(strict_types=1);

namespace Spa;

use Spa\Controllers\CommentController;
use VPA\Framework\App as VpaApp;

class App extends VpaApp
{
    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->controllers = [
            CommentController::class
        ];
    }
}
