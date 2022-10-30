<?php

/**
 * Praktikum DBWT. Autoren:
 * Ahmed, Jumaa
 * Mohammed, Hammado
 */

include_once "gerichte.php";

if(isset($_POST["submit"])) {

    $fehlerfrei = true;
    if(!isset($_POST["name"])) {
        echo '<script>';
        echo 'alert("Der Name fehlt noch!")';
        echo '</script>';
        $fehlerfrei = false;
    }

    if(!isset($_POST["email"])) {
        echo '<script>';
        echo 'alert("Die E-Mail fehlt noch!")';
        echo '</script>';
        $fehlerfrei = false;
    }

    if(!isset($_POST["sprache"])) {
        echo '<script>';
        echo 'alert("Die Sprache muss ausgewählt sein!")';
        echo '</script>';
        $fehlerfrei = false;
    }

    if(!isset($_POST["daten"]) || $_POST["daten"] != "Datenschutzhinweis gelesen") {
        echo '<script>';
        echo 'alert("Bitte stimmen Sie die Datenschutzbestimmung zu!")';
        echo '</script>';
        $fehlerfrei = false;
    }

    if($fehlerfrei) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $lang = $_POST["sprache"];
        $rules = $_POST["daten"];

        if($name == "" || preg_match("/[^a-zA-Zäüöß]+/", $name) === 1) {
            echo '<script>';
            echo 'alert("Der Name darf nur aus Buchstaben bestehen!")';
            echo '</script>';
        } else if (str_contains($email, 'rcpt.at') || str_contains($email, 'damnthespam.at') || str_contains($email, 'wegwerfmail.de') || str_contains($email, 'trashmail.')) {
            echo '<script>';
            echo 'alert("Die E-Mail ist nicht erlaubt!")';
            echo '</script>';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo '<script>';
            echo 'alert("Die E-Mail ist nicht korrekt formatiert!")';
            echo '</script>';
        } else {

            $fp = fopen('anmeldung.txt', 'a');

            $txt = $name . ";" . $email . ";" . $lang . ";" . $rules;
            $txt = $txt . "\n";

            fwrite($fp, $txt);
            fclose($fp);

            echo '<script>';
            echo 'alert("Sie haben sich erfolgreich zum Newsletter angemeldet")';
            echo '</script>';
        }

        echo $rules;
    }
}



?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<header>
    <div id="head">
        <div><img id="logo" src="logo.png" alt="E-Mensa Logo"></div>
        <div id="menu">
            <ul>
                <li><a href="#ank">Ankündigung</a></li>
                <li><a href="#speisen">Speisen</a></li>
                <li><a href="#zahlen">Zahlen</a></li>
                <li><a href="#kontakt">Kontakt</a></li>
                <li><a href="#wichtig">Wichtig für Uns</a></li>
            </ul>
        </div>
    </div>
    <hr>
</header>

<div id="main">
    <div></div>
    <div id="main2">
        <div></div>
        <h2 id="ank">Bald gibt es Essen auch online ;)</h2>
        <div id="essen"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias culpa debitis dolores ea
                eaque
                est et eveniet ex excepturi expedita harum incidunt iusto nemo neque, nobis obcaecati officiis quas,
                quasi
                quidem saepe sunt tempore totam vero? Ad assumenda atque commodi consequuntur corporis dicta eius
                eligendi est
                excepturi fugiat, illo iure modi natus nemo odio praesentium quia repellat sunt unde voluptate. Amet
                commodi
                enim eos error fuga harum itaque iure libero, maxime minus natus nobis, possimus quae quaerat reiciendis
                reprehenderit soluta tempore vero. Ad asperiores dolor dolore iure labore minus molestiae nemo nihil
                quidem quod
                recusandae rem repellat rerum sequi, vero?</p></div>


        <h2 id="speisen">Köstlichkeiten, die Sie erwarten</h2>
        <table class="karte">
            <thead>
            <tr>
                <th></th>
                <th>Preis intern</th>
                <th>Preis extern</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($gerichte as $gericht) {
                echo "<tr>";
                echo "<td style='text-align: left;'>" . $gericht["name"] . "</td>";
                echo "<td>" . $gericht["preis_intern"] . "</td>";
                echo "<td>" . $gericht["preis_extern"] . "</td>";
                echo "<td><img src='img/" . $gericht["foto"] ."' alt='Bild vom Gericht' width='150' height='100'></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>


        <h2>E-Mensa in Zahlen</h2>
        <div id="zahlen">
            <div>x Besuche</div>
            <div>y Anmeldungen zum
                <div>Newsletter</div>
            </div>
            <div>z Speisen</div>
        </div>


        <h2 id="kontakt">Interesse geweckt? Wir informieren Sie!</h2>

        <form method="post" id="eingaben">
            <table id="news">
                <thead>
                <tr>
                    <th><label for="name">Ihr Name:</label></th>
                    <th><label for="email">Ihre E-Mail:</label></th>
                    <th><label for="sprache">Newsletter bitte in:</label></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input required id="name" name="name" type="text" placeholder="Vorname"></td>
                    <td><input required id="email" name="email" type="email"></td>
                    <td>
                        <select class="select" id="sprache" name="sprache">
                            <option value="deutsch">Deutsch</option>
                            <option value="englisch">English</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
            <input required type="checkbox" name="daten" id="daten" value="Datenschutzhinweis gelesen"><label
                    for="daten">Den Datenschutzbestimmungen stimme ich zu</label>
            <button id="submit" type="submit" name="submit">Zum Newsletter anmelden</button>
        </form>


        <h2>Das ist uns Wichtig</h2>
        <div>
            <ul id="wichtig">
                <li>Beste frische saisonale Zutaten</li>
                <li>Ausgewogene abwechslungsreichen Gerichte</li>
                <li>Sauberkeit</li>
            </ul>
        </div>


        <h1 id="bye">Wir freuen uns auf ihren Besuch</h1>
    </div>
</div>

<footer>
    <hr>
    <ul>
        <li>(c) E-Mensa GmbH</li>
        <li>Ahmed Jumaa &amp; Mohammed Hammado</li>
        <li id="imp"><a href="#imp">Impressum</a></li>
    </ul>
</footer>
</body>
</html>