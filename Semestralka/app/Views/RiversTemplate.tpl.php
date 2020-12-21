<?php
///////////////////////////////////////////////////////////////////////////
/////////////// Sablona pro zobrazeni stranky s rekami   //////////////////
///////////////////////////////////////////////////////////////////////////


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

$res = "<h2 class='text-center'>Naše databáze obsahuje následující řeky:</h2><br><div class='container'>";

foreach($tplData['rivers'] as $r){
    $res .= "<h3><a href='index.php?page=recenzeRek/".$r['id_REKA']."'>$r[nazev]</a></h3>"
        ."<p>Délka řeky: $r[delka] Km</p>"
        ."<p>Počet jezů na řece: $r[pocet_jezu]</p><hr>";
}

$res .= "</div>";

echo $res;


// paticka
$tplHeaders->getHTMLFooter();

?>