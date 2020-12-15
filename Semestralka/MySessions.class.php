<?php

/**
 *  Objekt pro praci se Session.
 *  @author Michal Nykl
 */
class MySessions{

    public static function sessionStarted() {
        if(session_id() == '') {
            return false;
        } else {
            return true;
        }
    }

    public static function sessionExists($session) {
        if(self::sessionStarted() == false) {
            session_start();
        }
        if(isset($_SESSION[$session])) {
            return true;
        } else {
            return false;
        }
    }

    public static function setSession($session, $value) {
        try{
            if(self::sessionStarted() != true) {
                session_start();
            }
            $_SESSION[$session] = $value;
            if(self::sessionExists($session) == false) {
                throw new Exception('Unable to Create Session');
            }
        }catch (Exception $ex){
            die($ex->getMessage());
        }

    }

    public static function getSession($session) {
        try{
            if(self::sessionStarted() != true) {
                session_start();
            }
            if(isset($_SESSION[$session])) {
                return $_SESSION[$session];
            } else {
                throw new Exception('Session Does Not Exist');
            }
        }catch (Exception $ex){
            die($ex->getMessage());
        }

    }

    public static function removeSession($session) {
        try{
            if(isset($_SESSION[$session])) {
                unset($_SESSION[$session]);
            } else {
                throw new Exception('Session Does Not Exist');
            }
        }catch (Exception $ex){
            die($ex->getMessage());
        }

    }
    
}
?>