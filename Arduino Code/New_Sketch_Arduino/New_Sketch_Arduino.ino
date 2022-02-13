#include <LiquidCrystal_I2C.h>
#include <SoftwareSerial.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <Wire.h>
#include "MAX30100_PulseOximeter.h"

#define REPORTING_PERIOD_MS 1000
PulseOximeter pox;
uint32_t tsLastReport = 0;
float oxy_lvl = 0.00;

unsigned char alert = 0;
unsigned char system_alert = 0;
unsigned char alert_flag=0;

LiquidCrystal_I2C lcd(0x27,16,2);
SoftwareSerial myserial(13, 12);    // RX, TX for blood pressure sensor
SoftwareSerial esp8266(3, 2);     // rx,tx for esp8266

#define ONE_WIRE_BUS 3
#define HELP_TONE buzz, 2000, 200

const int buzz=9;

OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
float cel=0.00;

String data_pressure;
char  buff[15];

String send_data_string;

const int no_of_data = 5;
String main_data[10];
int sensorValue = 0;
unsigned int tempVal = 0; 

int  sys_u = 130, dia_u = 90, temp_l = 24, temp_u = 37, pulse_l = 30, pulse_u = 120;
int sys, dia, p, stay = 1;

void onBeatDetected()
{
  Serial.println("Heart beat detected!! Oximeter pulse detected!!");
}

void setup() 
{
  pinMode(buzz, OUTPUT);
  Serial.begin(9600);
  esp8266.begin(9600);
  myserial.begin(9600);
  sensors.begin();
  sensors.setWaitForConversion(false);
  lcd.begin();
  lcd.clear();
  Serial.print("Initializing Oximeter and other sensors");
  if(!pox.begin())
  {
    Serial.println("Oximeter Failed");
    lcd.print("Oximeter Failed");
    for(;;);
  }
  else
  {
    Serial.println("Oximeter Succeeded");
  }
  pox.setIRLedCurrent(MAX30100_LED_CURR_7_6MA);
  pox.setOnBeatDetectedCallback(onBeatDetected);
  lcd.print(F("        Patient "));
  lcd.setCursor(0, 1);
  lcd.print(F(" Health  Monitor "));
  delay(2000);  
  send_data_string = String(sys) + ',' + String(dia) + ',' + String(p) + ',' + String(cel) + ',' + String(oxy_lvl);
  Serial.println("send_data_string = " + String(send_data_string)); 
  send_parameters();  
  delay(4000);  
  lcd.clear();
}

void loop()
{
  digitalWrite(buzz,LOW);
  read_temperature_and_oxi();
  main_display();
   myserial.listen();
   if (myserial.available())
   {
     while (myserial.available())
     {
       data_pressure = myserial.readString();
     }
     data_pressure.trim();
     data_pressure.toCharArray(buff, data_pressure.length() + 1);
     if (sscanf(buff, "%d,%d,%d", &sys, &dia, &p) == 3)
     {
       lcd.clear();
       lcd.print(F("sys | dia | puls"));
       lcd.setCursor(0, 1);
       lcd.print(sys);
       lcd.setCursor(7, 1);
       lcd.print(dia);
       lcd.setCursor(12, 1);
       lcd.print(p);
       delay(7500);
       read_temperature_and_oxi();
       process();
       alerting();
       delay(500);
       send_data_string = String(sys) + ',' + String(dia) + ',' + String(p) + ',' + String(cel) + ',' + String(oxy_lvl);
       Serial.println("send_data_string = " + String(send_data_string)); 
       send_parameters();
       delay(3000);      
     } 
     myserial.end();    
   }  
   myserial.listen();
   delay(1);
}

void read_temperature_and_oxi()
{
  float HeartRate = 3.0, SpO2 = 3.0;
  pox.update();
  HeartRate = pox.getHeartRate();
  SpO2 = pox.getSpO2();
  if(millis() - tsLastReport > REPORTING_PERIOD_MS)
  {
    Serial.print("Heart Rate: ");
    Serial.print(HeartRate);
    Serial.print("bpm / SpO2: ");
    Serial.print(SpO2);
    Serial.println(" % ");

    sensors.requestTemperatures();
    cel=sensors.getTempCByIndex(0);
    Serial.print("Temperatures: ");
    Serial.print(cel);
    Serial.println("");

    tsLastReport=millis();
  }
}

void main_display()
{
    lcd.clear();
    lcd.print(F("Temp: "));
    lcd.setCursor(6, 0);
    lcd.print(cel);
    lcd.print((char)223);
    lcd.print('C');
    lcd.setCursor(0, 1);
    lcd.print("SpO2: ");
    lcd.setCursor(6 ,1);
    lcd.print(oxy_lvl);
    delay(200);
}

void send_parameters()
{
  esp8266.listen();
  esp8266.flush();
  esp8266.print(send_data_string);
  delay(5000);  
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print(F("  Uploaded To "));
  lcd.setCursor(0,1);
  lcd.print(F("  Firebase  "));
  delay(200);
  esp8266.end();
}

void help_display()
{
    lcd.clear();
    lcd.print(F(" PATIENT NEEDS  "));
    lcd.setCursor(6, 1);
    lcd.print(F("HELP      "));
}

void process()
{   
   if((sys > sys_u) || (dia > dia_u))
   {
       system_alert = 1; 
   }
   else if((p < pulse_l ) || (p > pulse_u))
   {
       system_alert = 2; 
   }  
   else if((cel < temp_l ) || (cel > temp_u))
   {
       system_alert = 3; 
   }
   else
   {
       system_alert = 0; 
   }
   delay(200);
}

void alerting()
{
  if(system_alert==1)
   {
    lcd.clear();
    digitalWrite(buzz,HIGH);
    lcd.setCursor(0,0);
    lcd.print("Patient BP");
    lcd.setCursor(0,1);
    lcd.print("Fluctuating");
    delay(3500);
   }
   else if(system_alert==2)
   {
    lcd.clear();
    digitalWrite(buzz,HIGH);
    lcd.setCursor(0,0);
    lcd.print("Patient Pulse");
    lcd.setCursor(0,1);
    lcd.print("Fluctuating");
    delay(3500);
   }
   else if(system_alert==3)
   {
    lcd.clear();
    digitalWrite(buzz,HIGH);
    lcd.setCursor(0,0);
    lcd.print("Temperature");
    lcd.setCursor(0,1);
    lcd.print("Fluctuating");
    delay(3500);
   }
   else
   {
    Serial.print("Continue Monitoring");
    delay(3500);
   }
}
  
