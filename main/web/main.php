<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['runTest'])) {
    test();
}
function test()
{
    $command = escapeshellcmd('/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/testTemp.py');
    $output = shell_exec($command);
    echo $output;
}

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
    <div id="shortcuts">


        <a class="btn" href="userInterface.php">Kütteaeg kellaajaks</a>

        <a class="btn" href="timer.php">Vali ise ajavahemik</a>

        <a class="btn" href="holdtemp.php">Hoia temperatuuri</a>


    </div>

    <form action="main.php" method="post">
        <input type="submit" name="runTest" value="GO" />
    </form>

</div>


</body>
</html>