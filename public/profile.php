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
    case 'odjava':
        $controller = new LoginController();
        break;
    case 'Početna':
        header('location: index.php');
        break;
    default:
        if((new RegistrationService())->findByUsername($_GET['controller'] ??'')){
            $controller = new ProfileController();
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
$index = new ProfileController();
$index->showHtml();
$index->showForm();


?>




