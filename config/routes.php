<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

// 不要
// Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {

    // デフォルトで必須
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));
    $routes->applyMiddleware('csrf');


// --- 追加部分

    // 通常
    // http://localhost:8765/
    // http://localhost:8765/init
    $routes->connect('/',     ['controller' => 'VueCrudData', 'action' => 'index']);
    $routes->connect('/init', ['controller' => 'VueCrudData', 'action' => 'init']);
    
    // Ajax(API + JSON)
    // http://localhost:8765/api.json
    $routes->connect('/api', ['controller'  => 'VueCrudData', 'action' => 'api'])->setExtensions(['json']);

// --- 追加部分


   // 不要
   // $routes->fallbacks(DashedRoute::class);

});
