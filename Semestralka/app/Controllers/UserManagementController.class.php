<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladac zajistujici vypsani stranky se spravou uzivatelu.
 */
class UserManagementController implements IController {

    /** @var DatabaseModel $db  Sprava databaze. */
    private $db;
    private $um;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/DatabaseModel.class.php");
        require_once (DIRECTORY_MODELS ."/UserModel.class.php");
        $this->db = new DatabaseModel();
        $this->um = new UserModel();
    }

    /**
     * Vrati obsah stranky se spravou uzivatelu.
     * @param string $pageTitle     Nazev stranky.
     * @return string               Vypis v sablone.
     */
    public function show(string $pageTitle):string {
        //// vsechna data sablony budou globalni
        global $tplData;
        $tplData = [];
        // nazev
        $tplData['title'] = $pageTitle;

        //// neprisel pozadavek na smazani uzivatele?
        if(isset($_POST['action']) and $_POST['action'] == "delete"
            and isset($_POST['id_user'])
        ){
            $deleteTabori = $this->db->deleteAllUserCampsReviews(intval($_POST['id_user']));
            if($deleteTabori){

                $deleteSjizdi = $this->db->deleteAllUserRiverReviews(intval($_POST['id_user']));
                if($deleteSjizdi){
                    // provedu smazani uzivatele
                    $ok = $this->um->deleteUser(intval($_POST['id_user']));
                    if($ok){
                        $tplData['delete'] = "OK: Uživatel s ID:$_POST[id_user] byl smazán z databáze.";
                    } else {
                        $tplData['delete'] = "CHYBA: Uživatele s ID:$_POST[id_user] se nepodařilo smazat z databáze.";
                    }
                } else {
                    $tplData['delete'] = "CHYBA: Uživatele s ID:$_POST[id_user] se nepodařilo smazat z databáze. (Nepodařilo se smazat jeho recenze řek)";
                }

            } else {
                $tplData['delete'] = "CHYBA: Uživatele s ID:$_POST[id_user] se nepodařilo smazat z databáze. (Nepodařilo se smazat jeho recenze tábořišť)";
            }


        }

        //// nactu aktulani data uzivatelu
        $tplData['users'] = $this->um->getAllUsers();

        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/UserManagementTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }

}

?>