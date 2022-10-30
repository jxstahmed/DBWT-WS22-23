<?php
/**
 * Praktikum DBWT. Autoren:
 * Ahmed, Jumaa
 * Mohammed, Hammado
 */

include_once "m2_4a_standardparameter.php";

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Math</title>
    <style>
        * {
            font-family: Arial, serif;
        }
        .rating {
            color: darkgray;
        }
    </style>
</head>



<body>
<form method="get">
    <label for="input_a">1. Input:</label>
    <input id="input_a" type="text" name="input_a">

    <label for="input_b">1. Input:</label>
    <input id="input_b" type="text" name="input_b">

    <label for="type">Typ:</label>
    <select id="type" name="type">
        <option value="add">Addition</option>
        <option value="multi">Multiplikation</option>
    </select>

    <input type="submit" value="Abschicken">

</form>
<p>
    <?php

    $input_a = isset($_GET["input_a"]) ? $_GET['input_a'] : null;
    $input_b = isset($_GET["input_b"]) ? $_GET['input_b'] : null;

    $type = isset($_GET["type"]) ? $_GET['type'] : null;

    if(!empty($input_a) && !empty($input_b)) {
        if($type === "add") {
            echo $input_a . " + " . $input_b . " = " . addieren($input_a, $input_b);
        } else if ($type === "multi") {
            echo $input_a . " * " . $input_b . " = " . $input_a * $input_b;
        }
    }
    ?></p>
</body>
</html>