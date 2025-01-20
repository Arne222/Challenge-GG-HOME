-- Step 1: Create the database
CREATE DATABASE Challenge3;

-- Step 2: Use the newly created database
USE Challenge3;

-- Step 3: Create the KLANT table
CREATE TABLE KLANT (
    KlantID VARCHAR(5) NOT NULL,
    Naam VARCHAR(50) NOT NULL,
    Emailadres VARCHAR(100) NOT NULL,
    Telefoonnummer VARCHAR(11),
    Adres VARCHAR(100),
    Postcode VARCHAR(6),
   PRIMARY KEY (KlantID)
);

-- Step 4: Create the MONITOR table
CREATE TABLE MONITOR (
    MonitorID INT AUTO_INCREMENT PRIMARY KEY,
	KlantID VARCHAR(5),
    -- Naam_Air VARCHAR(100) NOT NULL, --DEZE DOET TIJDELIJK NIET MEE!!!
    Installatiedatum DATE,
    FOREIGN KEY (KlantID) REFERENCES KLANT(KlantID)
);

-- Step 5: Create the METING table
CREATE TABLE METING (
    MetingID INT AUTO_INCREMENT PRIMARY KEY,
    DatumTijd DATETIME NOT NULL,
    CO2_PPM INT NOT NULL,
    AQI_Status VARCHAR(12),
	MonitorID INT,
    FOREIGN KEY (MonitorID)  REFERENCES  MONITOR(MonitorID)
);	-- Status = Good (green), can be better (orange) and bad (red).

-- Step 6: Create the ABONNEMENT table
CREATE TABLE ABONNEMENT (
    AbonnementID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(50) NOT NULL,
    Kosten_per_maand DECIMAL(10, 2) NOT NULL,
    Startdatum DATE,
    Einddatum DATE,
    KlantID VARCHAR(5),
    FOREIGN KEY (KlantID)  REFERENCES KLANT(KlantID)
);

-- Step 7: Create the Notificatie table
CREATE TABLE NOTIFICATIE (
	NotificatieID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(100) NOT NULL,
    DatumTijd DATETIME NOT NULL,
    Bericht VARCHAR (100) NOT NULL,
    Status1 VARCHAR (12) NOT NULL,
	MetingID INT,
    FOREIGN KEY (MetingID) REFERENCES METING(MetingID)
);	-- Status = Good (green), can be better (orange) and bad (red).
