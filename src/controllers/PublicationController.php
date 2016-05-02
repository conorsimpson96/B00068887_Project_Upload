<?php
/**
 * Created by PhpStorm.
 * User: conorsimpson
 * Date: 02/05/2016
 * Time: 13:22
 */

namespace Hdip\Controller;

use Hdip\Model\Publication;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * summary for class
 * Class PublicationController
 * @package Hdip\Controller
 */
class PublicationController
{

    /**
     * gets the search action so you can search for a author or title
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function searchAction(Request $request, Application $app)
    {
        $searchText = filter_input(INPUT_GET, 'searchText', FILTER_SANITIZE_STRING);


        print $searchText;
        die();

        $publications = Publication::findInAuthorOrTitle($searchText);

        //require_once __DIR__ . '/../templates/moduleList.php';
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

    /**
     * updates the publications
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function updateAction(Request $request, Application $app)
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        /**
         * @var $publication Publication
         */
        $publication = Publication::getOneById($id);

        $author = $publication->getAuthor();
        $title = $publication->getTitle();
        $url = $publication->getUrl();



        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'editPublicationForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    /**
     * deletes the publications
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function deleteAction(Request $request, Application $app)
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $deleteSuccess = Publication::delete($id);

        if ($deleteSuccess) {
            $message = "Module with ID = $id has been deleted";
        } else {
            $message = "FAILURE - sorry, there was a problem deleting record from Module for ID = $id";
        }


        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'message';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * lists the publications
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function listAction(Request $request, Application $app)
    {
        // get some data

        $publication = Publication::getAll();

        // get the appropriate template to OUTPUT the data (in a nice way)
       // require_once __DIR__ . '/../templates/moduleList.php';
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

    /**
     * shows the publications form
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function showNewPublicationFormAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'newPublicationForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * processes the publication form to the database
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processNewPublicationAction(Request $request, Application $app)
    {
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_NUMBER_INT);

        $m = new Publication();

        $m->setUrl($url);
        $m->setAuthor($author);
        $m->setTitle($title);

        Publication::insert($m);
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'publications';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * processes the update to the database
     * @param Request $request
     * @param Application $app
     */
    public function processUpdatePublicationAction(Request $request, Application $app)
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_NUMBER_INT);

        $m = new Publication();
        $m->setId($id);
        $m->setUrl($url);
        $m->setAuthor($author);
        $m->setTitle($title);

        Publication::update($m);

        $this->listAction();
    }
}
