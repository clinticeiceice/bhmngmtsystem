<?php

use App\Helpers\Routing;
use App\Services\Auth;

require_once __DIR__ . '/app/bootstrap.php';

/**
 * Check if the given uri is in the request uri
 *
 * @param string $uri
 * @return boolean
 */
function isInRoute(string $uri) : bool
{
    return str_contains($_SERVER['REQUEST_URI'], $uri);
}

/**
 * Get rid of the repeated page path calls
 *
 * @param string $filename
 * @return void
 */
function resolveFile(string $filename) : void
{
    include_once __DIR__ . '/pages/' . $filename;
}

// Add your endpoints here
switch($_SERVER['REQUEST_URI'])
{
    case isInRoute('/login'):
        resolveFile('login.php');
        break;

    case isInRoute('/home'):
        if(!Auth::isAuthenticated()) {
            Routing::redirect('/login');
        }

        resolveFile('home.php');
        break;

    case isInRoute('/tenant/create'):
        if(!Auth::isAuthenticated()) {
            Routing::redirect('/login');
        }

        resolveFile('tenants/create.php');
        break;

    case isInRoute('/tenant'):
        if(!Auth::isAuthenticated()) {
            Routing::redirect('/login');
        }

        resolveFile('tenants/index.php');
        break;

    default:
        if($_SERVER['REQUEST_URI'] == '/') {
            Routing::redirect('/home');
        } else {
            resolveFile('https/404.php');
        }
        break;
}

