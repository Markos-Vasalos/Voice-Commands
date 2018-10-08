#!/usr/bin/env python
import RPi.GPIO as GPIO  
# to use Raspberry Pi board pin numbers  
GPIO.setmode(GPIO.BOARD)  
# set up GPIO output channel  
GPIO.setup(11, GPIO.OUT)  
# close the relay that controls the device 
GPIO.output(11,GPIO.LOW)
