<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky se spravou uzivatelu  ///////////
///////////////////////////////////////////////////////////////////////////

//// vypis sablony
// urceni globalnich promennych, se kterymi sablona pracuje
global $tplData;

// pripojim objekt pro vypis hlavicky a paticky HTML
require(DIRECTORY_VIEWS ."/ZAKLADHTML.class.php");
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

// mam vypsat hlasku?
if(isset($tplData['delete'])){
    echo "<div class='alert alert-info'>$tplData[delete]</div>";
}

if($tplData['isUserLogged']) {
        //SEKCE PRO PRIHLASENE UZIVATELE

    $res = "<h3 class='text-center'>Správa uživatelů</h3><hr class='container'><table class='center' border='2'><tr><th>ID</th><th>Login</th><th>Jméno</th><th>Příjmení</th><th>E-mail</th><th>Právo</th><th>Akce</th></tr>";
        // projdu data a vypisu radky tabulky
    foreach($tplData['users'] as $u){
        $res .= "<tr><td>$u[id_UZIVATEL]</td><td>$u[username]</td><td>$u[jmeno]</td><td>$u[prijmeni]</td><td>$u[email]</td><td>$u[id_pravo]</td>"
            ."<td><form method='post'>"
            ."<input type='hidden' name='id_user' value='$u[id_UZIVATEL]'>"
            ."<button type='submit' name='action' value='delete' style='background-color: #236AB9; color: #D4E4F7'>Smazat</button>"
            ."</form></td></tr>";
    }

    $res .= "</table><br>";
    echo $res;

}
else {
    echo "<h1 class='text-center'>Tato sekce je pouze pro přihlášené uživatele</h1>";
}



// paticka
$tplHeaders->getHTMLFooter()

?>
