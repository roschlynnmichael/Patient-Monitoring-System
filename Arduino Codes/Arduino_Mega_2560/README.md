# Arduino Mega 2560 Code

This file contains the code that needs to be burnt onto the Arduino Mega 2560. Please do not try to use Arduino Boards that have lower memory capacities.
For Example:

| Parameters | Arduino Mega 2560 | Arduino UNO Rev3 |
| ------------- | ------------- | ------------- |
| Flash Memory Size  | 256KB  | 32KB |
| SRAM Size  | 8KB  | 2KB  |
| EEPROM Size | 4KB | 1KB |

Flash Memory houses the entire code as well as the libraries that are required by the code. SRAM acts as temporary storage to play and manipulate variables and EEPROM acts as a permanent storage area even after the unit is powered down.

We will be using a lot of libraries that will power our project. Hence, to avoid memory limitation issues, please use Arduino Boards like the Mega which have greater memory and current draw capacities to avoid unnecessary errors.
You also need three 4.7KOhm Resistors to pull up the I2C bus of the LCD as well as the data line of the DS18B20 Thermal Probe for them to function properly. 
Connections to be done as follows:

```
DS18B20: +5V to +5V of Arduino
        GND to GND of Arduino
        Data line to Pin 11 of Arduino pulled up by 4.7KOhm Resistor and +5V

I2C LCD: +5V to +5V of Arduino
        GND to GND of Arduino
        SCL (Serial Clock) to Pin 21
        SDA (Serial Data) to Pin 20
        Remember to Pull Up the I2C SCL and SDA Pins in the same way how the Data line of the thermal probe was pulled up
        
Sun Rom Serial Reader and BP Machine: +5V to +5V of Arduino
                                      GND to GND of Arduino
                                      TX-OUT to Pin 13 of Arduino
```

The Arduino also needs to be connected to the NodeMCU by attaching pins 19 and 18 (RX,TX) of the Arduino Mega to the TX,RX pins of the NodeMCU respectively. This handles serial communication of data between the Arduino and NodeMCU thereby, allowing the NodeMCU to perform HTTP Post Request to the Webserver and insert the data into the database.

>DO NOT FORGET TO PULL UP THE DATALINE OF THE THERMAL PROBE AND THE I2C BUS OF THE I2C LCD ADAPTER BY USING 4.7KOHM RESISTORS OR ELSE THERE IS A RISK OF DAMAGE OR ERROR IN READINGS.

>ALSO DO NOT FORGET TO WIRE UP THE +5V AND GND LINES PROPERLY ELSE YOU WILL FRY THE ENTIRE UNIT REQUIRING REPLACEMENT
