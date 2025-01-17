
#include <Wire.h>
#include "ClosedCube_HDC1080.h"
#include "Adafruit_CCS811.h"

ClosedCube_HDC1080 hdc1080;
Adafruit_CCS811 ccs;


void setup()
{
	Serial.begin(9600);
	Serial.println("ClosedCube HDC1080 Arduino Test");
  Serial.println("CCS811 test");

   if(!ccs.begin()){
    Serial.println("Failed to start sensor! Please check your wiring.");
    while(1);
  }

  while(!ccs.available());
	hdc1080.begin(0x40);

	Serial.print("Manufacturer ID=0x");
	Serial.println(hdc1080.readManufacturerId(), HEX); 
	Serial.println(hdc1080.readDeviceId(), HEX); 
	
	printSerialNumber();

}

void loop()
{
	Serial.print("T=");
	Serial.print(hdc1080.readTemperature());
	Serial.print("C, RH=");
	Serial.print(hdc1080.readHumidity());
	Serial.println("%");
	delay(5000);
    if(ccs.available()){
    if(!ccs.readData()){
      Serial.print("CO2: ");
      Serial.print(ccs.geteCO2());
      Serial.print("ppm, TVOC: ");
      Serial.println(ccs.getTVOC());
    }
    else{
      Serial.println("ERROR!");
      while(1);
    }
  }
  delay(5000);
}

void printSerialNumber() {
	Serial.print("Device Serial Number=");
	HDC1080_SerialNumber sernum = hdc1080.readSerialNumber();
	char format[12];
	sprintf(format, "%02X-%04X-%04X", sernum.serialFirst, sernum.serialMid, sernum.serialLast);
	Serial.println(format);
}
