# Voice-Commands
Capture user voice and transcribe it into text using Google Speech API

This project transcribes voice files to text using the google speech API. It was used in a project in order to control smart home devices using voice. In order to replicate and use the provided code you must issue an API key for the google Speech API. You can do so by registering the google developers community, just by using your google account here https://console.developers.google.com/projectselector/apis/dashboard. After that you can issue an API key for the Speech-to-text API in the credentials section. The software part of the project is built using Html, JavaScript, PHP and a bit of CSS and Python. The hardware part is using a raspberry pi as a LAMP sever on which, this code is hosted. Every smart device communicates with the raspberry pi which can control them. Here I demonstrate a simple way to control (on/off) a device through raspberry pi’s GPIO pins.

## Usage: 
The user will enter the VoiceCommands.html page and after choosing a preferable language (English by default) 
presses the record button and issues his command. After the stop record button is pressed, the app will package the user’s voice command into a .wav file using only pure JavaScript. The anatomy of a .wav file is the following:

![Canonical .wav file format](http://soundfile.sapp.org/doc/WaveFormat/wav-sound-format.gif ) 

The file will be sent to the Google’s Speech-to-text API asynchronously using Ajax and curl in the backend. The app receives the transcribed text which is displayed in the text box and then with a second ajax call, calculates the similarity rate with the commands that are stored in the database. If the rate is equal or above 85% the command is been executed. The commands were executed through a raspberry Pi that was controlling the corresponding devices and was also the server on which the application was hosted.
