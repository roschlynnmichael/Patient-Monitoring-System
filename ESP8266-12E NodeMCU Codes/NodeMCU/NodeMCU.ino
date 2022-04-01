#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <Wire.h>
#include "MAX30100.h"
#include "MAX30100_PulseOximeter.h"

#define REPORTING_PERIOD_MS 1000

MAX30100 maxim;
PulseOximeter pox;

const char* ssid = "SDsouza";
const char* password = "dsouza@8104045917";
const char* serverName = "http://10.0.0.13/post-sensor-data.php";

String systolic_pressure;
String diastolic_pressure;
String pulse_rate;
String temperature_body;
String BPM;
String SpO2;
    
uint32_t tsLastReport = 0;

String sensor_data;
bool Sr;
String machineid = "MR1";
String room_number= "A1";
String bed_number= "1";

HTTPClient http;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  pinMode(16,OUTPUT);
  WiFi.begin(ssid , password);
  Serial.print("Connecting to SSID:");
  Serial.print(ssid);
  while (WiFi.status() != WL_CONNECTED)
  {
    Serial.print(".");
    delay(500);
  }
  Serial.println();
  Serial.print("Connected Successfully!!");
  Serial.println(WiFi.localIP());
  if(!pox.begin())
  {
    Serial.print("Failed");
    for(;;);
  }
  else
  {
    Serial.println("Success");
  }
  pox.setIRLedCurrent(MAX30100_LED_CURR_50MA);
}

void loop() {
  // put your main code here, to run repeatedly:
    pox.update();
    if(millis() - tsLastReport > REPORTING_PERIOD_MS)
    {
      BPM = pox.getHeartRate();
      SpO2 = pox.getSpO2();
      Serial.print("Bpm: ");
      Serial.println(BPM);
      Serial.print("SpO2: ");
      Serial.println(SpO2);
      tsLastReport = millis();
    }
    while (Serial.available())
    {
      sensor_data = Serial.readString();
      Sr = true;
    
      int firstcommaindex = sensor_data.indexOf(",");
      int secondcommaindex = sensor_data.indexOf(",", firstcommaindex + 1);
      int thirdcommaindex = sensor_data.indexOf(",", secondcommaindex + 1);
      int fourthcommaindex = sensor_data.indexOf(",", thirdcommaindex + 1);

      systolic_pressure = sensor_data.substring(0, firstcommaindex);
      diastolic_pressure = sensor_data.substring(firstcommaindex + 1, secondcommaindex);
      pulse_rate = sensor_data.substring(secondcommaindex + 1, thirdcommaindex);
      temperature_body = sensor_data.substring(thirdcommaindex + 1);

      String httpRequestData = "machine_identifier=" + machineid + "&temp=" + temperature_body + "&hr=" + pulse_rate + "&sys_pressure=" + systolic_pressure + "&dias_pressure=" + diastolic_pressure + "&oxy_lvl=" + SpO2 + "&room_number=" + room_number + "&bed_number=" + bed_number + "";
      Serial.println(httpRequestData);
      http.begin(serverName);
      http.addHeader("Content-Type" , "application/x-www-form-urlencoded");
      Serial.print("HTTP Request Data: ");
      Serial.println(httpRequestData);
      http.POST(httpRequestData);
      http.end();
      
      maxim.resetFifo();
    }
}
