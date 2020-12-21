<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky s kempy  ////////////////////////
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

$res = "<h2 class='text-center'>Naše databáze obsahuje následující tábořiště:</h2><br><div class='container'>";

foreach($tplData['camps'] as $c){
    $res .= "<h3><a href='index.php?page=recenzeKempu/".$c['id_TABORISTE']."'>$c[nazev]</a></h3>"
        ."<p class='font-weight-bold'>Řeka: $c[reka]</p>"
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