<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Hdip\Model\User;
use Hdip\Model\Publication;

define('DB_HOST', 'localhost');
define('DB_USER', 'conor');
define('DB_PASS', 'simpson');
define('DB_NAME', 'graphicgames');

$matt = new User();
$matt->setUsername('matt');
$matt->setPassword('smith');
$matt->setRole(User::ROLE_USER);

$joe = new User();
$joe->setUsername('joe');
$joe->setPassword('bloggs');
$joe->setRole(User::ROLE_USER);

$conor = new User();
$conor->setUsername('conor');
$conor->setPassword('simpson');
$conor->setRole(User::ROLE_USER);

$admin = new User();
$admin->setUsername('admin');
$admin->setPassword('admin');
$admin->setRole(User::ROLE_ADMIN);

User::insert($matt);
User::insert($joe);
User::insert($conor);
User::insert($admin);

$users = User::getAll();

var_dump($users);


$publication_1 = new Publication();
$publication_1->setTitle("Graphic games volume 1");
$publication_1->setAuthor("conor");
$publication_1->setUrl("/pdf/graphic_games.pdf");

$publication_2 = new Publication();
$publication_2->setTitle("Graphic games valume 2");
$publication_2->setAuthor("matt");
$publication_2->setUrl("/pdf/graphic_games2.pdf");


Publication::insert($publication_1);
Publication::insert($publication_2);

$publications = Publication::getAll();
var_dump($publications);


$project_1 = new Project();
$project_1->setTitle("gameA");
$project_1->setDescription("This is the first game in the series");
$project_1->setMembers("conor simpson - Joe Blogges");
$project_1->setSupervisor("matt smith");
$project_1->setDeadline("1-2-2017");

$project_2 = new Project();
$project_2->setTitle("gameB");
$project_2->setDescription("this is the second game in the series");
$project_2->setMembers("conor simpson - joe bloggs");
$project_2->setSupervisor("matt smith");
$project_2->setDeadline("1-2-2018");

Project::insert($project_1);
Project::insert($project_2);

$projects = Project::getAll();

var_dump($projects);
