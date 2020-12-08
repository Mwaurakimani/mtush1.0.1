<?php

class systemServices{
    public function passwordChecker($password){
        if(password_verify($password,"password")){
            return true;
        }else{
            return false;
        }
    }
}