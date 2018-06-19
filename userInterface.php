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
	$signupDaySelectHTML = "abc";
	$signupBirthMonth = "";
	$signupBirthDay = "";
	
	//radio
	$heatDevice = "";
	$preheatDevice = "";
	
	$signupBirthDayError = "";
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
		
		
		if (isset($_POST["proov"])){
			if (empty($_POST["proov"])){
				$packetTypeError = "NB, Vali enda elektrituru plaan!";
			}else{
				$proov = $_POST["proov"];
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
		
		//kas sünnikuupäev on sisestatud
		if (empty($_POST["signupBirthDay"])){
			$signupBirthDay = $_POST["signupBirthDay"];
			//echo $signupBirthDay;
		} else {
			$signupBirthDayError = "Kuupäeva pole sisestatud!";
		}
		
		//kas sünnikuu on sisestatud
		if ( empty($_POST["signupBirthMonth"]) ){
			$signupBirthMonth = intval($_POST["signupBirthMonth"]);
		} else {
			$signupBirthDayError .= " Kuu pole sisestatud!";
		}
		
		
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
		
		if(!empty($packetTypeError) and !empty($timeInputError)  and !empty($signupBirthDayError)){
			echo "All Values have to be chosen";
		} else {
			$myFile = fopen("userNeeds.txt", "w") or die ("Ei saa avada(file peab olema 'w' õigusega");
			fwrite($myFile, $packetType."\n".$timeInput."\n".$tempInput."\n".$signupBirthDay.".".$signupBirthMonth);
			fclose($myFile);
			
		}
		
		//Tekitame kuupäeva valiku
		$signupDaySelectHTML = "";
		$signupDaySelectHTML .= '<select name="signupBirthDay">' ."\n";
		$signupDaySelectHTML .= '<option value="" selected disabled>päev</option>' ."\n";
		for ($i = 1; $i < 32; $i ++){
			if($i == $signupBirthDay){
				$signupDaySelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
			} else {
				$signupDaySelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
			}
			
		}
		$signupDaySelectHTML.= "</select> \n";
		
		
		
		//Tekitame kuu valiku
		
		$signupMonthSelectHTML = "";
		$monthNamesEt = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
		$signupMonthSelectHTML .= '<select name="signupBirthMonth">' ."\n";
		$signupMonthSelectHTML .= '<option value="" selected disabled>kuu</option>' ."\n";
		foreach ($monthNamesEt as $key=>$month){
			if ($key + 1 === $signupBirthMonth){
				$signupMonthSelectHTML .= '<option value="' .($key + 1) .'" selected>' .$month .'</option>' ."\n";
			} else {
			$signupMonthSelectHTML .= '<option value="' .($key + 1) .'">' .$month .'</option>' ."\n";
			}
		}
		$signupMonthSelectHTML .= "</select> \n";
			
		
		
			
	
	
	//radio
	if (isset($_POST["gender"]) && !empty($_POST["gender"])){ //kui on määratud ja pole tühi
			$gender = intval($_POST["gender"]);
		} else {
			$signupGenderError = " (Palun vali sobiv!) Määramata!";
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
	$deviceState = fread($deviceFile, filesize("devicestate.txt"));
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
			<label>Vali elektripakett </label>
				<select name="packetType">
					<option value="Tühi">---</option>
					<option value="1">konstantne</option>
					<option value="2">ainult börsihind</option>
					<option value="3">ainult võrgutasudest</option>
					<option value="4">elektri börsihinnast ning võrgutasudest</option>
				</select>
			<br><br>
			
			<label>Sisesta aeg, mis ajaks tahad, et põrand oleks soe</label>
			<?php
				echo $hourSelectHTML ."\n" . $minuteSelectHTML;
			?>
			<br><br>
			
			<label>Sisesta temperatuur, milleni tahad põranda kütta. </label>
			<?php
				echo $tempSelectHTML ;
			?>
			<br><br>
			
			<label> Vali kuupäev</label>
			<?php
			
			echo $signupDaySelectHTML ."\n".$signupMonthSelectHTML;
			?>
			<span><?php echo $signupBirthDayError; ?></span>
			
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
		<div id= "footer">
			<a  class="btn btn-small" href="http://greeny.cs.tlu.ee/~penjmart/Suvepraktika-2.ryhm/main.php">Tagasi pealehele</a>
		</div>
		
	
</body>
</html>
