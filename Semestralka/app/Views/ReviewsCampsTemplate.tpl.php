<?php
///////////////////////////////////////////////////////////////////////////
///// Sablona pro zobrazeni stranky s recenenzemi konkretniho kempu  //////
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


// hlavicka
$tplHeaders->getHTMLHeader($tplData['title']);


$showData = "<div class='container'>";
foreach ($tplData['vypisKempu'] as $a){
    $showData .= "<h5><i class='fas fa-user'></i> $a[username] alias $a[jmeno] $a[prijmeni]</h5><hr>"
        ."<p>Datum utáboření: $a[datum_utaboreni]</p>"
        ."<div>$a[recenze_taboriste]</div><hr style='border-top: 1px solid black;'>";
}
$showData .= "</div>";
echo $showData;



// paticka
$tplHeaders->getHTMLFooter()

?>