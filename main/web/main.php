<?php
	$deviceFile = fopen("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt", "r") or die ("Ei saa avada (fail peab olema 'w' õigusega");
	$deviceState = fread($deviceFile, filesize("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt"));
	fclose($deviceFile);
	
	list($state, $devTemp, $roomTemp, $marketPrice) = explode("\n", $deviceState);
	$devTemp = round($devTemp, 2);
	$roomTemp = round($roomTemp, 2);
?>
<!DOCTYPE html>
<head>
	<title> Tark Maja </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="design/design.css">
</head>
<body>
	<div id="Header">
	<h1> Targa Maja Lahendus</h1>
	</div>
	<div id="userChoice">
		<div style="margin-bottom: 15px; color : white; text-align: center;">
			<div> Seade on: <span><?php echo $state; ?></div>
			<div> Seadme temperatuur: <span><?php echo $devTemp; ?></div>
			<div> Ruumi temperatuur: <span><?php echo $roomTemp; ?></div>
			<div> Börsihind: <span><?php echo $marketPrice; ?></div>
		</div>
		<br><br>
		<div id="shortcuts">
			<a class="btn" href="heating.php">Kütteaeg kellaajaks</a>
			<a class="btn" href="timer.php">Vali ise ajavahemik</a>
			<a class="btn" href="temphold.php">Hoia temperatuuri</a>	
		</div>				
	</div>
</body>
</html>
