<?php
/**
 * Praktikum DBWT. Autoren:
 * Ahmed, Jumaa
 * Mohammed, Hammado
 */

const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_SHOW_DESCRIPTION = 'show_description';
const GET_PARAM_SPRACHE = 'sprache';
const GET_PARAM_SORT = 'sort';

/**
 * List of all allergens.
 */
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch'
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42             // Number of available meals
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (strpos(strtolower($rating['text']), strtolower($searchTerm)) !== false) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}


function calcMeanStars($ratings) {
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return $sum;
}

$sprache = [
    "meal" => [
        "de" => "Gericht",
        "en" => "Meal"
    ],
    "allergens" => [
        "de" => "Allergene",
        "en" => "Allergens"
    ],
    "bewertung" => [
        "de" => "Bewertungen",
        "en" => "Ratings"
    ],
    "insgesamt" => [
        "de" => "Insgesamt",
        "en" => "Overall"
    ],
    "filter" => [
        "de" => "Filter",
        "en" => "Filter"
    ],
    "beschreibung" => [
        "de" => "Beschreibung",
        "en" => "Description"
    ],
    "sprache" => [
        "de" => "Sprache",
        "en" => "Language"
    ],
    "deutsch" => [
        "de" => "Deutsch",
        "en" => "German"
    ],
    "english" => [
        "de" => "Englisch",
        "en" => "English"
    ],
    "autor" => [
        "de" => "Autor",
        "en" => "Author"
    ],
    "text" => [
        "de" => "Text",
        "en" => "Text"
    ],
    "sterne" => [
        "de" => "Sterne",
        "en" => "Stars"
    ],
    "einblenden" => [
        "de" => "Beschreibung einblenden",
        "en" => "Show Description"
    ],
    "ausblenden" => [
        "de" => "Beschreibung ausblenden",
        "en" => "Hide Description"
    ],
    "suche" => [
        "de" => "Suchen",
        "en" => "Search"
    ],
    "preis" => [
        "de" => "Preis: ",
        "en" => "Price: "
    ],

    "sort" => [
        "de" => "Sort",
        "en" => "Sort"
    ],
    "sort_alle" => [
        "de" => "Alle",
        "en" => "All"
    ],
    "sort_top" => [
        "de" => "Top",
        "en" => "Top"
    ],
    "sort_flopp" => [
        "de" => "Flopp",
        "en" => "Flopp"
    ],
]

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title>Gericht: <?php echo $meal['name']; ?></title>
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
        <h1><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["meal"][$_GET[GET_PARAM_SPRACHE]] : $sprache["meal"]["de"]; ?>: <?php echo $meal['name']; ?></h1>
        <p><?php echo (isset($_GET[GET_PARAM_SHOW_DESCRIPTION]) && $_GET[GET_PARAM_SHOW_DESCRIPTION] == 1 || !isset($_GET[GET_PARAM_SHOW_DESCRIPTION])) ? $meal['description'] : '' ?></p>
        <p><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["preis"][$_GET[GET_PARAM_SPRACHE]] : $sprache["preis"]["de"]; echo number_format($meal["price_extern"], 2) ?>€</p>
        <p><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["allergens"][$_GET[GET_PARAM_SPRACHE]] : $sprache["allergens"]["de"]; ?>:</p>
        <ul>
        <?php
        foreach ($meal['allergens'] as $allergen) {
            echo "<li>" . $allergens[$allergen] . "</li>";
        }?></ul>
        <h1><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["bewertung"][$_GET[GET_PARAM_SPRACHE]] : $sprache["bewertung"]["de"]; ?> (<?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["insgesamt"][$_GET[GET_PARAM_SPRACHE]] : $sprache["insgesamt"]["de"]; ?>: <?php echo calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <label for="search_text"><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["filter"][$_GET[GET_PARAM_SPRACHE]] : $sprache["filter"]["de"]; ?>:</label>
            <input id="search_text" type="text" name="search_text" value="<?php echo !empty($_GET[GET_PARAM_SEARCH_TEXT]) ? $_GET[GET_PARAM_SEARCH_TEXT] : null; ?>">

            <label for="show_description"><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["beschreibung"][$_GET[GET_PARAM_SPRACHE]] : $sprache["beschreibung"]["de"]; ?>:</label>
            <select name="show_description" id="show_description">
                <option value="1" <?php echo isset($_GET[GET_PARAM_SHOW_DESCRIPTION]) && $_GET[GET_PARAM_SHOW_DESCRIPTION] === '1' ? 'selected' : ''; ?> ><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["einblenden"][$_GET[GET_PARAM_SPRACHE]] : $sprache["einblenden"]["de"]; ?></option>
                <option value="0" <?php echo isset($_GET[GET_PARAM_SHOW_DESCRIPTION]) && $_GET[GET_PARAM_SHOW_DESCRIPTION] === '0' ? 'selected' : ''; ?>><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["ausblenden"][$_GET[GET_PARAM_SPRACHE]] : $sprache["ausblenden"]["de"]; ?></option>
            </select>

            <label for="sprache"><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["sprache"][$_GET[GET_PARAM_SPRACHE]] : $sprache["sprache"]["de"]; ?>:</label>
            <select name="sprache" id="sprache">
                <option value="de" <?php echo isset($_GET[GET_PARAM_SPRACHE]) && $_GET[GET_PARAM_SPRACHE] === 'de' ? 'selected' : ''; ?> ><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["deutsch"][$_GET[GET_PARAM_SPRACHE]] : $sprache["deutsch"]["de"]; ?></option>
                <option value="en" <?php echo isset($_GET[GET_PARAM_SPRACHE]) && $_GET[GET_PARAM_SPRACHE] === 'en' ? 'selected' : ''; ?>><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["english"][$_GET[GET_PARAM_SPRACHE]] : $sprache["english"]["de"]; ?></option>
            </select>

            <label for="sort"><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["sort"][$_GET[GET_PARAM_SPRACHE]] : $sprache["sort"]["de"]; ?>:</label>
            <select name="sort" id="sort">
                <option value="alle" <?php echo isset($_GET[GET_PARAM_SORT]) && $_GET[GET_PARAM_SORT] === 'alle' ? 'selected' : ''; ?> ><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["sort_alle"][$_GET[GET_PARAM_SPRACHE]] : $sprache["sort_alle"]["de"]; ?></option>
                <option value="top" <?php echo isset($_GET[GET_PARAM_SORT]) && $_GET[GET_PARAM_SORT] === 'top' ? 'selected' : ''; ?> ><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["sort_top"][$_GET[GET_PARAM_SPRACHE]] : $sprache["sort_top"]["de"]; ?></option>
                <option value="flopp" <?php echo isset($_GET[GET_PARAM_SORT]) && $_GET[GET_PARAM_SORT] === 'flopp' ? 'selected' : ''; ?>><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["sort_flopp"][$_GET[GET_PARAM_SPRACHE]] : $sprache["sort_flopp"]["de"]; ?></option>
            </select>

            <input type="submit" value="<?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["suche"][$_GET[GET_PARAM_SPRACHE]] : $sprache["suche"]["de"]; ?>">
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["autor"][$_GET[GET_PARAM_SPRACHE]] : $sprache["autor"]["de"]; ?></td>
                <td><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["text"][$_GET[GET_PARAM_SPRACHE]] : $sprache["text"]["de"]; ?></td>
                <td><?php echo isset($_GET[GET_PARAM_SPRACHE]) ? $sprache["sterne"][$_GET[GET_PARAM_SPRACHE]] : $sprache["sterne"]["de"]; ?></td>
            </tr>
            </thead>
            <tbody>
            <?php

            $isTop = isset($_GET[GET_PARAM_SORT]) && $_GET[GET_PARAM_SORT] === "top";
            $maxValue = -1;
            $init_set = false;
            foreach ($showRatings as $rating) {
                if(!$init_set) {
                    $init_set = true;
                    $maxValue = $rating["stars"];
                } else {
                    if($isTop && $rating["stars"] > $maxValue) {
                        $maxValue = $rating["stars"];
                    } else if(!$isTop && $rating["stars"] < $maxValue) {
                        $maxValue = $rating["stars"];
                    }
                }
            }

            foreach ($showRatings as $rating) {
                if(!isset($_GET[GET_PARAM_SORT]))
                {
                    echo "<tr><td class='rating_autor'>{$rating['author']}</td><td class='rating_text'>{$rating['text']}</td>
                          <td class='rating_stars'>{$rating['stars']}</td>
                      </tr>";
                }
                else if(isset($_GET[GET_PARAM_SORT]) && $_GET[GET_PARAM_SORT] === "alle" )
                {
                    echo "<tr><td class='rating_autor'>{$rating['author']}</td><td class='rating_text'>{$rating['text']}</td>
                          <td class='rating_stars'>{$rating['stars']}</td>
                      </tr>";
                }
                else
                {
                    if($rating["stars"] == $maxValue) {
                        echo "<tr><td class='rating_autor'>{$rating['author']}</td><td class='rating_text'>{$rating['text']}</td>
                          <td class='rating_stars'>{$rating['stars']}</td>
                      </tr>";
                    }
                }
            }
        ?>
            </tbody>
        </table>
    </body>
</html>