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

    public function getRiverDown($riverId, $userId) {

        $q = "SELECT sjizdi.id_SJIZDI, sjizdi.datum_sjezdu FROM sjizdi WHERE sjizdi.id_reka = :riverId AND sjizdi.id_uzivatel = :userId";

        $res = $this->pdo->prepare($q);
        $res->bindValue("userId",$userId);
        $res->bindValue("riverId",$riverId);


        if ($res->execute()) {
            return $res->fetchAll();
        }
        else { return null;}

    }

    public function addRiver(string $nazev, int $delka, int $pocet_jezu):bool{

        $nazev = htmlspecialchars($nazev);

        $q = "INSERT INTO ".TABLE_REKA."(nazev,delka,pocet_jezu) 
        VALUES(:nazev, :delka, :pocet)";

        $res = $this->pdo->prepare($q);
        $res->bindValue("nazev",$nazev);
        $res->bindValue("delka",$delka);
        $res->bindValue("pocet",$pocet_jezu);


        if ($res->execute()) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }
    }

    public function addCamp(string $nazev, int $kapacita, int $cena_za_noc, string $parkoviste, string $wc, string $sprchy, string $restaurace, int $riverId):bool{

        $nazev = htmlspecialchars($nazev);
        $kapacita = htmlspecialchars($kapacita);
        $cena_za_noc = htmlspecialchars($cena_za_noc);
        $parkoviste = htmlspecialchars($parkoviste);
        $wc = htmlspecialchars($wc);
        $sprchy = htmlspecialchars($sprchy);
        $restaurace = htmlspecialchars($restaurace);


        $q = "INSERT INTO ".TABLE_TABORISTE."(nazev,kapacita,cena_za_noc,parkoviste,wc,sprchy,restaurace, id_reka) 
        VALUES(:nazev, :kapacita, :cena, :parkoviste, :wc, :sprchy, :restaurace, :riverId)";

        $res = $this->pdo->prepare($q);
        $res->bindValue("nazev",$nazev);
        $res->bindValue("kapacita",$kapacita);
        $res->bindValue("cena",$cena_za_noc);
        $res->bindValue("parkoviste",$parkoviste);
        $res->bindValue("wc",$wc);
        $res->bindValue("sprchy",$sprchy);
        $res->bindValue("restaurace",$restaurace);
        $res->bindValue("riverId",$riverId);


        if ($res->execute()) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }
    }

    public function addRiverReview(int $userId, string $date, string $review, int $riverId):bool{

        $date = htmlspecialchars($date);
        $review = htmlspecialchars($review);

        $q = "INSERT INTO ".TABLE_SJIZDI."(recenze_reky,datum_sjezdu,id_uzivatel,id_reka) 
        VALUES(:review, :datum, :userId, :riverId)";

        $res = $this->pdo->prepare($q);

        $res->bindValue("datum",$date);
        $res->bindValue("review",$review);
        $res->bindValue("userId",$userId);
        $res->bindValue("riverId",$riverId);


        if ($res->execute()) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }

    }

    public function addCampReview(string $date, string $review, int $riverId, int $campId):bool{

        $date = htmlspecialchars($date);
        $review = htmlspecialchars($review);

        $q = "INSERT INTO ".TABLE_TABORI."(datum_utaboreni,recenze_taboriste,id_sjizdi,id_taboriste) 
        VALUES(:datum, :review, :riverId, :campId)";

        $res = $this->pdo->prepare($q);

        $res->bindValue("datum",$date);
        $res->bindValue("review",$review);
        $res->bindValue("campId",$campId);
        $res->bindValue("riverId",$riverId);


        if ($res->execute()) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }

    }


    public function getRiversReviewsByUser(int $userId){

        $userId = htmlspecialchars($userId);

        $q = "SELECT ".TABLE_SJIZDI.".id_SJIZDI, ".TABLE_REKA.".nazev, ".TABLE_SJIZDI.".recenze_reky, ".TABLE_SJIZDI.".datum_sjezdu FROM ".TABLE_REKA.", "
            .TABLE_SJIZDI.", ".TABLE_UZIVATEL." WHERE ".TABLE_REKA.".id_REKA = ".TABLE_SJIZDI.".id_reka AND "
            .TABLE_SJIZDI.".id_uzivatel = ".TABLE_UZIVATEL.".id_UZIVATEL AND ".TABLE_UZIVATEL.".id_UZIVATEL = :userId";

        $res = $this->pdo->prepare($q);
        $res->bindValue("userId",$userId);


        if ($res->execute()) {
            return $res->fetchAll();
        }
        else { return null;}


    }

    public function getCampsReviewsByUser(int $userId){

        $userId = htmlspecialchars($userId);

        $q = "SELECT ".TABLE_TABORI.".id_TABORI, ".TABLE_TABORISTE.".nazev, ".TABLE_TABORI.".recenze_taboriste, ".TABLE_TABORI.".datum_utaboreni FROM ".TABLE_TABORISTE.", "
            .TABLE_TABORI.", ".TABLE_UZIVATEL.", ".TABLE_SJIZDI." WHERE ".TABLE_TABORISTE.".id_TABORISTE = ".TABLE_TABORI.".id_taboriste 
            AND ".TABLE_TABORI.".id_sjizdi = ".TABLE_SJIZDI.".id_SJIZDI AND " .TABLE_SJIZDI.".id_uzivatel = ".TABLE_UZIVATEL.".id_UZIVATEL AND ".TABLE_UZIVATEL.".id_UZIVATEL = :userId";

        $res = $this->pdo->prepare($q);
        $res->bindValue("userId",$userId);


        if ($res->execute()) {
            return $res->fetchAll();
        }
        else { return null;}

    }


    public function getAllRivers():array{
        $q = "SELECT * FROM ".TABLE_REKA;
        return $this->pdo->query($q)->fetchAll();
    }

    public function getAllUserRivers(int $userId){

        $userId = htmlspecialchars($userId);

        $q = "SELECT ".TABLE_SJIZDI.".id_SJIZDI, ".TABLE_SJIZDI.".datum_sjezdu FROM ".TABLE_SJIZDI." WHERE ".TABLE_SJIZDI.".id_uzivatel = :userId";

        $res = $this->pdo->prepare($q);
        $res->bindValue("userId",$userId);


        if ($res->execute()) {
            return $res->fetchAll();
        }
        else { return null;}
    }

    public function getReviewByRiver(int $riverId){

        $riverId = htmlspecialchars($riverId);

        $q = "SELECT ".TABLE_REKA.".nazev, ".TABLE_SJIZDI.".datum_sjezdu, ".TABLE_SJIZDI.".recenze_reky, ".TABLE_UZIVATEL.
            ".username, ".TABLE_UZIVATEL.".jmeno, ".TABLE_UZIVATEL.".prijmeni FROM ".TABLE_REKA." ,".TABLE_SJIZDI." ,".TABLE_UZIVATEL.
            " WHERE ".TABLE_REKA.".id_reka = ".TABLE_SJIZDI.".id_reka AND ".TABLE_UZIVATEL.".id_UZIVATEL = ".TABLE_SJIZDI.".id_uzivatel AND ".TABLE_REKA.".id_reka = :riverId";

        $res = $this->pdo->prepare($q);
        $res->bindValue("riverId",$riverId);


        if ($res->execute()) {
            return $res->fetchAll();
        }
        else { return null;}
    }

    public function getAllCamps():array{
        $q = "SELECT * FROM ".TABLE_TABORISTE;
        return $this->pdo->query($q)->fetchAll();
    }

    public function getReviewByCamp(int $campId){

        $campId = htmlspecialchars($campId);

        $q = "SELECT ".TABLE_TABORI.".datum_utaboreni, ".TABLE_TABORI.".recenze_taboriste, ".TABLE_UZIVATEL.
            ".username, ".TABLE_UZIVATEL.".jmeno, ".TABLE_UZIVATEL.".prijmeni FROM ".TABLE_TABORISTE." ,".TABLE_TABORI." ,".TABLE_UZIVATEL." ,".TABLE_SJIZDI.
            " WHERE ".TABLE_TABORISTE.".id_taboriste = ".TABLE_TABORI.".id_taboriste AND ".TABLE_UZIVATEL.".id_UZIVATEL = ".TABLE_SJIZDI.".id_uzivatel AND ".
            TABLE_TABORISTE.".id_taboriste = :campId AND ".TABLE_TABORI.".id_sjizdi = ".TABLE_SJIZDI.".id_sjizdi";

        $res = $this->pdo->prepare($q);
        $res->bindValue("campId",$campId);


        if ($res->execute()) {
            return $res->fetchAll();
        }
        else { return null;}
    }


    public function deleteRiverReview(int $reviewId):bool {

        $reviewId = htmlspecialchars($reviewId);

        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_SJIZDI." WHERE id_SJIZDI = :review";

        $res = $this->pdo->prepare($q);
        $res->bindValue("review",$reviewId);

        if ($res->execute()) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }
    }

    public function deleteCampReview(int $reviewId):bool {

        $reviewId = htmlspecialchars($reviewId);

        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_TABORI." WHERE id_TABORI = :review";

        $res = $this->pdo->prepare($q);
        $res->bindValue("review",$reviewId);

        if ($res->execute()) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }
    }

    public function deleteAllUserRiverReviews(int $userId):bool{

        $userId = htmlspecialchars($userId);

        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_SJIZDI." WHERE id_uzivatel = :userId";

        $res = $this->pdo->prepare($q);
        $res->bindValue("userId",$userId);

        if ($res->execute()) {
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
        $q = "DELETE FROM ".TABLE_TABORI." WHERE id_sjizdi = :sjizdi";

        $res = $this->pdo->prepare($q);
        $res->bindValue("sjizdi",$sjizdiId);

        if ($res->execute()) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }
    }

    private function getSjizdiID($userId):int {

        $userId = htmlspecialchars($userId);

        $q = "SELECT id_SJIZDI FROM ".TABLE_SJIZDI." WHERE ".TABLE_SJIZDI.".id_uzivatel = :userId";

        $res = $this->pdo->prepare($q);
        $res->bindValue("userId",$userId);

        if ($res->execute()) {
            // neni false
            return $res->fetchColumn();
        }
    }
}

?>