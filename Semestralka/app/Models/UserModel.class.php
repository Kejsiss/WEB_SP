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
     *  Provede dotaz a bud vrati ziskana data, nebo pri chybe ji vypise a vrati null.
     *
     *  @param string $dotaz        SQL dotaz.
     *  @return PDOStatement|null    Vysledek dotazu.
     */
    private function executeQuery(string $dotaz){
        // vykonam dotaz
        $res = $this->pdo->query($dotaz);
        // pokud neni false, tak vratim vysledek, jinak null
        if ($res) {
            // neni false
            return $res;
        } else {
            return null;
        }
    }

    /**
     * Jednoduche cteni z prislusne DB tabulky.
     *
     * @param string $tableName         Nazev tabulky.
     * @param string $whereStatement    Pripadne omezeni na ziskani radek tabulky. Default "".
     * @param string $orderByStatement  Pripadne razeni ziskanych radek tabulky. Default "".
     * @return array                    Vraci pole ziskanych radek tabulky.
     */
    public function selectFromTable(string $tableName, string $whereStatement = ""):array {
        // slozim dotaz
        $q = "SELECT * FROM ".$tableName
            .(($whereStatement == "") ? "" : " WHERE $whereStatement");


        // provedu ho a vratim vysledek
        $obj = $this->executeQuery($q);
        // pokud je null, tak vratim prazdne pole
        if($obj == null){
            return [];
        }
        // prevedu vsechny ziskane radky tabulky na pole
        return $obj->fetchAll();
    }

    /**
     * Overi, zda muse byt uzivatel prihlasen a pripadne ho prihlasi.
     *
     * @param string $login     Login uzivatele.
     * @param string $heslo     Heslo uzivatele.
     * @return bool             Byl prihlasen?
     */
    public function userLogin(string $login, string $password){

        $where = "username='$login'";
        $user = $this->selectFromTable(TABLE_UZIVATEL, $where);
        // ziskal jsem uzivatele
        if(count($user)){
            $hashedPassword = $user[0]['heslo'];
            if(password_verify($password, $hashedPassword)) {
                // ziskal - ulozim ho do session


                MySessions::setSession($this->userSessionKey,$user[0]['id_UZIVATEL']);
                MySessions::setSession($this->userSessionRight, $user[0]['id_pravo']);

                //$_SESSION[$this->userSessionKey] = $user[0]['id_UZIVATEL']; // beru prvniho nalezeneho a ukladam jen jeho ID
                return true;
            }

        } else {
            // neziskal jsem uzivatele
            return false;
        }
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
        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_UZIVATEL." WHERE id_UZIVATEL = $userId";
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

    public function appointManager($userId):bool{

        $q ="UPDATE ".TABLE_UZIVATEL." SET id_pravo = 2 WHERE id_UZIVATEL = $userId";

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

    public function getAllPaddlers():array{
        $q = "SELECT id_UZIVATEL, username FROM ".TABLE_UZIVATEL." WHERE id_pravo = 3";
        return $this->pdo->query($q)->fetchAll();
    }

    public function getAllRights():array{
        $q = "SELECT * FROM ".TABLE_PRAVO;
        return $this->pdo->query($q)->fetchAll();
    }

    public function getRightById(int $userId):int {
        $q = "SELECT id_pravo FROM ".TABLE_UZIVATEL." WHERE id_UZIVATEL = $userId";
        return $this->pdo->query($q)->fetch();
    }
}
?>