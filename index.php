<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geburtsstatistiken</title>
    <link rel="stylesheet" type="text/css" href="./styles/simple.css">
    <link rel="stylesheet" type="text/css" href="./styles/custom.css">
</head>
<body>
    <header>
        <h1>Geburtsstatistiken</h1>
        <p>Hier sind die Namen aus den Geburtsstatistiken der USA aufgelistet.</p>
        <p>Die Top: 1000, von Jahr 1980 bis zum Jahr 2014.</p>
    </header>

    <?php 
    // Datei nur einmal laden
    require_once("inc/names.php");

    //Neues Asoziatives Array
    $firstLetters = [];

    // Datei einträge filtern
    foreach($names AS $nameArray){
        // Den ersten Buchstaben abgreifen
        $nameFirstLetter = $nameArray['name'][0];

        // Ist der Buchstabe vorhanden? 
        if(empty($firstLetters[$nameFirstLetter])){
            // Setze den Wert auf true. 
            $firstLetters[$nameFirstLetter] = true;
        }
    }
    var_dump($firstLetters);
    ?>

    <nav class="nav">
        <?php foreach($firstLetters AS $firstLetter => $bool): ?>
            <a 
                href="index.php?char=<?php echo $firstLetter ?>"
                <?php if(!empty($_GET['char']) && $_GET['char'] === $firstLetter): ?>
                    class="selected"
                <?php endif; ?>
            ><?php echo $firstLetter ?></a>
        <?php endforeach; ?>
    </nav>

</body>
</html>