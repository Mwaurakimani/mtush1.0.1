<?php
require_once "../Modal.php";

session_start();

if(isset($_SESSION['TOKEN'])){
    //get the sent data
    $data = $_REQUEST['data'];

    $view = $data[0];
    $token = $data[1];

    $variables = isset($data[2]) ? $data[2] : null;
    $parent = '';
    $mode = null;

    if(isset($variables)){
        $parent = $variables[0];
        $mode = $variables[1];
    }
    $System = new System();
    //verify user
    $verified = true;

   
    if($verified){
        if($_REQUEST['action'] ==  'routing'){
            $views = PATH;
            foreach ($views as $key => $value) {
                if ($key == $view) {
                    require_once(PATH[$view]['view']);
                    break;
                }
            }
            exit();
        } elseif($_REQUEST['action'] ==  'open'){

            $parents = PATH;
            foreach ($parents as $key => $value) {
                if ($key == $parent) {
                    foreach ($value as $key => $value) {
                        if($key == $view){                            
                            if($mode == "update"){
                                $_SESSION['mode'] = "update";
                                $_SESSION['itemVariable'] = $_REQUEST['id'];
                            }else{
                                $_SESSION['mode'] = "add";
                                unset($_SESSION['itemVariable']);
                            }
                            require_once(PATH[$parent][$view]);
                            break;
                        } 
                    }
                }
            }
            exit();
        } else {
            echo "other";
        }
    }else{
        echo "unverified";
    }
}else{
    echo "not set";
}