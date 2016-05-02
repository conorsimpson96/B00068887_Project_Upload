<?php
// autoloader& other functions to include
// ---------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/utility/helperFunctions.php';

// load all our Silex / Twig setup etc.
require_once __DIR__ . '/../app/config.php';

require_once __DIR__ . '/../app/configDatabase.php';


//-------------------------------------------
// map routes to controller class/method
//-------------------------------------------

$app->get('/',      controller('Hdip\Controller', 'main/index'));
$app->get('/members',      controller('Hdip\Controller', 'main/members'));
$app->get('/projects',      controller('Hdip\Controller', 'main/projects'));
$app->get('/publications',      controller('Hdip\Controller', 'main/publications'));

// ------ ADMIN PAGES ----------
$app->get('/admin',  controller('Hdip\Controller', 'admin/index'));
$app->get('/adminCodes',  controller('Hdip\Controller', 'admin/admin'));

// ------ STUDENT PAGES ----------
$app->get('/admin',  controller('Hdip\Controller', 'admin/indexStudent'));
$app->get('/adminStudent',  controller('Hdip\Controller', 'admin/studentPage'));


// ------ MEMBERS PAGES ----------
$app->get('/admin',  controller('Hdip\Controller', 'admin/indexMembers'));
$app->get('/adminMember',  controller('Hdip\Controller', 'admin/members'));



// ------ login routes GET ------------
$app->get('/login',  controller('Hdip\Controller', 'user/login'));
$app->get('/logout',  controller('Hdip\Controller', 'user/logout'));

// ------ login routes POST (process submitted form)     ------------
$app->post('/login',  controller('Hdip\Controller', 'user/processLogin'));



// Admin CRUD
// Admin add project
$app->get('/searchAction', 'Hdip\Controller\PublicationController::searchAction');
$app->post('/processUpdatePublicationAction', 'Hdip\Controller\PublicationController::processUpdatePublicationAction');

$app->get('/showNewPublicationFormAction', 'Hdip\Controller\PublicationController::showNewPublicationFormAction');
$app->post('/processNewPublicationAction', 'Hdip\Controller\PublicationController::processNewPublicationAction');

$app->get('/deleteAction', 'Hdip\Controller\PublicationController::deleteAction');
$app->post('/updateAction', 'Hdip\Controller\PublicationController::updateAction');
$app->post('/listAction', 'Hdip\Controller\PublicationController::listAction');






// go - process request and decide what to do
//---------------------------------------------
//$app['debug']=true;
$app->run();
