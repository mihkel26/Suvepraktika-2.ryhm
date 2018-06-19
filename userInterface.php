<?php 
	$userNeeds = "";
	$packetType = "";
	$timeInput = null;
	$tempInput = null;
	$hourInput = null;
	$minuteInput = null;
	$hourToTxtFile = "";
	$deviceState = "";
	
	$packetTypeError = "";
	$timeInputError = "";
	$tempInputError = "";
	$notice = "";
	
	//kas vajutati sumbit nuppu
	if(isset($_POST["submitButton"])){
		
		if (isset($_POST["packetType"])){
			if (empty($_POST["packetType"])){
				$packetTypeError = "NB, Vali enda elektrituru plaan!";
			}else{
				$packetType = $_POST["packetType"];
				//echo $packetType;
		
			}
			
		}
		//echo "submit,";
		
		//kasutaja arvamuse omistamine
		if (isset($_POST["hourSelect"])){
			if(empty($_POST["hourSelect"])){
				$notice = "Nb";
			}else{
				$hourSelect = $_POST["hourSelect"];
				//echo $hourSelect;
			}
			
		}
		//echo $_POST["hourSelect"];
		
		
		if (isset($_POST["minuteSelect"])){
			if(empty($_POST["minuteSelect"])){
				$notice = "Nb2";
			}else{
				$minuteSelect = $_POST["minuteSelect"];
				//echo $minuteSelect;
			}
		}
		
		if(isset($_POST["tempSelect"])){
			if(empty($_POST["tempSelect"])){
				$notice = "Nb, vaja on temperatuuri";
			}else{
				$tempInput = $_POST["tempSelect"];
			}
		}
		//echo $_POST["tempSelect"];
		
		
		if (isset ($_POST["hourSelect"]) and isset ($_POST["minuteSelect"])){
			if (($_POST["hourSelect"]) < 10) {
				$hourToTxtFile = "0".($_POST["hourSelect"]);
			} else {
				$hourToTxtFile = $_POST["hourSelect"];
			}
			if (($_POST["minuteSelect"]) == 0) {
				$minuteToTxtFile = "00";
			} else {
				$minuteToTxtFile = $_POST["minuteSelect"];
			}
			$timeInput = $hourToTxtFile ."." .$minuteToTxtFile;
		} else {
			$timeInputError = "Chosen time is not valid!";
		}
		//echo $timeInput;
		
		if(!empty($packetTypeError) and !empty($timeInputError) and !empty($tempInputError)){
			echo "All Values have to be chosen";
		} else {
			$myFile = fopen("userNeeds.txt", "w") or die ("Ei saa avada(file peab olema 'w' õigusega");
			fwrite($myFile, "packet,".$packetType."\n"."time,".$timeInput."\n"."temp,".$tempInput."\n");
			fclose($myFile);
			
		}
		
	//hourSelectHTML
	//minuteSelectHTML
	}
	
	$hourSelectHTML = "";
	$hourSelectHTML .= '<select name="hourSelect">' ."\n";
	$hourSelectHTML .= '<option value="" selected disabled>hour</option>' ."\n";
	for ($i = 1; $i < 25; $i ++){
		if($i == $hourInput){
			$hourSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$hourSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
		}
		
	}
	$hourSelectHTML.= "</select> \n";
	
	$minuteSelectHTML = "";
	$minuteSelectHTML .= '<select name="minuteSelect">' ."\n";
	$minuteSelectHTML .= '<option value="" selected disabled>minute</option>' ."\n";
	for ($i = 0; $i < 60; $i += 15){
		if($i == $minuteInput){
			$minuteSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$minuteSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
		}
		
	}
	$minuteSelectHTML.= "</select> \n";
	
	$tempSelectHTML = "";
	$tempSelectHTML .= '<select name="tempSelect">' ."\n";
	$tempSelectHTML .= '<option value="" selected disabled>temp</option>' ."\n";
	for ($i = 20; $i < 33; $i ++){
		if($i == $tempInput){
			$tempSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$tempSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
		}
		
	}
	$tempSelectHTML.= "</select> \n";

	//led
	$deviceFile = fopen("devicestate.txt", "r") or die ("Ei saa avada");
	$deviceState = fread($deviceFile, filesize("devicestate.txt");
	fclose($deviceFile);

?>

<!DOCTYPE html>
<head>
	<title> User input </title>
	<meta charset="UTF-8">
</head>

<style>
</style>

<body>
	<div id="write" style="text-align:center">
	<h1> Sisesta oma soovid </h1>
		<form method="POST">
			<label>Vali elektripakett </label>
				<select name="packetType">
					<option value="Tühi">---</option>
					<option value="1">konstantne</option>
					<option value="2">ainult börsihind</option>
					<option value="3">ainult võrgutasudest</option>
					<option value="4">elektri börsihinnast ning võrgutasudest</option>
				</select>
			<br><br>
			<input type="radio" name="heatDevice" value="heat" /> Lülita seade see kell sisse
			<br>
			<input type="radio" name="preheatDevice" value="preheat" /> Soojenda seade selleks kellaks soovitud temperatuurini
			<br>
			<label>Sisesta soovitud kell</label>
			<?php
				echo $hourSelectHTML ."\n" . $minuteSelectHTML;
			?>
			<br><br>
			<label>Vali temperatuur, milleni tahad kütta </label>
			<?php
				echo $tempSelectHTML;
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
				    echo $deviceState
				?>
		</div>
		
	
</body>
</html>
