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

$res = "<div class='container text-center'>";

$res .= "<form method='post'>"
            ."<button type='submit' name='action' value='vypisAll'>[Všechny]</button>"."</form>";

foreach($tplData['rivers'] as $r){
    $res .= "<form method='post'>"
        ."<input type='hidden' name='id_REKA' value='$r[id_REKA]'>"
        ."<button type='submit' name='action' value='vypis' >[$r[nazev]]</button>"."</form>";
}

$res .= "</div>";

echo $res;

/*$showData = "<div class='container'>";
foreach ($tplData['vypisAll'] as $a){
    $showData .= "<h2>$a[nazev]</h2>"
        ."<div>$a[username] alias $a[jmeno] $a[prijmeni]</div>"
        ."<p>Datum sjezdu: $a[datum_sjezdu]</p>"
        ."<div>recenze: $a[recenze_reky]</div><hr>";
}
$showData .= "</div>";
echo $showData;
*/

if(isset($tplData['vypis'])){
    $showData = "";
    $showData = "<div class='container'>";
    foreach($tplData['vypis'] as $a){
        $showData .= "<h3>$a[username] alias $a[jmeno] $a[prijmeni]</h3>"
            ."<p>Řeka: $a[nazev]</p>"
            ."<p>Datum sjezdu: $a[datum_sjezdu]</p>"
            ."<div>recenze: $a[recenze_reky]</div><hr>";

    }
    $showData .= "</div>";
    echo $showData;
}

if(isset($tplData['vypisAll'])){
    $showData = "<div class='container'>";
    foreach ($tplData['vypisAll'] as $a){
        $showData .= "<h2>$a[nazev]</h2>"
            ."<div>$a[username] alias $a[jmeno] $a[prijmeni]</div>"
            ."<p>Datum sjezdu: $a[datum_sjezdu]</p>"
            ."<div>recenze: $a[recenze_reky]</div><hr>";
    }
    $showData .= "</div>";
    echo $showData;

}


// paticka
$tplHeaders->getHTMLFooter()

?>