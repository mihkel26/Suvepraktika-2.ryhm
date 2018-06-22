# TARGA MAJA LAHENDUS

Projekti eesmärk on leida kõige soodsam kütmise periood. Kasutaja märgib kasutajaliideses ära, mis ajaks ta tahab, et soojustus tööle läheb või mis ajaks peab põrand soe olema. Programm analüüsib elektri börsihinda ning kalkuleerib välja kõige soodsama ajavahemiku, millal kütta nii, et soovitud ajaks on põrand soe.
Projekt on loodud Digitehnoloogiate Instituudi informaatika õppekava I aasta tudengite suvepraktika aine raames.

## Kasutatud tehnoloogiad:
Rasperry Pi 2 peal kasutasime PyModbus, Python 3, cron, Apache2 veebiserver, millele installeeritud PHP
Rasperry pi on ühenduses ITvilla releeplokiga, mille külge on omakorda ühendatud temperatuuri mõõdik ning radiaatorkütte simulaator.

## Paigaldusjuhised
Rasperry Pi panna voolivõrku, ühendada taha ekraan, klaviatuur ja hiir. Järgmiseks ühendada Raspberry järgi ITVilla releeplokk module IT5888-4, mille kollane juhe panna A ning punane B ModbusRTU auku. Releeplokiga ühendada veel [radiaatorküttesimulaator], mille kahe juhtme otsiku must juhe läheb GND ning punane D pessa. Nelja juhtmega otsiku puhul kollane - 7, punane - 8, roheline ning must GND. Välistemperatuuri mõõdiku kahe juhtme otsiku must juhe läheb GND ning punane D pessa. Labori toiteplokk ühendada Power V0 ja VS pessa ning miinus ots GND. Praktika ajal kasutati 10 V.

Skeem: https://gyazo.com/97646a5d52c69408a6709f99102b88ee


1. Raspberry Pi’sse tuleb allalaadida vajalikud rakenduse programmid. (https://github.com/mihkel26/Suvepraktika-2.ryhm)
2. Allalaetud .py failid tuleks paigutada kausta /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt, et PHP ja pythoni ei läheks omavahel pahuksisse (Suvepraktika näitel)
3. Kõigepealt tuleb uuendada package’id. Command Terminali käsureale sudo apt-get update
4. Raspberry Pi’s tuleb tööle panna veebiserver, et saaks kohalikus võrgus kuvada .php faile. Selleks tuleb avada Command Terminal ning käsureale sisestada sudo apt-get install apache2
5. Järgnevalt on vaja veebiserveri tarbeks installeerida PHP -> sudo apt-get install php libapache2-mod-php -y
6. On vaja installeerida ka eraldi Python’i teek pymodbus.  
1. sudo apt-get install python-dev
2. sudo apt-get install python-pip
3.  pip install pymodbus
7. Navigeerida kausta cd /var/www/html ning kustutada index.html sudo rm index.html
8. Kõik .php failid tuleks asetada kausta aadressil var/www/html
9. Lõpuks tuleb kaustale anda tarvilikud õigused sudo chmod 7777 var/www/html
10. On vaja installeerida pymodbus, mis aitab Raspberry pi-l ühilduda relee plokk -> sudo apt-get install pymodbus.
11. Kasutajaliidsele pääseb ligi, kui veebilehitsejasse trükkida localhost/

## Liikmed:
Sten Piirsalu, 
Kairo Pettai, 
Mihkel Mägi, 
Sander Lukas, 
Märten Joosep Penjam

