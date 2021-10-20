#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <SoftwareSerial.h>
#include <OneWire.h>
#include <DallasTemperature.h>

unsigned char alert = 0;
unsigned char system_alert = 0;
unsigned char alert_flag=0;

LiquidCrystal_I2C lcd(0x27,16,2);
SoftwareSerial myserial(13, 12);    // RX, TX for blood pressure sensor
SoftwareSerial esp8266(3, 2);     // rx,tx for esp8266

#define ONE_WIRE_BUS A0
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

void setup() 
{
  pinMode(buzz, OUTPUT);
  Serial.begin(9600);
  esp8266.begin(9600);
  myserial.begin(9600);
  lcd.begin();
  lcd.clear();
  lcd.print(F("        Patient "));
  lcd.setCursor(0, 1);
  lcd.print(F(" Health  Monitor "));
  delay(2000);  
  send_data_string = String(sys) + ',' + String(dia) + ',' + String(p) + ',' + String(cel);
  Serial.println("send_data_string = " + String(send_data_string)); 
  send_parameters();  
  delay(4000);  
  lcd.clear();
}

void loop()
{
  digitalWrite(buzz,LOW);
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
       read_temperature(); 
       process();
       alerting();
       delay(500);
       send_data_string = String(sys) + ',' + String(dia) + ',' + String(p) + ',' + String(cel);
       Serial.println("send_data_string = " + String(send_data_string)); 
       send_parameters();
       delay(3000);      
     } 
     myserial.end();    
   }
   else
   {  
      read_temperature();
      main_display();
   }  
   myserial.listen();
   delay(1);
}

void read_temperature()
{
  Serial.print("Requesting Temperatures");
  Serial.println();
  for(int i=1;i<=5;i++)
  {
    sensors.requestTemperatures();
    cel=sensors.getTempCByIndex(0);
  }
  Serial.print("Temperature: ");
  Serial.print(cel);
  Serial.println("C");
  delay(100);
}

void main_display()
{
    lcd.clear();
    lcd.print(F(" Temp : "));
    lcd.setCursor(8, 0);
    lcd.print(cel);
    lcd.print((char)223);
    lcd.print('C');
    lcd.setCursor(4, 1);
    lcd.print(F("PRESS ON   "));
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
  
