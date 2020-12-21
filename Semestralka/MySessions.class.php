<?php

/**
 *  Objekt pro praci se Session.
 * @author Kment
 */
class MySessions{

    /**
     * Metoda vraci zda session jiz zacala nebo ne
     * @return bool zda zacala nebo ne
     */
    public static function sessionStarted() {
        if(session_id() == '') {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Metoda vraci zda session z danym jmenem existuje
     * @param $session jmeno sessionu
     * @return bool zda existuje
     */
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

    /**
     * Natavuje session
     * @param $session jmeno
     * @param $value hodnota
     */
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

    /**
     * vraci bezici session nebo ji zacina
     * @param $session bezici session
     * @return mixed
     */
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

    /**
     * Odstarani session s danym jmenem
     * @param $session jmeno
     */
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