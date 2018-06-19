<?php
$userNeeds = "";
$packetType = "";
$timeInput = null;
$tempInput = null;
$hourInput = null;
$minuteInput = null;
$endHourInput = null;
$endMinuteInput = null;
$hourToTxtFile = "";
$endHourToTxtFile = "";
$deviceState = "";


//radio
$heatDevice = "";
$preheatDevice = "";

$signupBirthDayError = "";
$packetTypeError = "";
$timeInputError = "";
$tempInputError = "";
$notice = "";

//kas vajutati sumbit nuppu
if (isset($_POST["submitButton"])) {


    //kasutaja arvamuse omistamine
    if (isset($_POST["hourSelect"])) {
        if (empty($_POST["hourSelect"])) {
            $notice = "Nb";
        } else {
            $hourSelect = $_POST["hourSelect"];
            //echo $hourSelect;
        }

    }
    //echo $_POST["hourSelect"];


    if (isset($_POST["minuteSelect"])) {
        if (empty($_POST["minuteSelect"])) {
            $notice = "Nb2";
        } else {
            $minuteSelect = $_POST["minuteSelect"];
            //echo $minuteSelect;
        }
    }

    if (isset($_POST["endHourSelect"])) {
        if (empty($_POST["endHourSelect"])) {
            $notice = "Nb";
        } else {
            $endHourSelect = $_POST["endHourSelect"];
            //echo $hourSelect;
        }

    }
    //echo $_POST["hourSelect"];


    if (isset($_POST["EndMinuteSelect"])) {
        if (empty($_POST["endMinuteSelect"])) {
            $notice = "Nb2";
        } else {
            $endMinuteSelect = $_POST["endMinuteSelect"];
            //echo $minuteSelect;
        }
    }
    //echo $_POST["tempSelect"];


    if (isset ($_POST["hourSelect"]) and isset ($_POST["minuteSelect"])) {
        if (($_POST["hourSelect"]) < 10) {
            $hourToTxtFile = "0" . ($_POST["hourSelect"]);
        } else {
            $hourToTxtFile = $_POST["hourSelect"];
        }
        if (($_POST["minuteSelect"]) == 0) {
            $minuteToTxtFile = "00";
        } else {
            $minuteToTxtFile = $_POST["minuteSelect"];
        }
        $timeInput = $hourToTxtFile . "." . $minuteToTxtFile;
    } else {
        $timeInputError = "Chosen time is not valid!";
    }

    if (isset ($_POST["endHourSelect"]) and isset ($_POST["endMinuteSelect"])) {
        if (($_POST["endHourSelect"]) < 10) {
            $endHourToTxtFile = "0" . ($_POST["endHourSelect"]);
        } else {
            $endHourToTxtFile = $_POST["endHourSelect"];
        }
        if (($_POST["endMinuteSelect"]) == 0) {
            $endMinuteToTxtFile = "00";
        } else {
            $endMinuteToTxtFile = $_POST["endMinuteSelect"];
        }
        $endTimeInput = $endHourToTxtFile . "." . $endMinuteToTxtFile;
    } else {
        $endTimeInputError = "Chosen time is not valid!";
    }
    //echo $timeInput;

    if (!empty($timeInputError) and !empty($endTimeInputError)) {
        echo "All Values have to be chosen";
    } else {
        $myFile = fopen("userNeeds.txt", "w") or die ("Ei saa avada(file peab olema 'w' õigusega");
        fwrite($myFile, "2\n" . $timeInput . "\n\n\n" . $endTimeInput . "\n\n");
        fclose($myFile);
        echo "Korras";

    }


}

$hourSelectHTML = "";
$hourSelectHTML .= '<select name="hourSelect">' . "\n";
$hourSelectHTML .= '<option value="" selected disabled>hour</option>' . "\n";
for ($i = 1; $i < 25; $i++) {
    if ($i == $hourInput) {
        $hourSelectHTML .= '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
    } else {
        $hourSelectHTML .= '<option value="' . $i . '">' . $i . '</option>' . " \n";
    }

}
$hourSelectHTML .= "</select> \n";

$minuteSelectHTML = "";
$minuteSelectHTML .= '<select name="minuteSelect">' . "\n";
$minuteSelectHTML .= '<option value="" selected disabled>minute</option>' . "\n";
for ($i = 0; $i < 60; $i += 15) {
    if ($i == $minuteInput) {
        $minuteSelectHTML .= '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
    } else {
        $minuteSelectHTML .= '<option value="' . $i . '">' . $i . '</option>' . " \n";
    }

}
$minuteSelectHTML .= "</select> \n";


$endHourSelectHTML = "";
$endHourSelectHTML .= '<select name="endHourSelect">' . "\n";
$endHourSelectHTML .= '<option value="" selected disabled>hour</option>' . "\n";
for ($i = 1; $i < 25; $i++) {
    if ($i == $endHourInput) {
        $endHourSelectHTML .= '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
    } else {
        $endHourSelectHTML .= '<option value="' . $i . '">' . $i . '</option>' . " \n";
    }

}
$endHourSelectHTML .= "</select> \n";

$endMinuteSelectHTML = "";
$endMinuteSelectHTML .= '<select name="endMinuteSelect">' . "\n";
$endMinuteSelectHTML .= '<option value="" selected disabled>minute</option>' . "\n";
for ($i = 0; $i < 60; $i += 15) {
    if ($i == $endMinuteInput) {
        $endMinuteSelectHTML .= '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
    } else {
        $endMinuteSelectHTML .= '<option value="' . $i . '">' . $i . '</option>' . " \n";
    }

}
$endMinuteSelectHTML .= "</select> \n";


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
        <label>Sisesta algusaeg</label>
        <?php
        echo $hourSelectHTML . "\n" . $minuteSelectHTML;
        ?>
        <br><br>
        <label>Sisesta lõpuaeg</label>
        <?php
        echo $endHourSelectHTML . "\n" . $endMinuteSelectHTML;
        ?>
        <br><br>


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
