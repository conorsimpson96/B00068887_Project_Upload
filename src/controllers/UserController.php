<?php
/**
 * this is a class for userController
 */
namespace Hdip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Hdip\Model\User;
use Hdip\Model\DvdRepository;

/**
 * Class UserController
 *
 * simple authentication using Silex session object
 * $app['session']->set('isAuthenticated', false);
 *
 * but the propert way to do it:
 * https://gist.github.com/brtriver/1740012
 *
 * @package Hdip\Controller
 */
class UserController
{
    /**
     * displays the user
     * @return array
     */
    public function displayUsers()
    {
        $username = User::getAll();

        return $username;
    }

    /**
     * processe the login see who is logged in
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processLoginAction(Request $request, Application $app)
    {
        // retrieve 'name' from GET params in Request object
        $username = $request->get('username');
        $password = $request->get('password');
        // search for user with username in repository
        $isLoggedIn = User::canFindMatchingUsernameAndPassword($username, $password);

        if ($isLoggedIn) {


            // authenticate!
            if ('matt' === $username && 'smith' === $password) {
                // store username in 'user' in 'session'
                $app['session']->set('user', array('username' => $username));

                // success - redirect to the secure admin home page
                return $app->redirect('/admin');
            } // authenticate!

            elseif ('admin' === $username && 'admin' === $password) {
                // store username in 'user' in 'session'
                $app['session']->set('user', array('username' => $username));

                // success - redirect to the student page
                return $app->redirect('/admin');
            } // authenticate!

            else {
                // store username in 'user' in 'session'
                $app['session']->set('user', array('username' => $username));

                // success - redirect to the student page
                return $app->redirect('/admin');
            }
        }

        // login page with error message
        // ------------
        $templateName = 'login';
        $argsArray = array(
            'errorMessage' => 'bad username or password - please re-enter'
        );

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * logs the user into the session
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function loginAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null);

        // build args array
        // ------------
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'login';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * allows the user to log out of the session
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function logoutAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null);

        // redirect to home page
//        return $app->redirect('/');

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', []);
    }
}
