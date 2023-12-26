<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geburtsstatistiken</title>
</head>
<body>
    <?php 
    require_once("inc/names.php");

    // Asoziatives Array
    $firstLetters = [];

    foreach($names AS $nameArray){
        $nameFirstLetter = $nameArray['name'][0];

        // Ist der Buchstabe vorhanden? 
        if(empty($firstLetters[$nameFirstLetter])){
            // Setze den wert auf true = JA 
            $firstLetters[$nameFirstLetter] = true;
        }
    }
    var_dump($firstLetters);
    ?>

    <p>
        <?php foreach($firstLetters AS $firstLetter => $bool): ?>
        <a href="index.php?car=<?php echo $firstLetter ?>"><?php echo $firstLetter ?></a>
        <?php endforeach; ?>
    </p>
</body>
</html>