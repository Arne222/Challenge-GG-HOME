const { SerialPort } = require('serialport');
const { ReadlineParser } = require('@serialport/parser-readline');
const mysql = require('mysql');

// Kijk in de arduino IDE welke poort je moet gebruiken en vervang dat hieronder
// op de plek van COM3!!!
const port = new SerialPort({ path: 'COM3', baudRate: 9600 }, (err) => {
    if (err) {
        console.error('Fout bij openen van seriële poort:', err.message);
        process.exit(1);
    } else {
        console.log('Seriële poort geopend op COM3');
    }
});

const parser = port.pipe(new ReadlineParser({ delimiter: '\n' }));

// Configuratie voor MySQL-database
// Vul hier gegevens in per laptop!!!!!!! 
// bij de meeste zal host en user wel kloppen maar ww en database niet
// pas dit dus zelf aan elke keer als je dit runt!!!
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'ditiseenwachtwoord',
    database: 'autometing'
});

db.connect((err) => {
    if (err) {
        console.error('Fout bij verbinden met de database:', err);
        process.exit(1);
    }
    console.log('Verbonden met de MySQL-database');

    const createLuchtkwaliteitTable = `
        CREATE TABLE IF NOT EXISTS luchtkwaliteit (
            id INT AUTO_INCREMENT PRIMARY KEY,
            co2 INT,
            tvoc INT,
            temperatuur FLOAT,
            luchtvochtigheid FLOAT,
            timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    `;
    db.query(createLuchtkwaliteitTable, (err) => {
        if (err) console.error('Fout bij maken van luchtkwaliteit tabel:', err);
        else console.log('Tabel luchtkwaliteit gecontroleerd/aangemaakt');
    });
});

let tempHumidityData = null;
let gasData = null;

parser.on('data', (line) => {
    console.log('Ontvangen:', line);

    const tempHumidityMatch = line.match(/T=(\d+\.\d+)C, RH=(\d+\.\d+)%/);
    const gasMatch = line.match(/CO2: (\d+)ppm, TVOC: (\d+)/);

    if (tempHumidityMatch) {
        const temperature = parseFloat(tempHumidityMatch[1]);
        const humidity = parseFloat(tempHumidityMatch[2]);
        tempHumidityData = { temperature, humidity };
    }

    if (gasMatch) {
        const co2 = parseInt(gasMatch[1], 10);
        const tvoc = parseInt(gasMatch[2], 10);
        gasData = { co2, tvoc };
    }

    // Als zowel temperatuur/luchtvochtigheid als gasmetingen beschikbaar zijn, sla ze op in de database
    if (tempHumidityData && gasData) {
        const { co2, tvoc } = gasData;
        const { temperature, humidity } = tempHumidityData;

        const insertLuchtkwaliteit = `
            INSERT INTO luchtkwaliteit (co2, tvoc, temperatuur, luchtvochtigheid)
            VALUES (?, ?, ?, ?)
        `;
        db.query(insertLuchtkwaliteit, [co2, tvoc, temperature, humidity], (err) => {
            if (err) console.error('Fout bij invoegen van luchtkwaliteitsgegevens:', err);
            else console.log('Luchtkwaliteitsgegevens opgeslagen');
        });

        // Reset de variabelen zodat we nieuwe gegevens kunnen ontvangen
        tempHumidityData = null;
        gasData = null;
    }
});

process.on('SIGINT', () => {
    console.log('Programma wordt afgesloten...');
    port.close((err) => {
        if (err) console.error('Fout bij sluiten van seriële poort:', err.message);
        else console.log('Seriële poort gesloten');
    });
    db.end((err) => {
        if (err) console.error('Fout bij sluiten van databaseverbinding:', err);
        else console.log('Databaseverbinding gesloten');
    });
    process.exit();
});
