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
    require_once("./inc/functions.php");

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
    ?>

    <nav class="nav">
        <?php foreach($firstLetters AS $firstLetter => $_): ?>
            <a 
                href="index.php?char=<?php echo $firstLetter ?>"
                <?php if(!empty($_GET['char']) && $_GET['char'] === $firstLetter): ?>
                    class="selected"
                <?php endif; ?>
            ><?php echo $firstLetter ?></a>
        <?php endforeach; ?>
    </nav>

    <?php if(!empty($_GET['char']) && is_string($_GET['char'])): ?>
        <hr>
        <?php 
        //logik
            $char = $_GET['char'][0];
            $filteredNames = [];

            foreach($names AS $nameArray){
                // Name dem Array hinzufügen
                $currentName = $nameArray['name'];
                // Ist der erste Buchstabe vom namen nicht der, der per url übergeben wurde.
                if($currentName[0] !== $char){
                    //*überspringe den durchlauf
                    continue;
                }
                // Name ist nicht leer, wert setzen.
                if(empty($filteredNames[$currentName])){
                    $filteredNames[$currentName] = true;
                }              
            }
        ?>
        <!-- IMMER ALLE Daten aus der URL escapen mit der funktion e um Sicherheitslücken zu schließen -->
        <h3>Namen, die mit <?php echo e($char) ?> beginnen:</h3>
        <ul>
            <!-- alle namen per schleife rendern -->
            <?php foreach($filteredNames AS $currentName => $_): ?>
            <li>
                <!-- http_build_query um fehler mit sonderzeihen zu vermeiden z.B. (ß ä ö ü é) -->
                <a href="./index.php?name=<?php echo http_build_query(['name' => $currentName]); ?>">
                    <?php echo e($currentName); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</body>
</html>