# NodeMCU ESP8266-12E Code

This folder contains the code for the NodeMCU ESP8266-12E (V1.0) board. This board will be purely handling oximeter readings as well as HTTP Post to the database. Be sure to enter your server IP that will be handling the request or else you will get HTTP Error 404.
Also, be sure to wire up RX of the Arduino to TX of the NodeMCU and TX of the Arduino to RX of the NodeMCU or else the NodeMCU will fail in reading the string data sent by the Arduino.

Wiring of the Oximeter to be done as follows:
```
MAX30100 Pulse Oximeter Sensor (RCWL-0530): VCC to +3.3V of NodeMCU
                                           INT Pin to D0
                                           SCL Pin to D1
                                           SDA Pin to D2
                                           GND Pin to GND Pin of NodeMCU
```

>PLEASE WIRE UP THE VCC AND GND PINS PROPERLY OR ELSE THE SENSOR WILL FRY AND YOU WON'T BE ABLE TO USE IT. 

>ALSO WIRE UP THE RX,TX PINS PROPERLY TO AVOID ERRORS LIKE NO DATA BEING SENT TO DATABASE.
