#include <LiquidCrystal_I2C.h> //#include < Wire .h> we are removing this because it is already added in liquid crystal library
#include "MAX30100_PulseOximeter.h"
 
// Create the lcd object address 0x27 and 16 columns x 2 rows 
LiquidCrystal_I2C lcd (0x27, 16,2); //we can find the address through I2C address scanner
 
#define REPORTING_PERIOD_MS     1000
 
PulseOximeter pox;
uint32_t tsLastReport = 0;
 
void onBeatDetected()
{
    Serial.println("Beat!");
}
 
void setup()
{
    Serial.begin(9600);
    Serial.print("Initializing pulse oximeter..");
    lcd.print("Initializing...");
    delay(3000);
    lcd.clear();
 
    // Initialize the PulseOximeter instance
    // Failures are generally due to an improper wiring, missing power supply
    if (!pox.begin()) {
        Serial.println("FAILED");
        for(;;);
    } else {
        Serial.println("SUCCESS");
    }
     pox.setIRLedCurrent(MAX30100_LED_CURR_7_6MA);
 
    // Register a callback for the beat detection
    pox.setOnBeatDetectedCallback(onBeatDetected);
}
 
void loop()
{
    // Make sure to call update as fast as possible
    pox.update();
    if (millis() - tsLastReport > REPORTING_PERIOD_MS) {
        Serial.print("Heart rate:");
        Serial.print(pox.getHeartRate());
        Serial.print("bpm / SpO2:");
        Serial.print(pox.getSpO2());
        Serial.println("%");
 
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.print("BPM : ");
        lcd.print(pox.getHeartRate());
        
        lcd.setCursor(0,1);
        lcd.print("SpO2: ");
        lcd.print(pox.getSpO2());
        lcd.print("%");
        Serial.print(pox.getSpO2());
 
        tsLastReport = millis();
    }
}
