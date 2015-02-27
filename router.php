<?php

require_once './controllers/errorcontroller.php';
require_once './controllers/startcontroller.php';
require_once './controllers/usercontroller.php';
require_once './models/databasemodel.php';

session_start();
//$db = DatabaseModel::getInstance();


/*function __autoload($class) {
    require_once "./controllers/" . strtolower($class) . ".php";
}*/

/*
//assuming we start with: http://asd.com/user/Wesam/?test=1
$uri = $_SERVER["REQUEST_URI"]; //user/Wesam/?test=1
$uri = strtolower($uri);        //user/wesam/?test=1
$uri = parse_url($uri, PHP_URL_PATH); //user/wesam/
$uri = rtrim($uri, "/");        //user/wesam
$uri = explode("/", $uri); // [user,wesam]
*/

$uri = explode("/", parse_url(rtrim(strtolower($_SERVER["REQUEST_URI"]), "/"), PHP_URL_PATH));
$script = explode("/", rtrim(strtolower($_SERVER["SCRIPT_NAME"]), "/")); //This line contains an array of splitted router URI

//Match URI vs SCRIPT_NAME in order to enable subdirectory support!
for ($i = 0; $i < sizeof($script); $i++) {
    if ((isset($uri[$i])) && ($uri[$i] == $script[$i]))
        unset($uri[$i]);
}

$path = array_values($uri); //create new array for the values that starts from 0


//start by giving a default controller
$defaultController = "startController";
$defaultAction = "indexAction";


//override the defaults base on the user's URI choice
if(count($path) == 1){
    $defaultController = $path[0] . "Controller";
}
else if(count($path) == 2){
    $defaultController = $path[0] . "Controller";
    $defaultAction = $path[1] . "Action";
}
else if(count($path) > 2){
    $defaultController = "ErrorController";
    $defaultAction = "urlErrorAction";
}


//If the file requested and the action exist, we instanciate, else we instaciate the ErrorController
if(is_readable("./controllers/". $defaultController . ".php")
    && method_exists($defaultController, $defaultAction)){
        $cont = new $defaultController;
        $cont->$defaultAction();
}
else{
    $cont = new ErrorController;
    $cont->notFoundAction();
}



