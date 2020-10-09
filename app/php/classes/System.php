<?php
/**
 * Administrator
 */
class System
{
    function verifyUser($token){
        if(isset($_SESSION['TOKEN']) && ($_SESSION['TOKEN'] == $token)){
            return true;
        }else{
            var_dump($_SESSION['TOKEN']);
            var_dump($token);
            return false;
        }
    }
    function encodeToHTML($str_val)
    {
        $val = htmlentities($str_val);
        return $val;
    }
    //decode
    function decodehtml($str_val)
    {
        $val = html_entity_decode($str_val);
        return $val;
    }
}
