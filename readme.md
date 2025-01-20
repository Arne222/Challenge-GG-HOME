# Hier vind je een aantal belangrijke notities en uitleg voor de code.
Lijstje van scripts: 
<br/>
SensorTeamgg.ino Dit script staat al op de microbit dus hoeft als alles goed gaat niet nog apart geupload te worden. Dit c++ scriptje zorgt ervoor dat de data van de sensoren wordt ingelezen en in de seriele monitor wordt gezet. Belangrijk het vereist de volgende libraries (en mischien nog de algemene adafruit library. Dit scriptje voer je uit in de arduino IDE. \
"ClosedCube_HDC1080.h" \
"Adafruit_CCS811.h" 
<br/><br/>
MysqlConnect.js Dit is een node.js scriptje (dus zorg dat je het runt met nodejs). Het scriptje pakt de seriele output die sensorteamgg.ino inleest  en stopt het in de database. Zorg dat je voordat je het script runt de gegevens van de database in de code aanpast. De benodigde libraries zijn: Nodejs en de serialport library van nodejs. 

`npm i serialport @serialport/parser-readline mysql` \
De website code:
De website code is geschreven in een combi van javascript en php. De website bestaat uit een simpele login pagina met daarna de inhoud van de sensoren samen met het advies tot actie.


