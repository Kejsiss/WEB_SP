<?php

/**
 * Trida spravujici databazi.
 */
class DatabaseModel {

    /** @var PDO $pdo  Objekt pracujici s databazi prostrednictvim PDO. */
    private $pdo;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace DB
        $this->pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
        // vynuceni kodovani UTF-8
        $this->pdo->exec("set names utf8");
    }

    /**
     *  Vrati seznam vsech pohadek pro uvodni stranku.
     *  @return array Obsah uvodu.
     */
    public function getAllIntroductions():array {
        // pripravim dotaz
        $q = "SELECT * FROM ".TABLE_INTRODUCTION;
        // provedu a vysledek vratim jako pole
        // protoze je o uzkazku, tak netestuju, ze bylo neco vraceno
        return $this->pdo->query($q)->fetchAll();
    }
    
    
    /**
     *  Vrati seznam vsech uzivatelu pro spravu uzivatelu.
     *  @return array Obsah spravy uzivatelu.
     */
    public function getAllUsers():array {
        // pripravim dotaz
        $q = "SELECT * FROM ".TABLE_USER;
        // provedu a vysledek vratim jako pole
        // protoze je o uzkazku, tak netestuju, ze bylo neco vraceno
        return $this->pdo->query($q)->fetchAll();
    }
    
    /**
     *  Smaze daneho uzivatele z DB.
     *  @param int $userId  ID uzivatele.
     */
    public function deleteUser(int $userId):bool {
        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_USER." WHERE id_user = $userId";
        // provedu dotaz
        $res = $this->pdo->query($q);
        // pokud neni false, tak vratim vysledek, jinak null
        if ($res) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }
    }


    public function getAllRivers():array{
        $q = "SELECT * FROM ".TABLE_REKA;
        return $this->pdo->query($q)->fetchAll();
    }

    public function getReviewByRiver(int $riverId):array{

        $q = "SELECT ".TABLE_REKA.".nazev, ".TABLE_SJIZDI.".datum_sjezdu, ".TABLE_SJIZDI.".recenze_reky, ".TABLE_UZIVATEL.
            ".username, ".TABLE_UZIVATEL.".jmeno, ".TABLE_UZIVATEL.".prijmeni FROM ".TABLE_REKA." ,".TABLE_SJIZDI." ,".TABLE_UZIVATEL.
            " WHERE ".TABLE_REKA.".id_reka = ".TABLE_SJIZDI.".id_reka AND ".TABLE_UZIVATEL.".id_UZIVATEL = ".TABLE_SJIZDI.".id_uzivatel AND ".TABLE_REKA.".id_reka = $riverId";
        return $this->pdo->query($q)->fetchAll();
    }

    public function getAllReviewsRivers():array{
        $q = "SELECT ".TABLE_REKA.".nazev, ".TABLE_SJIZDI.".datum_sjezdu, ".TABLE_SJIZDI.".recenze_reky, ".TABLE_UZIVATEL.
            ".username, ".TABLE_UZIVATEL.".jmeno, ".TABLE_UZIVATEL.".prijmeni FROM ".TABLE_REKA." ,".TABLE_SJIZDI." ,".TABLE_UZIVATEL.
            " WHERE ".TABLE_REKA.".id_reka = ".TABLE_SJIZDI.".id_reka AND ".TABLE_UZIVATEL.".id_UZIVATEL = ".TABLE_SJIZDI.".id_uzivatel";
        return $this->pdo->query($q)->fetchAll();
    }

    //TO DO pod tim

    public function getAllCamps():array{
        $q = "SELECT * FROM ".TABLE_TABORISTE;
        return $this->pdo->query($q)->fetchAll();
    }

    public function getReviewByCamp(int $campId):array{

        $q = "SELECT ".TABLE_TABORI.".datum_utaboreni, ".TABLE_TABORI.".recenze_taboriste, ".TABLE_UZIVATEL.
            ".username, ".TABLE_UZIVATEL.".jmeno, ".TABLE_UZIVATEL.".prijmeni FROM ".TABLE_TABORISTE." ,".TABLE_TABORI." ,".TABLE_UZIVATEL." ,".TABLE_SJIZDI.
            " WHERE ".TABLE_TABORISTE.".id_taboriste = ".TABLE_TABORI.".id_taboriste AND ".TABLE_UZIVATEL.".id_UZIVATEL = ".TABLE_SJIZDI.".id_uzivatel AND ".
            TABLE_TABORISTE.".id_taboriste = $campId AND ".TABLE_TABORI.".id_sjizdi = ".TABLE_SJIZDI.".id_sjizdi";
        return $this->pdo->query($q)->fetchAll();
    }

    public function getAllReviewsCamps():array{
        $q = "SELECT ".TABLE_REKA.".nazev, ".TABLE_SJIZDI.".datum_sjezdu, ".TABLE_SJIZDI.".recenze_reky, ".TABLE_UZIVATEL.
            ".username, ".TABLE_UZIVATEL.".jmeno, ".TABLE_UZIVATEL.".prijmeni FROM ".TABLE_TABORISTE." ,".TABLE_SJIZDI." ,".TABLE_UZIVATEL." ,".TABLE_TABORI.
            " WHERE ".TABLE_TABORISTE.".id_taboriste = ".TABLE_TABORI.".id_taboriste AND ".TABLE_UZIVATEL.".id_UZIVATEL = ".TABLE_SJIZDI.".id_uzivatel";
        return $this->pdo->query($q)->fetchAll();
    }

}

?>