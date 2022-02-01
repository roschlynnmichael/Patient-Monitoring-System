#include <ESP8266WiFi.h>
#include <FirebaseArduino.h>
#include <Arduino.h>

#define FIREBASE_HOST "Your Firebase Database Host"
#define FIREBASE_AUTH "Your Firebase Authentication Key"
#define WIFI_SSID "Your Wi-Fi SSID"
#define WIFI_PASSWORD "Your Wi-Fi Password"

String sensor_data;
bool Sr;
String id="1";

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.print("Connecting to SSID:");
  Serial.print(WIFI_SSID);
  while (WiFi.status() != WL_CONNECTED)
  {
    Serial.print(".");
    delay(500);
  }
  Serial.println();
  Serial.print("Connected Successfully!!");
  Serial.println(WiFi.localIP());
  Firebase.begin(FIREBASE_HOST, FIREBASE_AUTH);
  Firebase.setString("Patient_Details/BED1/BedNumber:", id);
  delay(100);
}

void loop() {
  // put your main code here, to run repeatedly:
  while (Serial.available())
  {
    sensor_data = Serial.readString();
    Sr = true;
  }

  int firstcommaindex = sensor_data.indexOf(",");
  int secondcommaindex = sensor_data.indexOf(",", firstcommaindex + 1);
  int thirdcommaindex = sensor_data.indexOf(",", secondcommaindex + 1);
  int fourthcommaindex = sensor_data.indexOf(",", thirdcommaindex + 1);

  String systolic_pressure = sensor_data.substring(0, firstcommaindex);
  String diastolic_pressure = sensor_data.substring(firstcommaindex + 1, secondcommaindex);
  String pulse_rate = sensor_data.substring(secondcommaindex + 1, thirdcommaindex);
  String temperature_body = sensor_data.substring(thirdcommaindex + 1);

  Firebase.setString("Patient_Details/BED1/SystolicPressure:", systolic_pressure);
  delay(100);
  Firebase.setString("Patient_Details/BED1/DiastolicPressure:", diastolic_pressure);
  delay(100);
  Firebase.setString("Patient_Details/BED1/PulseRate:", pulse_rate);
  delay(100);
  Firebase.setString("Patient_Details/BED1/BodyTemperature:", temperature_body);
  delay(100);

}
