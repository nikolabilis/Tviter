<?php

session_start();
include_once 'autoload.php';



switch($_GET['controller'] ?? 'Početna') {
    case 'Prijava':
        $controller = new LoginController();
        break;
    case 'Odjava':
        $controller = new LoginController();
        break;
    case 'Registracija':
        $controller = new RegisterController();
        break;
    case 'Početna':
        $controller = new IndexController();
        break;
    case 'Profil':
        header('location: profile.php?' . $_SESSION['user'] ?? '');
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
} finally {
    if($response instanceof EmptyResponse ){
        $controller->showHtml();
        $controller->showForm();
    }
}



