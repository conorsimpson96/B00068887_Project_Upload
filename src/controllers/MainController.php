<?php
/**
 * summary for main controller
 */

namespace Hdip\Controller;

/**
 * summary for use
 */
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Hdip\Model\DvdRepository;

/**
 * summary for class
 * Class MainController
 * @package Hdip\Controller
 */
class MainController
{

    /**
     * gets the index page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * gets the member page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function membersAction(Request $request, Application $app)
    {

        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'members';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * gets the project page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function projectsAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'projects';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
    /**
     * renders the publications page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function publicationsAction(Request $request, Application $app)
    {

        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'publications';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
