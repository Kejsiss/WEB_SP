<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky se spravou uzivatelu  ///////////
///////////////////////////////////////////////////////////////////////////

//// pozn.: sablona je samostatna a provadi primy vypis do vystupu:
// -> lze testovat bez zbytku aplikace.
// -> pri vyuziti Twigu se sablona obejde bez PHP.

/*
////// Po zakomponovani do zbytku aplikace bude tato cast odstranena/zakomentovana  //////
//// UKAZKA DAT: Uvod bude vypisovat informace z tabulky, ktera ma nasledujici sloupce:
// id, date, author, title, text
$tplData['title'] = "Sprava uživatelů (TPL)";
$tplData['users'] = [
    array("id_user" => 1, "first_name" => "František", "last_name" => "Noha",
            "login" => "frnoha", "password" => "Tajne*Heslo", "email" => "fr.noha@ukazka.zcu.cz", "web" => "www.zcu.cz")
];
$tplData['delete'] = "Úspěšné mazání.";
define("DIRECTORY_VIEWS", "../Views");
const WEB_PAGES = array(
    "uvod" => array("title" => "Sprava uživatelů (TPL)")
);
////// KONEC: Po zakomponovani do zbytku aplikace bude tato cast odstranena/zakomentovana  //////
*/


//// vypis sablony
// urceni globalnich promennych, se kterymi sablona pracuje
global $tplData;



// pripojim objekt pro vypis hlavicky a paticky HTML
require(DIRECTORY_VIEWS ."/ZakladHTML.class.php");
$tplHeaders = new ZakladHTML();

?>
    <!-- ------------------------------------------------------------------------------------------------------- -->

    <!-- Vypis obsahu sablony -->
<?php
// muze se hodit:
//<form method='post'>
//    <input type='hidden' name='id_user' value=''>
//    <button type='submit' name='action' value='delete'>Smazat</button>
//</form>

// hlavicka
$tplHeaders->getHTMLHeader($tplData['title']);

$res = "<h2 class='text-center'>Naše databáze obsahuje následující tábořiště:</h2><br><div class='container'>";

foreach($tplData['camps'] as $c){
    $res .= "<h3>$c[nazev]</h3>"
        ."<p>Kapacita tábořiště: $c[kapacita]</p>"
        ."<p>Cena za noc: $c[cena_za_noc]</p>"
        ."<p>Parkoviště: ".(boolval($c['parkoviste']) ? 'Ano' : 'Ne')."</p>"
        ."<p>WC: ".(boolval($c['wc']) ? 'Ano' : 'Ne')."</p>"
        ."<p>Sprchy: ".(boolval($c['sprchy']) ? 'Ano' : 'Ne')."</p>"
        ."<p>Restaurace: ".(boolval($c['restaurace']) ? 'Ano' : 'Ne')."</p><hr>";
}

$res .= "</div>";

echo $res;


// paticka
$tplHeaders->getHTMLFooter();

?>