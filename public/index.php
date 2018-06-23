<?php

session_start();
include_once 'autoload.php';
if(!(new UserRepositoryService())->isLoggedInNow()){
    header('location: index.php?controller=prijava' );
}

switch($_GET['controller'] ?? 'index') {
    case 'prijava':
        $controller = new LoginController();
        break;
    case 'odjava':
        $controller = new LoginController();
        break;
    case 'registracija':
        $controller = new RegisterController();
        break;
    case 'index':
        $controller = new IndexController();
        break;
    case 'Profil':
        header('location: profile.php');
        break;
    case 'Pratitelji':
        $controller = new FollowerController();
        break;
    case 'Pratiš':
        $controller = new IndexController();
        break;

    default:
        $controller = new ErrorController();
}


$request = new Request(
    $_SERVER['REQUEST_METHOD'],
    $_GET,
    $_POST,
    $_FILES
);

#require_once $file;
$response =new EmptyResponse();
try {
    $response = $controller->handle($request);
    $response->send();
}
catch (Exception $e){
    echo $e;
}
finally {
    if($response instanceof EmptyResponse ){
        $controller->showForm();
    }
}
$index = new IndexController();
$index->showHtml();
$index->showForm();

