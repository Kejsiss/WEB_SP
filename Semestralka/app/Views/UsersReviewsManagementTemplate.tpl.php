<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky se spravou uzivatelu  ///////////
///////////////////////////////////////////////////////////////////////////

//// pozn.: sablona je samostatna a provadi primy vypis do vystupu:
// -> lze testovat bez zbytku aplikace.
// -> pri vyuziti Twigu se sablona obejde bez PHP.

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

$res = "<h2 class='text-center'>Vyber uživatele u kterého chceš spravovat recenze:</h2><br><div class='container'>";

foreach($tplData['users'] as $u){
    $res .= "<h3><a href='index.php?page=recenzeUzivatel/".$u['id_UZIVATEL']."'>$u[username]</a></h3><hr>";
}

$res .= "</div>";

echo $res;


// paticka
$tplHeaders->getHTMLFooter();

?>