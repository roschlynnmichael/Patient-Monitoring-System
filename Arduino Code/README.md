# Installing Libraries
Required Libraries:

SoftwareSerial
ESP8266 Community (V2.8.0)
Dallas Temperature
One Wire
Wire
I2C_LCD
Firebase Arduino Master

Install these libraries before you proceed

# Getting Started 

1. Before you go to the Arduino side of things it is important to ensure that your ESP8266 Module is burnt with the code.
2. Open the firebase code for esp8266 and change the database host, the authentication key, wifi ssid and password for your own firebase settings.
3. Be sure to connect the reset pin of the arduino uno to ground and the gpio2 to ground to enter flashing mode. 
4. Connect RX and TX of Arduino to RX and TX of ESP8266 respectively
5. Burn the code onto the ESP module
6. Your ESP setup has been completed

# Getting Started with Arduino UNO Rev3

To deploy this project the following steps need to be followed.

1. The I2C-Scanner-Code needs to be run first after connecting the I2C Serial Reader to the LCD. The I2C requires you to connect just 4 wires rather than all 16 that is traditionally required by the LCD.
2. Connect the I2C as follows to the Arduino VCC: +5V Power GND: Ground pin SDA: A4 SCL:A5
3. Burn the I2C Scanner Code onto the Arduino and go to the Serial Monitor
4. The address of the I2C is now displayed. Note down this address as it will be used later.
5. Now open the New_Sketch_Arduino and follow the connections as per the code
6. To connect the DS18B20, you need a 4.7K pull-up resistor as you will risk frying your thermal probe rendering it useless
7. Go to https://www.sunrom.com/566 to buy the BP Machine and Serial Reader Combo.
8. Follow connections as per the code
9. Be sure to use a breadboard to enable multiple devices to be connected to the 3.3V and 5V Pin of the Arduino
10. Burn the Code onto the Arduino
11. The project has been successfully setup.

# Debug Phase
No power to display: Recheck your connections. They can get loose overtime
ESP8266 not responding: Try burning the AT Firmware onto the ESP module using an CH340 USB to Serial Adapter
DS18B20 Thermal Probe heats up badly: Recheck your connections and see to it you use a resistor. If you did not use a resistor, you probably fried your thermal probe permanently.
ESP8266 not sending data to Firebase: Update the fingeprint in your HTTPCLIENT.h to enable secure communication between the ESP module and Firebase. Put your firebase database host on the website https://www.grc.com/fingerprints.htm and click to fingeprint your firebase database host. Copy this fingerprint and input it into your HTTPCLIENT.h file in the arduino library. Even after this if it doesn't send data, be sure to check your connection as loose connections are 90% of the times causing errors.

