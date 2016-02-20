<?php
use Cake\Routing\Router;

Router::plugin(
    'MAuth',
    ['path' => '/m-auth'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
