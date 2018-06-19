<?php 
	$userNeeds = "";
	$packetType = "";
	$timeInput = null;
	$tempInput = null;
	$hourInput = null;
	$minuteInput = null;
	$hourToTxtFile = "";
	$deviceState = "";
	$signupMonthSelectHTML = "";
	$signupDaySelectHTML = "";
	$dateMonth = "";
	$dateDay = "";
	$selectedPacket = "selected";
	
	$heatDevice = "";
	$preheatDevice = "";
	
	$dateError = "";
	$packetTypeError = "";
	$timeInputError = "";
	$notice = "";
	$success = "";
	
	// Kui vajutatakse submit nuppu
	if(isset($_POST["submitButton"])) {
		if (isset($_POST["packetType"])) {
			if (empty($_POST["packetType"])) {
				$packetTypeError = "Vali elektrituru plaan!";
			} else {
				$packetType = $_POST["packetType"];
			}
		}
		
		// Kasutaja sisendid
		if (isset($_POST["hourSelect"])) {
			if (empty($_POST["hourSelect"])) {
				$notice = "Määra aeg";
			} else {
				$hourSelect = $_POST["hourSelect"];
			}
		}	
		
		if (isset($_POST["minuteSelect"])) {
			if (empty($_POST["minuteSelect"])) {
				$notice = "Määra aeg";
			} else {
				$minuteSelect = $_POST["minuteSelect"];
			}
		}
		
		if (isset($_POST["tempSelect"])) {
			if (empty($_POST["tempSelect"])) {
				$notice = "Määra temperatuur";
			} else {
				$tempInput = $_POST["tempSelect"];
			}
		}
		
		// Kuupäeva kontroll
		if (!empty($_POST["dateDay"])) {
			$dateDay = $_POST["dateDay"];
		} else {
			$dateError = "Kuupäeva pole sisestatud!";
		}
		
		if (!empty($_POST["dateMonth"])) {
			$dateMonth = intval($_POST["dateMonth"]);
		} else {
			$dateError = "Kuu pole sisestatud!";
		}
		
		if (isset($_POST["hourSelect"]) and isset($_POST["minuteSelect"])) {
			if ($_POST["hourSelect"] < 10) {
				$hourToTxtFile = "0".($_POST["hourSelect"]);
			} else {
				$hourToTxtFile = $_POST["hourSelect"];
			}
			
			if ($_POST["minuteSelect"] == 0) {
				$minuteToTxtFile = "00";
			} else {
				$minuteToTxtFile = $_POST["minuteSelect"];
			}
			
			$timeInput = $hourToTxtFile ."." .$minuteToTxtFile;
		} else {
			$timeInputError = "Määra aeg";
		}
		
		if (empty($packetTypeError) and empty($dateError) and empty($notice) and empty($timeInputError)) {
			$success = "Andmed saadetud -> põrand on kella " .$hourToTxtFile ."." .$minuteToTxtFile ." soe.";
			$myFile = fopen("userNeeds.txt", "w") or die ("Ei saa avada (fail peab olema 'w' õigusega");
			fwrite($myFile, $packetType ."\n" .$timeInput ."\n" .$tempInput ."\n" .$dateDay ."." .$dateMonth);
			fclose($myFile);
		}
	}
	
	$hourSelectHTML = "";
	$hourSelectHTML .= '<select name="hourSelect">' ."\n";
	$hourSelectHTML .= '<option value="" selected disabled>hour</option>' ."\n";
	for ($i = 0; $i < 24; $i++) {
		if ($i == $hourInput) {
			$hourSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$hourSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
		}
	}
	$hourSelectHTML.= "</select> \n";
	
	$minuteSelectHTML = "";
	$minuteSelectHTML .= '<select name="minuteSelect">' ."\n";
	$minuteSelectHTML .= '<option value="" selected disabled>minute</option>' ."\n";
	for ($i = 0; $i < 60; $i += 15) {
		if ($i == $minuteInput) {
			$minuteSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$minuteSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
		}
	}
	$minuteSelectHTML.= "</select> \n";
	
	$tempSelectHTML = "";
	$tempSelectHTML .= '<select name="tempSelect">' ."\n";
	$tempSelectHTML .= '<option value="" selected disabled>temp</option>' ."\n";
	for ($i = 20; $i < 36; $i ++) {
		if ($i == $tempInput) {
			$tempSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$tempSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
		}
	}
	$tempSelectHTML.= "</select> \n";
	
	// Kuupäeva valik
	$signupDaySelectHTML = "";
	$signupDaySelectHTML .= '<select name="dateDay">' ."\n";
	$signupDaySelectHTML .= '<option value="" selected disabled>päev</option>' ."\n";
	for ($i = 1; $i < 32; $i ++){
		if ($i == $dateDay) {
			$signupDaySelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$signupDaySelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
		}	
	}
	$signupDaySelectHTML .= "</select> \n";
	
	// Kuu valik
	$signupMonthSelectHTML = "";
	$monthNamesEt = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$signupMonthSelectHTML .= '<select name="dateMonth">' ."\n";
	$signupMonthSelectHTML .= '<option value="" selected disabled>kuu</option>' ."\n";
	foreach ($monthNamesEt as $key=>$month) {
		if ($key + 1 === $dateMonth){
			$signupMonthSelectHTML .= '<option value="' .($key + 1) .'" selected>' .$month .'</option>' ."\n";
		} else {
			$signupMonthSelectHTML .= '<option value="' .($key + 1) .'">' .$month .'</option>' ."\n";
		}
	}
	$signupMonthSelectHTML .= "</select> \n";

	// Loe fail (seadme olek, seadme temperatuur, ruumi temperatuur, börsihind)
	$deviceFile = fopen("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt", "r") or die ("Ei saa avada (fail peab olema 'w' õigusega");
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
<body>
	<div id="write" style="text-align:center">
	<h1> Sisesta oma soovid </h1>
		<form method="POST">
			<label>Vali elektripakett </label>
				<select name="packetType">
					<option></option>
					<option value="0" <?php if ($_POST["packetType"] == 0) {echo selectedPacket;}?>>konstantne</option>
					<option value="1" <?php if ($_POST["packetType"] == 1) {echo selectedPacket;}?>>ainult börsihind</option>
				</select>
			<br><br>
			
			<label>Sisesta aeg, mis ajaks tahad, et põrand oleks soe</label>
			<?php echo $hourSelectHTML ."\n" . $minuteSelectHTML; ?>
			<br><br>
			
			<label>Sisesta temperatuur, milleni tahad põranda kütta. </label>
			<?php echo $tempSelectHTML; ?>
			<br><br>
			
			<label> Kuupäev </label>
			<?php echo $signupDaySelectHTML ."\n".$signupMonthSelectHTML; ?>
			<span><?php echo $signupBirthDayError; ?></span><br>
			
			<input name="submitButton" type="submit" value="Sisesta" style="margin: 15px">
			<?php echo $success; ?>
		</form>	
	</div> 
		<div id="deviceState" style="margin: 15px">
			<label> device on/off?</label>
				<?php echo $deviceState; ?>
		</div>
		<div id="footer">
			<a class="btn btn-small" href="main.php">Pealehele</a>
		</div>
</body>
</html>
