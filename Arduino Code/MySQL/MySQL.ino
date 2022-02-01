#include <ESP8266WiFi.h>
#include <MySQL_Connection.h>
#include <MySQL_Cursor.h>
#include <WiFiClient.h>

char WIFI_SSID[] = "SDsouza";
char WIFI_PASSWORD[] = "dsouza@8104045917";
byte mac[6];

WiFiServer server(80);
IPAddress ip(10, 0, 0, 20);
IPAddress gateway(10, 0, 0, 1);
IPAddress subnet(255, 0, 0, 0);

WiFiClient client;
MySQL_Connection conn((Client *)&client);
char query[128];

String sensor_data;
bool Sr;
String id="1";

IPAddress server_addr(10, 0, 0, 16);
char user[]="root";
char password[]="savarino@5451"

void setup() {
  // put your setup code here, to run once:
  Serial.println("Initializing Connection");
  Serial.print("Setting static IP to:");
  Serial.println(ip);
  delay(100);
  Serial.println("Connecting to ");
  Serial.print(WIFI_SSID);
  WiFi.config(ip,gateway,subnet);
  WiFi.begin(WIFI_SSID,WIFI_PASSWORD);

  while(WiFi.status()!=WL_CONNECTED)
  {
    delay(20);
    Serial.print(".");
  }

  Serial.println("WiFi Connected");
  Serial.print("MAC:");
  Serial.print(mac[5],HEX);
  Serial.print(":");
  Serial.print(mac[4],HEX);
  Serial.print(":");
  Serial.print(mac[3],HEX);
  Serial.print(":");
  Serial.print(mac[2],HEX);
  Serial.print(":");
  Serial.print(mac[1],HEX);
  Serial.print(":");
  Serial.print(mac[0],HEX);
  Serial.print(":");
  Serial.println("Assigned IP:")
  Serial.print(WiFi.localIP());
  Serial.println("");

  Serial.println("Connecting to MySQL Database");
  while(conn.connect(server_addr,3306,user,password)=true)
  {
    delay(20);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("Connected to MySQL Database");
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

  char INSERT_SQL[] = "INSERT INTO patient_monitoring.patient_stats(patient_name, patient_temp, AIR_TEMPERATURE, SOIL_MOISTURE_1) VALUES (1, NULL, NULL, %d)";

  

}
