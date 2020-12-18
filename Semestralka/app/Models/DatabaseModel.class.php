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
        $this->pdo = new PDO("mysql:host=localhost;dbname=kivweb", "root", "");
        // vynuceni kodovani UTF-8
        $this->pdo->exec("set names utf8");
    }

    public function getRiverDown($riverId, $userId):array {

        $q = "SELECT sjizdi.id_SJIZDI, sjizdi.datum_sjezdu FROM sjizdi WHERE sjizdi.id_reka = $riverId AND sjizdi.id_uzivatel = $userId";

        return $this->pdo->query($q)->fetchAll();
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

    public function addCamp(string $nazev, int $kapacita, int $cena_za_noc, string $parkoviste, string $wc, string $sprchy, string $restaurace, int $idRiver):bool{

        $q = "INSERT INTO ".TABLE_TABORISTE."(nazev,kapacita,cena_za_noc,parkoviste,wc,sprchy,restaurace, id_reka) 
        VALUES('$nazev', $kapacita, $cena_za_noc, '$parkoviste', '$wc', '$sprchy', '$restaurace', $idRiver)";

        //die(print_r($q));
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

    public function addRiverReview(int $userId, string $date, string $review, int $riverId):bool{


        $q = "INSERT INTO ".TABLE_SJIZDI."(recenze_reky,datum_sjezdu,id_uzivatel,id_reka) 
        VALUES('$review', STR_TO_DATE('$date', '%Y-%m-%d'), $userId, $riverId)";

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

    public function addCampReview(string $date, string $review, int $riverId, int $campId):bool{

        $q = "INSERT INTO ".TABLE_TABORI."(datum_utaboreni,recenze_taboriste,id_sjizdi,id_taboriste) 
        VALUES($date, '$review', $riverId, $campId)";

        //die(print_r($q));

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


    public function getRiversReviewsByUser(int $userId):array{

        $q = "SELECT ".TABLE_SJIZDI.".id_SJIZDI, ".TABLE_REKA.".nazev, ".TABLE_SJIZDI.".recenze_reky, ".TABLE_SJIZDI.".datum_sjezdu FROM ".TABLE_REKA.", "
            .TABLE_SJIZDI.", ".TABLE_UZIVATEL." WHERE ".TABLE_REKA.".id_REKA = ".TABLE_SJIZDI.".id_reka AND "
            .TABLE_SJIZDI.".id_uzivatel = ".TABLE_UZIVATEL.".id_UZIVATEL AND ".TABLE_UZIVATEL.".id_UZIVATEL = $userId";
        return $this->pdo->query($q)->fetchAll();
    }

    public function getCampsReviewsByUser(int $userId):array{

        $q = "SELECT ".TABLE_TABORI.".id_TABORI, ".TABLE_TABORISTE.".nazev, ".TABLE_TABORI.".recenze_taboriste, ".TABLE_TABORI.".datum_utaboreni FROM ".TABLE_TABORISTE.", "
            .TABLE_TABORI.", ".TABLE_UZIVATEL.", ".TABLE_SJIZDI." WHERE ".TABLE_TABORISTE.".id_TABORISTE = ".TABLE_TABORI.".id_taboriste 
            AND ".TABLE_TABORI.".id_sjizdi = ".TABLE_SJIZDI.".id_SJIZDI AND " .TABLE_SJIZDI.".id_uzivatel = ".TABLE_UZIVATEL.".id_UZIVATEL AND ".TABLE_UZIVATEL.".id_UZIVATEL = $userId";

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

    public function getAllUserRivers(int $userId):array{
        $q = "SELECT ".TABLE_SJIZDI.".id_SJIZDI, ".TABLE_SJIZDI.".datum_sjezdu FROM ".TABLE_SJIZDI." WHERE ".TABLE_SJIZDI.".id_uzivatel = $userId";

        return $this->pdo->query($q)->fetchAll();
    }

    public function getReviewByRiver(int $riverId):array{

        $q = "SELECT ".TABLE_REKA.".nazev, ".TABLE_SJIZDI.".datum_sjezdu, ".TABLE_SJIZDI.".recenze_reky, ".TABLE_UZIVATEL.
            ".username, ".TABLE_UZIVATEL.".jmeno, ".TABLE_UZIVATEL.".prijmeni FROM ".TABLE_REKA." ,".TABLE_SJIZDI." ,".TABLE_UZIVATEL.
            " WHERE ".TABLE_REKA.".id_reka = ".TABLE_SJIZDI.".id_reka AND ".TABLE_UZIVATEL.".id_UZIVATEL = ".TABLE_SJIZDI.".id_uzivatel AND ".TABLE_REKA.".id_reka = $riverId";
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


    public function deleteRiverReview(int $reviewId):bool {
        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_SJIZDI." WHERE id_SJIZDI = $reviewId";
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

    public function deleteCampReview(int $reviewId):bool {
        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_TABORI." WHERE id_TABORI = $reviewId";
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

    public function deleteAllUserRiverReviews(int $userId):bool{
        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_SJIZDI." WHERE id_uzivatel = $userId";
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

    public function deleteAllUserCampsReviews(int $userId):bool{

        $sjizdiId = $this->getSjizdiID($userId);

        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_TABORI." WHERE id_sjizdi = $sjizdiId";
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

    private function getSjizdiID($userId):int {
        $q = "SELECT id_SJIZDI FROM ".TABLE_SJIZDI." WHERE ".TABLE_SJIZDI.".id_uzivatel = $userId";
        return $this->pdo->query($q)->fetchColumn();
    }
}

?>