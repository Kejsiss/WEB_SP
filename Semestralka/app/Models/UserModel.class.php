<?php

/**
 * Trida spravujici databazi.
 */
class UserModel {

    /** @var PDO $pdo  Objekt pracujici s databazi prostrednictvim PDO. */
    private $pdo;

    /** @var string $userSessionKey  Klicem pro data uzivatele, ktera jsou ulozena v session. */
    private $userSessionKey = "current_user_id";
    private $userSessionRight = "user_right";


    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace DB
        $this->pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
        // vynuceni kodovani UTF-8
        $this->pdo->exec("set names utf8");

        require_once("MySessions.class.php");
    }

    /**
     * Overi, zda muse byt uzivatel prihlasen a pripadne ho prihlasi.
     *
     * @param string $login     Login uzivatele.
     * @param string $heslo     Heslo uzivatele.
     * @return bool             Byl prihlasen?
     */
    public function userLogin(string $login, string $password){

        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);

        $q = "SELECT * FROM ".TABLE_UZIVATEL." WHERE username = :login";


        $res = $this->pdo->prepare($q);
        $res->bindValue("login",$login);


        // pokud neni false, tak vratim vysledek, jinak null
        if ($res->execute()) {

                $vysledek = $res->fetch(PDO::FETCH_OBJ);
                $hashedPassword = $vysledek->heslo;
                if(password_verify($password, $hashedPassword)) {
                    // ziskal - ulozim ho do session


                    MySessions::setSession($this->userSessionKey,$vysledek->id_UZIVATEL);
                    MySessions::setSession($this->userSessionRight, $vysledek->id_pravo);
                    return true;

                } else {
                    // neziskal jsem uzivatele
                    return false;
                }
        }
        else { return false; }
    }



    /**
     * Odhlasi soucasneho uzivatele.
     */
    public function userLogout(){
        MySessions::removeSession($this->userSessionKey);
    }

    /**
     * Test, zda je nyni uzivatel prihlasen.
     *
     * @return bool     Je prihlasen?
     */
    public function isUserLogged(){
        return MySessions::sessionExists($this->userSessionKey);
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

        $userId = htmlspecialchars($userId);

        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_UZIVATEL." WHERE id_UZIVATEL = :userID";


        $res = $this->pdo->prepare($q);
        $res->bindValue("userID",$userId);


        // pokud neni false, tak vratim vysledek, jinak null
        if ($res->execute()) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }
    }


    public function addUser(string $login, string $heslo, string $jmeno, string $prijmeni, string $email, int $idPravo):bool{

        $login = htmlspecialchars($login);
        $heslo = htmlspecialchars($heslo);
        $jmeno = htmlspecialchars($jmeno);
        $prijmeni = htmlspecialchars($prijmeni);
        $email = htmlspecialchars($email);

        $heslo = password_hash($heslo, PASSWORD_DEFAULT);

        $q = "INSERT INTO ".TABLE_UZIVATEL."(username,heslo,jmeno,prijmeni,email,id_PRAVO) 
        VALUES(:login, :heslo, :jmeno, :prijmeni, :email, :id_pravo)";


        $res = $this->pdo->prepare($q);
        $res->bindValue("login",$login);
        $res->bindValue("heslo",$heslo);
        $res->bindValue("jmeno",$jmeno);
        $res->bindValue("prijmeni",$prijmeni);
        $res->bindValue("email",$email);
        $res->bindValue("id_pravo",$idPravo);

        // pokud neni false, tak vratim vysledek, jinak null
        if ($res->execute()) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }
    }

    public function appointManager($userId):bool{

        $userId = htmlspecialchars($userId);

        $q ="UPDATE ".TABLE_UZIVATEL." SET id_pravo = 2 WHERE id_UZIVATEL = :userId";

        $res = $this->pdo->prepare($q);
        $res->bindValue("userId",$userId);

        // pokud neni false, tak vratim vysledek, jinak null
        if ($res->execute()) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }
    }

    public function getAllPaddlers():array{
        $q = "SELECT id_UZIVATEL, username FROM ".TABLE_UZIVATEL." WHERE id_pravo = 3";
        return $this->pdo->query($q)->fetchAll();
    }

}
?>