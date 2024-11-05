<?php

namespace App\Libaraies;

class Hash{


    public static function encrypt($password){
        return password_hash($password, PASSWORD_BCRYPT);

    }

    //check user password
    public static function check($userPassword, $dbUserPaaword){
        if(oassword_verify($userPassword,$dbUserPaaword)){
            return true;
        }
        return false;
    }
}