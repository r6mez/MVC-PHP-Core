<?php

namespace Ramez\PhpMvcCore\Middlewares;

use Ramez\PhpMvcCore\Application;
use Ramez\PhpMvcCore\Exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware {
    public array $actions = [];

    public function __construct(array $actions = []) {
        $this->actions = $actions;
    }

    public function execute(){
        if (Application::isGuest()) {
            // Only restrict if the current action is in the protected actions list
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}