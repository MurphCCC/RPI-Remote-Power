# RPI-Remote-Power
Simple script to control Powerswitch Tail II via Raspberry Pi


Remote.php is a simple remote control script that I put together in order to interact with the Powerswitch Tail.  It is running on the raspberry pi that the tail is connected to.  I use it so that I can get a quick look at the status of the relay.  Sending a GET request to remote.php with either ?on or ?off will switch the tail accordingly.  You can view the page in a browser to check the status.  I use the GPIO readall command to get the status of all the pins and then parse that down to just the on/off state of physical pin 4.
