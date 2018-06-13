<?php 
	$userNeeds = "";
	$packetType = "";
	$elecType = "";
	$powerType = "";
	
	$packetTypeError = "";
	$elecTypeError = "";
	$powerTypeError = "";
	
	//kas vajutati sumbit nuppu
	if(isset($_POST["submitButton"])){
		
		if (isset($_POST["packetType"])){
			if (empty($_POST["packetType"])){
				$packetTypeError = "NB, kirjuta siia oma vajadused!";
			}else{
				$packetType = $_POST["packetType"];
				echo $packetType;
		
			}
		}
		
		//kasutaja arvamuse omistamine
		if (isset($_POST["elecType"])){
			if (empty($_POST["elecType"])){
				$elecTypeError = "NB, kirjuta siia oma vajadused!";
			}else{
				$elecType = $_POST["elecType"];
				echo $elecType;
		
			}
		}
		
		if (isset($_POST["powerType"])){
			if (empty($_POST["powerType"])){
				$powerTypeError = "NB, kirjuta siia oma vajadused!";
			}else{
				$powerType = $_POST["powerType"];
				echo $powerType;
		
			}
		}
		
	
	}
	
	$ledNotice = "";
	if (isset($_POST["checkbox"])){
		
		if(!empty($_POST["checkbox"])){
			//$ledNotice = "Led töötab";
		} else {
			//$ledNotice = "Led väljas";
		}
	}
	
	$myFile = fopen("userNeeds.txt", "w") or die ("Ei saa avada");
	fwrite($myFile, $packetType."\n".$elecType."\n".$powerType."\n");
	fclose($myFile);
	

	
?>

<!DOCTYPE html>
<head>
	<title> User input </title>
</head>

<style>
</style>

<body>
	<div id="write" style="text-align:center">
	<h1> Sisesta oma eelistused </h1>
		<form method="POST">
			<label>Siit vali </label>
				<select name="packetType">
					<option value="Tühi">---</option>
					<option value="valik1">Valik1</option>
					<option value="valik2">Valik2</option>
					<option value="valik3">Valik3</option>
				</select>
			<br><br>
			<label>Siia kirjuta elektri tüüp </label>
			<input name="elecType" type="text">
			<br><br>
			<label>Siia kirjuta powertype </label>
			<input name="powerType" type="text">
			<br><br>
			<input name="submitButton" type="submit" value="Sisesta">
	
			</form>
		
	</div> 
		<br><br>
		<br><br>
		<div id="led">
			<label> Kas led sees/väljas?</label>
				<input type="checkbox">
				<span class="slider"></span>
		</div>
		
	
</body>
</html>
