# TARGA MAJA LAHENDUS

Projekti eesmärk on leida kõige soodsam kütmise periood. Kasutaja märgib kasutajaliideses ära, mis ajaks ta tahab, et soojustus tööle läheb või mis ajaks peab põrand soe olema. Programm analüüsib elektri börsihinda ning kalkuleerib välja kõige soodsama ajavahemiku, millal kütta nii, et soovitud ajaks on põrand soe.
Projekt on loodud Digitehnoloogiate Instituudi informaatika õppekava I aasta tudengite suvepraktika aine raames.

## Kasutatud tehnoloogiad:
Rasperry Pi 2 peal kasutasime PyModbus, Python 3, cron, Apache2 veebiserver, millele installeeritud PHP
Rasperry pi on ühenduses ITvilla releeplokiga, mille külge on omakorda ühendatud temperatuuri mõõdik ning radiaatorkütte simulaator.

## Paigaldusjuhised
Rasperry Pi panna voolivõrku, ühendada taha ekraan, klaviatuur ja hiir. Järgmiseks ühendada Raspberry järgi ITVilla releeplokk module IT5888-4, mille kollane juhe panna A ning punane B ModbusRTU auku. Releeplokiga ühendada veel [radiaatorküttesimulaator], mille kahe juhtme otsiku must juhe läheb GND ning punane D pessa. Nelja juhtmega otsiku puhul kollane - 7, punane - 8, roheline ning must GND. Välistemperatuuri mõõdiku kahe juhtme otsiku must juhe läheb GND ning punane D pessa. Labori toiteplokk ühendada Power V0 ja VS pessa ning miinus ots GND. Praktika ajal kasutati 10 V.

## Liikmed:
Sten Piirsalu
Kairo Pettai
Mihkel Mägi
Sander Lukas
Märten Joosep Penjam

