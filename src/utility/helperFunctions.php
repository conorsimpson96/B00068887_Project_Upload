<?php

/**
 * this is a summary for the helperfunction
 */
use Silex\Application;

/**
 * summary for this class
 * @param $namespace
 * @param $shortName
 * @return string
 */
function controller($namespace, $shortName)
{
    list($shortClass, $shortMethod) = explode('/', $shortName, 2);

    $shortClassCapitlise = ucfirst($shortClass);

    $namespaceClassAction = sprintf($namespace . '\\' . $shortClassCapitlise . 'Controller::' . $shortMethod . 'Action');

    return $namespaceClassAction;
}

/**
 * if user logged-in, THEN return user's username
 * if user not logged-in THEN return 'null'
 *
 * @param Application $app
 * @return null (or string username)
 */
function getAuthenticatedUserName(Application $app)
{
    // IF 'user' found with non-null value in 'session'
    $user = $app['session']->get('user');

    if (null != $user) {
        // THEN return username inside 'user' array
        return $user['username'];
    } else {
        // ELSE return 'null' (i.e. no user logged in at present)
        return null;
    }
}
