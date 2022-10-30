<?php
/**
 * Praktikum DBWT. Autoren:
 * Ahmed, Jumaa
 * Mohammed, Hammado
 */

if(!isset($_GET["search"]))
{
    echo "Bitte ein Suchwort eingeben";
    return;
}

$search = $_GET["search"];

$file = fopen("en.txt", "r");
if ($file)
{
    $de = null;
    while (($line = trim(fgets($file))) !== false)
    {
        $words = explode(";", $line);
        if (strcmp($words[0], $search) === 0)
        {
            $de = $words[1];
            break;
        }
        else if (strcmp($words[1], $search) === 0)
        {
            $de = $words[0];
            break;
        }
    }
    fclose($file);

    if(empty($de))
    {
        echo "Das gesuchte Wort $search ist nicht enthalten";
    }
    else
    {
        echo $de;
    }

}
else
{
    echo "Die Datei konnte nicht geöffnet werden";
}