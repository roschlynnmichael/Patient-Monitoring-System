//Code for Arduino by Sugad Anandrao Mankar & Jurs
//Just Connect Tx pin to Arduino Rx 0 pin  and run below code
// Demo program for Arduino MEGA2560 board and sensor with serial output
char sbuffer[30], ch;
unsigned char pos;
unsigned char read1, read2, read3;

void setup(){
 Serial.begin(9600); // Serial is used for output on PCs "Serial Monitor"
 //Serial1.begin(9600); // Serial1 is used for serial input from connected sensor
}

char mygetchar(void)
{ //receive serial character from sensor (blocking while nothing received)
 while (!Serial.available());
 return Serial.read();
}


void loop()
{
 ch = mygetchar(); //loop till character received
 if(ch==0x0A) // if received character is , 0x0A, 10 then process buffer
 {
     pos = 0; // buffer position reset for next reading

     // extract data from serial buffer to 8 bit integer value
     // convert data from ASCII to decimal
     read1 = ((sbuffer[1]-'0')*100) + ((sbuffer[2]-'0')*10) +(sbuffer[3]-'0');
     read2 = ((sbuffer[6]-'0')*100) + ((sbuffer[7]-'0')*10) +(sbuffer[8]-'0');
     read3 = ((sbuffer[11]-'0')*100) + ((sbuffer[12]-'0')*10) +(sbuffer[13]-'0');

     // Do whatever you wish to do with this sensor integer variables
     // Show on LCD or Do some action as per your application
     // Value of variables will be between 0-255

     // example: send demo output to serial monitor on "Serial"
     Serial.print(read1);
     Serial.print('\t');
     Serial.print(read2);
     Serial.print('\t');
     Serial.print(read3);
     Serial.print('\t');
     Serial.println();
 } else { //store serial data to buffer
     sbuffer[pos] = ch;
     pos++;
 }
}// end loop
