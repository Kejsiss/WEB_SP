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
     *  Vrati seznam vsech uzivatelu pro spravu uzivatelu.
     *  @return array Obsah spravy uzivatelu.
     */
    public function getAllUsers():array {
        // pripravim dotaz
        $q = "SELECT * FROM ".TABLE_UZIVATEL;
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

    public function addUser(string $login, string $heslo, string $jmeno, string $prijmeni, string $email, int $idPravo):bool{

        $heslo = password_hash($heslo, PASSWORD_DEFAULT);

        $q = "INSERT INTO ".TABLE_UZIVATEL."(username,heslo,jmeno,prijmeni,email,id_PRAVO) 
        VALUES('$login', '$heslo', '$jmeno', '$prijmeni','$email', $idPravo)";

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

    public function addRiver(string $nazev, int $delka, int $pocet_jezu):bool{

        $q = "INSERT INTO ".TABLE_REKA."(nazev,delka,pocet_jezu) 
        VALUES('$nazev', $delka, $pocet_jezu)";

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

    public function addCamp(string $nazev, int $kapacita, int $cena_za_noc, int $parkoviste, int $wc, int $sprchy, int $restaurace):bool{

        $q = "INSERT INTO ".TABLE_TABORISTE."(nazev,kapacita,cena_za_noc,parkoviste,wc,sprchy,restaurace) 
        VALUES('$nazev', $kapacita, $cena_za_noc, $parkoviste, $wc, $sprchy, $restaurace)";

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

    public function addRiverReview(int $userId, date $date, string $review, string $nazevReky):bool{

        $RekaId = $this->getRiverIdByName($nazevReky);

        $q = "INSERT INTO ".TABLE_SJIZDI."(recenze_reky,datum_sjezdu,id_uzivatel,id_reka) 
        VALUES('$review', $date, $userId, $RekaId)";

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

    public function addCampReview(date $date, string $review, string $nazevKempu, string $nazevReky):bool{

        //tohle mozna nebude fungovat, viz slozeni databaze, potreba sjizdi
        $RekaId = $this->getRiverIdByName($nazevReky);
        $KempId = $this->getCampIdByName($nazevKempu);

        $q = "INSERT INTO ".TABLE_TABORISTE."(datum_utaboreni,recenze_taboriste,id_sjizdi,id_taboriste) 
        VALUES($date, '$review', $RekaId, $KempId)";

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

    public function getCampIdByName(string $nazevKempu):int{
        $q = "SELECT ".TABLE_TABORISTE.".id_TABORISTE FROM ".TABLE_TABORISTE." WHERE ".TABLE_TABORISTE.".nazev = '$nazevKempu'";
        return $q;
    }

    public function getRiverIdByName(string $nazevReky):int{
        $q = "SELECT ".TABLE_REKA.".id_REKA FROM ".TABLE_REKA." WHERE ".TABLE_REKA.".nazev = '$nazevReky'";
        return $q;
    }

    public function getRiversReviewsByUser(int $userId):array{

        $q = "SELECT ".TABLE_REKA.".nazev, ".TABLE_SJIZDI.".recenze_reky, ".TABLE_SJIZDI.".datum_sjezdu FROM ".TABLE_REKA.", "
            .TABLE_SJIZDI.", ".TABLE_UZIVATEL." WHERE ".TABLE_REKA.".id_REKA = ".TABLE_SJIZDI.".id_reka AND "
            .TABLE_SJIZDI.".id_uzivatel = ".TABLE_UZIVATEL.".id_UZIVATEL AND ".TABLE_UZIVATEL.".id_UZIVATEL = $userId";
        return $this->pdo->query($q)->fetchAll();
    }

    public function getCampsReviewsByUser(int $userId):array{

        $q = "SELECT ".TABLE_TABORISTE.".nazev, ".TABLE_TABORI.".recenze_taboriste, ".TABLE_TABORI.".datum_utaboreni FROM ".TABLE_TABORISTE.", "
            .TABLE_TABORI.", ".TABLE_UZIVATEL." WHERE ".TABLE_TABORISTE.".id_TABORISTE = ".TABLE_TABORI.".id_taboriste AND "
            .TABLE_TABORI.".id_uzivatel = ".TABLE_UZIVATEL.".id_UZIVATEL AND ".TABLE_UZIVATEL.".id_UZIVATEL = $userId";
        return $this->pdo->query($q)->fetchAll();

    }

    public function getAllRights():array{
        $q = "SELECT * FROM ".TABLE_PRAVO;
        return $this->pdo->query($q)->fetchAll();
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