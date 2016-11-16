#!/bin/bash
value=$(ping -c 4 192.168.8.21 | grep received | awk '{print $4, $5}' | sed 's/,//g')


PIDFILE=/home/pi/lockfile.pid
if [ -f $PIDFILE ]
then
  PID=$(cat $PIDFILE)
  ps -p $PID > /dev/null 2>&1
  if [ $? -eq 0 ]
  then
    echo "Process already running"
    exit 1
  else
    ## Process not found assume not running
    echo $$ > $PIDFILE
    if [ $? -ne 0 ]
    then
      echo "Could not create PID file"
      exit 1
    fi
  fi
else
  echo $$ > $PIDFILE
  if [ $? -ne 0 ]
  then
    echo "Could not create PID file"
    exit 1
  fi
fi


echo $value

if [ "$value" = "4 received" ]; then
	echo "all good"
else
	gpio write 4 1 #Cut power
	sleep 30 #Wait 30 seconds
	gpio write 4 0 #Restore power
	sleep 600 #Wait 10 minutes before exiting
fi