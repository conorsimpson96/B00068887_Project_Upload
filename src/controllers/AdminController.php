<?php
/**
 * this is a summary of this class it is used to help the admin
 */

namespace Hdip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Hdip\Model\User;
use Hdip\Model\DvdRepository;

/**
 * Class AdminController
 *
 * simple authentication using Silex session object
 * $app['session']->set('isAuthenticated', false);
 *
 * but the propert way to do it:
 * https://gist.github.com/brtriver/1740012
 *
 * @package Hdip\Controller
 */
class AdminController
{
    /**
     * is authencated function
     */
    public function isAuthenticated()
    {
    }
    /**
     * calls the index function index home page
     * checks who is logged in and sends them to the correct area
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if (!$isAuthenticated) {
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }


        if ($isAuthenticated && $username == 'admin') {
            // store username into args array
            $argsArray = array(
                'username' => $username
            );

            // render (draw) template
            // ------------
            $templateName = 'admin/index';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }

        if ($isAuthenticated && $username == 'matt') {
            // store username into args array
            $argsArray = array(
                'username' => $username
            );

            // render (draw) template
            // ------------
            $templateName = 'admin/indexMembers';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        } else {
            // store username into args array
            $argsArray = array(
                'username' => $username
            );

            // render (draw) template
            // ------------
            $templateName = 'admin/indexStudent';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }

    /**
     * admin action makes sure that the admin can get to there home page to CRUD
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function adminAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if (!$isAuthenticated) {
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }

        if ($isAuthenticated && $username == 'admin') {
            // store username into args array
            $argsArray = array(
                'username' => $username
            );

            // render (draw) template
            // ------------
            $templateName = 'admin/admin';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }

    /**
     * makes sure the student can only access their pages
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function studentPageAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if (!$isAuthenticated) {
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }
        if ($isAuthenticated && $username == 'joe') {
            // store username into args array
            $argsArray = array(
                'username' => $username
            );

            // render (draw) template
            // ------------
            $templateName = 'admin/studentPage';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }

    /**
     * makes sure the members can acces there pages
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function membersAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if (!$isAuthenticated) {
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }
        if ($isAuthenticated && $username == 'matt') {
            // store username into args array
            $argsArray = array(
                'username' => $username
            );

            // render (draw) template
            // ------------
            $templateName = 'admin/members';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }
}
