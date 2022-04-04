# Iot Based Patient Monitoring System 🏥

We are Roschlynn and Francina, the developers of this repository. We have designed an IoT Based Remote Monitoring Solution that records patient vitals like heart rate, blood pressure and oxygen saturation of the blood of a patient and records this data into the database.

We are Group 11 from Don Bosco Institute of Technology, Kurla(W), Mumbai-400070 and we thus present our final year project to you that has taken a full year to design, process, prototype and develop.

We faced a lot of challenges along the way that to a lot of learning and with a lot of errors due to poor documentation and library issues for Arduino and NodeMCU. But, we have been able to come through and design this entire project.

# Folder Details

* Arduino Folder contains code for Arduino Mega 2560
* NodeMCU Folder contains code for NodeMCU ESP8266-12E (V1.0)
* SQL Dump Folder contains the SQL Dump file for PHPMyAdmin
* Website Folder contains the entire website code as well as the HTTP Post Script that will be run

# To get started quickly with this project ✨

1. Clone the Repository using git
```
git clone https://github.com/roschlynnmichael/Patient-Monitoring-System.git
```

2. Prepare your webserver
  * In case your using Raspberry Pi as your web server, begin by installing LAMP Stack on it.
  * In case your using any other hardware as your web server, you can install LAMP Stack as well on it.
  > Be Sure to assign a Static IP Address to your Web Server.

3. Setup your Arduino and NodeMCU
  * Obtain libraries for DS18B20 OneWire Thermal Probe and MAX30100 Pulse Oximeter Sensor.
  * Burn the codes for the Arduino Mega 2560 and NodeMCU. 

4. Setup Database using the SQL Dump File
