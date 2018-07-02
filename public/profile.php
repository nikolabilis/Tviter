<?php
session_start();
include_once 'autoload.php';

if(!isset($_SESSION['user'])){
    header('location: index.php?controller=prijava' );
}


switch($_GET['controller'] ?? 'profile') {
    case 'Promjena lozinke':
        $controller = new PasswordChangeController();
        break;
    case 'Privatne poruke':
        $controller = new DMcontroller();
        break;
    case 'Odjava':
        header('location: index.php?controller=Odjava');
        break;
    case 'Početna':
        header('location: index.php');
        break;
    default:
        if((new RegistrationService())->findByUsername($_GET['controller'] ??'')){
            $controller = new ProfileController(new RepositoryService());
        }
        else {
            $controller = new ErrorController();
        }
}
$request = new Request(
    $_SERVER['REQUEST_METHOD'],
    $_GET,
    $_POST,
    $_FILES
);


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








