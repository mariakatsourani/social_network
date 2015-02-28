<?php

require_once './controllers/errorcontroller.php';
require_once './controllers/startcontroller.php';
require_once './controllers/usercontroller.php';
require_once './controllers/validationcontroller.php';
require_once './models/databasemodel.php';

session_start();
global $path_username;
/*function __autoload($class) {
    require_once "./controllers/" . strtolower($class) . ".php";
}*/

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
//var_dump($path);

//override the defaults base on the user's URI choice
if(count($path) == 1){
    $defaultController = $path[0] . "Controller";
}
else if(count($path) == 2){
    $defaultController = $path[0] . "Controller";
    if ( ($path[0] == 'user') && (!empty($path[1])) ){
        $user = new UserController();
        $defaultAction = $path[1] . "Action";

        //needs fixing***
        if (is_readable("./controllers/". $defaultController . ".php")
                    && method_exists($defaultController, $defaultAction)){
            //echo "this method exists";
        }else if($user->getUserid($path[1])){
            //echo "user exits";
            $GLOBALS["username_in_path"] = $path[1];//**get username from uri**
            $defaultAction = "indexAction";
        }else{//if neither user nor method
            //echo "no way";
            $defaultController = "ErrorController";
            $defaultAction = "invalidUsernameAction";
        }

    }
}else if(count($path) == 3){
    if ( ($path[0] == 'user') ){
        if ($path[1] == 'sendFriendRequest'){
            $defaultAction = $path[1]. "Action";$GLOBALS["username_in_path"] = $path[2];//**get username from uri**
        }else if ($path[1] == 'acceptFriendRequest'){
            $defaultAction = $path[1]. "Action";$GLOBALS["username_in_path"] = $path[2];//**get username from uri**
        }else if($path[1] == 'declineFriendRequest'){
            $defaultAction = $path[1]. "Action";$GLOBALS["username_in_path"] = $path[2];//**get username from uri**
        }
    }
}/**/
else if(count($path) > 3){
    $defaultController = "ErrorController";
    $defaultAction = "urlErrorAction";
}

//If the file requested and the action exist, we instanciate, else we instaciate the ErrorController
if(is_readable("./controllers/". $defaultController . ".php")
            && method_exists($defaultController, $defaultAction)){
    $cont = new $defaultController;
    $cont->$defaultAction();
}else{
    $cont = new ErrorController;
    $cont->notFoundAction();
}



