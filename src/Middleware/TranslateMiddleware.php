<?php

namespace DejwCake\StandardAuth\Middleware;

use Cake\Core\Configure;

class TranslateMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $data = $request->getParsedBody();
        if(isset($data['_translations'][Configure::read('App.defaultLocale')])) {
            foreach ($data['_translations'][Configure::read('App.defaultLocale')] as $field => $value) {
                $data[$field] = $value;
            }
        }
        $request = $request->withParsedBody($data);

        return $next($request, $response);
    }
}