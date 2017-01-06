<?php

use Cake\Event\EventManager;
use DejwCake\StandardAuth\Middleware\LangFromUrlMiddleware;
use DejwCake\StandardAuth\Middleware\TranslateMiddleware;

EventManager::instance()->on(
    'Server.buildMiddleware',
    function ($event, $middleware) {
        $middleware->add(new LangFromUrlMiddleware());
        $middleware->add(new TranslateMiddleware());
    });
