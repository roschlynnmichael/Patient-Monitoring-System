#include <Wire.h>
#include "MAX30100_PulseOximeter.h"
#include <LiquidCrystal_I2C.h>
#include <OneWire.h>
#include <DallasTemperature.h>

#define REPORTING_PERIOD_MS     1000
// PulseOximeter is the higher level interface to the sensor
// it offers:
//  * beat detection reporting
//  * heart rate calculation
//  * SpO2 (oxidation level) calculation
PulseOximeter pox;
uint32_t tsLastReport = 0;
LiquidCrystal_I2C lcd(0x27, 16, 2);

#define ONE_WIRE_BUS 3
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
float cel=0.00;

// Callback (registered below) fired when a pulse is detected
void onBeatDetected()
{
  Serial.println("Beat!");
}
void setup()
{
  Serial.begin(9600);
  Serial.print("Initializing...");
  sensors.begin();
  sensors.setWaitForConversion(false);
  // Initialize the PulseOximeter instance
  // Failures are generally due to an improper I2C wiring, missing power supply
  // or wrong target chip
  if (!pox.begin()) {
    Serial.println("MAX30100 was not found. Please check the wiring/power.");
    lcd.print("FAILED");
    for (;;);
  } else {
    Serial.println("SUCCESS");
  }
  // The default current for the IR LED is 50mA and it could be changed
  //   by uncommenting the following line. Check MAX30100_Registers.h for all the
  //   available options.
  // pox.setIRLedCurrent(MAX30100_LED_CURR_7_6MA);
  // Register a callback for the beat detection
  pox.setOnBeatDetectedCallback(onBeatDetected);
}
void loop()
{
  float HeartRate = 3.0, SpO2 = 3.0;
  // Make sure to call update as fast as possible
  pox.update();
  HeartRate = pox.getHeartRate();
  SpO2 = pox.getSpO2();
  // Asynchronously dump heart rate and oxidation levels to the serial
  // For both, a value of 0 means "invalid"
  if (millis() - tsLastReport > REPORTING_PERIOD_MS) {
    Serial.print("Heart rate:");
    Serial.print(HeartRate);
    Serial.print("bpm / SpO2:");
    Serial.print(SpO2);
    Serial.println("%");
    sensors.requestTemperatures();
    cel=sensors.getTempCByIndex(0);
    Serial.print("Temperature: ");
    Serial.print(cel);
    Serial.println("");
    tsLastReport = millis();

    lcd.clear();
    lcd.setCursor(0,0);
    
    lcd.print("HR:");
    lcd.print(HeartRate);
    lcd.print(" bpm");
 
    lcd.setCursor(0,1);
    
    lcd.print("SpO2:");
    lcd.print(SpO2);
    lcd.print("%");

    lcd.setCursor(11,1);
    lcd.print("T:");
    lcd.print(cel);
  }
}
