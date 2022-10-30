<?php
/**
 * Praktikum DBWT. Autoren:
 * Ahmed, Jumaa
 * Mohammed, Hammado
 */

$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Array</title>
    <style>
        * {
            font-family: Arial, serif;
        }

        .sub {
            margin-top: 0 !important;
        }
    </style>
</head>


<body>

<ol>
    <?php

    foreach($famousMeals as $meal) {
        $values = "";

        $i = 0;

        if(gettype($meal["winner"]) === 'array') {
            // von vorne nach hinten
            // aber vorne am Ende schreiben
            foreach($meal["winner"] as $winner) {
                $values = $winner . ($i === 0 ? "" : ", ") . $values;
                $i++;
            }
        } else {
            $values = $meal["winner"];
        }


        $description = "<br><p class='sub'>$values</p>";
        echo "<li> " .  $meal["name"] . $description . " </li>";
    }

    ?>

</ol>

<p><b>Jahre, die fehlen</b></p>

<ol>

    <?php

    $jahren = [2000, 2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022];
    foreach($famousMeals as $meal) {
        $missing_years = [];
        foreach($jahren as $jahr) {
            $hasYear = false;
            if(gettype($meal["winner"]) === 'array') {
                foreach($meal["winner"] as $winner) {
                    if($winner == $jahr) {
                        $hasYear = true;
                        break;
                    }
                }
            } else {
                if($meal["winner"] == $jahr) {
                    $hasYear = true;
                    break;
                }
            }

            if(!$hasYear) {
                array_push($missing_years, $jahr);
            }
        }

        $description = "<br><p class='sub'>" . implode(',', $missing_years) . "</p>";
        echo "<li> " .  $meal["name"] . $description . " </li>";
    }

    ?>

</ol>


</body>
</html>
