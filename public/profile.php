<?php
session_start();
include_once 'autoload.php';
var_dump($_SESSION['user']);
if(!(new UserRepositoryService())->isLoggedInNow()){
    header('location: index.php?controller=prijava' );
}



switch($_GET['controller'] ?? 'profile') {
    case 'prijava':
        $controller = new LoginController();
        break;
    case 'odjava':
        $controller = new LoginController();
        break;
    case 'index':
        $controller = new IndexController();
        break;
    case 'profile':
        $controller = new ProfileController();
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
$index = new ProfileController();
$index->showHtml();
$index->showForm();


?>

Dobrošao na svoj tviter profil <?php echo $_SESSION['user'];?>


