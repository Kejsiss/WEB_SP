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

$message = "<div class='container'><i class='fas fa-fire' style='font-size: 36px; color:#FC7307'></i>
        &nbsp;Měli jste někdy chuť vyrazit na vodu a chtěli jste si nejdříve zjistit všechny informace, aby Vás pak nic nepřekvapilo?
        Naše web obsahuje recenze řek a tábořisť, hodnocených uživateli a vodáky přesně jako jste Vy!
        Jakto vlastně všechno funguje? Pojďme se na to podívat, je to jednodušší než si myslíte!<hr>
    </div><br>";

$message .= "<div class='container'><i class='fas fa-map' style='font-size: 36px; color:#FC7307'></i>
        &nbsp;V záložkách řeky a tábořiště na Vás čekají seznamy řek a tábořišt, které obsahuje naše databáze.
        Kliknutím na vybranou řeku či tábořistě se Vám zobrazí recenze k dané řece nebo tábořišti od přihlášených uživatelů.<hr>
    </div><br>";

$message .= "<div class='container'><i class='fas fa-route' style='font-size: 36px; color:#FC7307'></i>
        &nbsp;Pokud se chceš sám podělit o své zkušenosti s nehostinou řekou či vybaveným kempem je třeba se zaregistrovat.
        Recenze můžeš psát pouze jako přihlášený uživatel! Registrovat se můžeš v záložce registrovat.<hr>
    </div><br>";

echo $message;
// paticka
$tplHeaders->getHTMLFooter();

?>