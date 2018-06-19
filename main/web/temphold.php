<?php
$userNeeds = "";
$minTempInput = null;
$maxTempInput = null;
$hourToTxtFile = "";
$deviceState = "";


$minTempInputError = "";
$maxTempInputError = "";
$notice = "";

//kas vajutati sumbit nuppu
if (isset($_POST["submitButton"])) {


    if (isset($_POST["minTempSelect"])) {
        if (empty($_POST["minTempSelect"])) {
            $notice = "Nb, vaja on temperatuuri";
        } else {
            $minTempInput = $_POST["minTempSelect"];
        }
    }

    if (isset($_POST["maxTempSelect"])) {
        if (empty($_POST["maxTempSelect"])) {
            $notice = "Nb, vaja on temperatuuri";
        } else {
            $maxTempInput = $_POST["maxTempSelect"];
        }
    }

    if (!empty($minTempInputError) and !empty($maxTempInputError)) {
        echo "All Values have to be chosen";
    } else {
        $myFile = fopen("userNeeds.txt", "w") or die ("Ei saa avada(file peab olema 'w' õigusega");
        fwrite($myFile, "3\n14.00\n16.06\n30\n18.00\n" . $minTempInput . "\n" . $maxTempInput);
        fclose($myFile);

    }
}


$minTempSelectHTML = "";
$minTempSelectHTML .= '<select name="minTempSelect">' . "\n";
$minTempSelectHTML .= '<option value="" selected disabled>temp</option>' . "\n";
for ($i = 3; $i < 28; $i++) {
    if ($i == $minTempInput) {
        $minTempSelectHTML .= '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
    } else {
        $minTempSelectHTML .= '<option value="' . $i . '">' . $i . '</option>' . " \n";
    }

}
$minTempSelectHTML .= "</select> \n";

$maxTempSelectHTML = "";
$maxTempSelectHTML .= '<select name="maxTempSelect">' . "\n";
$maxTempSelectHTML .= '<option value="" selected disabled>temp</option>' . "\n";
for ($i = 3; $i < 28; $i++) {
    if ($i == $maxTempInput) {
        $maxTempSelectHTML .= '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
    } else {
        $maxTempSelectHTML .= '<option value="' . $i . '">' . $i . '</option>' . " \n";
    }

}
$maxTempSelectHTML .= "</select> \n";


//led
$deviceFile = fopen("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt", "r") or die ("Ei saa avada");
$deviceState = fread($deviceFile, filesize("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt"));
fclose($deviceFile);

?>

<!DOCTYPE html>
<head>
    <title> User input </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="design/design.css">
</head>

<style>
</style>

<body>
<div id="write" style="text-align:center">
    <h1> Sisesta oma soovid </h1>
    <form method="POST">
        <label>Sisesta minimaalne temperatuur </label>
        <?php
        echo $minTempSelectHTML;
        ?>
        <br><br>

        <label> Sisesta maksimaalne temperatuur </label>
        <?php
        echo $maxTempSelectHTML;
        ?>
        <br><br>
        <input name="submitButton" type="submit" value="Sisesta">
    </form>

</div>
<br><br>
<br><br>
<div id="deviceState">
    <label> device on/off?</label>
    <?php
    echo $deviceState;
    ?>
</div>

<br><br>
<br><br>
<br><br>
<div id="footer">
    <a class="btn btn-small" href="main.php">Tagasi pealehele</a>
</div>


</body>
</html>