#include <Process.h> 
#include <Bridge.h>
 
int led = 13;
int BUTTON = 7;
int tapisserieOpen;
int start_val_bouton;
int val_bouton = 0;

void setup() 
{
        Bridge.begin();
        pinMode(led, OUTPUT); 
        Serial.begin(9600);
        pinMode(BUTTON, INPUT);
        start_val_bouton = digitalRead(BUTTON);
}

void OpenTapisserie() {
  Process p;        // Create a process and call it "p"
  p.runShellCommand("curl -d 'status=1&debug=0'  http://api.la-tapisserie.net/s");
  //or use runShellCommandAsynchronously instead of runShellCommand
}

void closeTapisserie() {
  Process p;        // Create a process and call it "p"
  p.runShellCommand("curl -d 'status=0&debug=0'  http://api.la-tapisserie.net/s");
}

void loop() 
{
       val_bouton = digitalRead(BUTTON);
       Serial.println(val_bouton);
       if(val_bouton) {
               digitalWrite(led, LOW);
               if (tapisserieOpen) {
                 closeTapisserie();
                   Serial.println("CLOSE");
                    tapisserieOpen = 0;
                  delay(4000);
                 }
               
        }
        else {
              digitalWrite(led,HIGH); 
              if (tapisserieOpen == 0) {
                 OpenTapisserie(); 
                
                 Serial.println("OPEN");
                 tapisserieOpen = 1;
                  delay(4000);
              }
            
        }
     
        delay(500);
 }
