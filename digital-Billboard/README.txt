
WEB APPLICATION: REAL-TIME VIDEO-SNAPSHOTTING

The purpose of this web application is to grab snaphots of a video playing on a webpage. 

The same video is to be played on a public screen (in this case, it is a computer screen).

When the viewer clicks a button on the screen, snapshots will be saved on a server which the 
viewer can later access, view, and manipulate.

******************************************

Modules of the Projects:

Module 1. Image Transfer: Transferring images from the server's local filesystem to the desktops of clients
	- this will be done via broadcast at first between a server and a client
	- in the long term, a multicast is needed because many clients will be using this service at the 
	  same time
	  
Module 2. Synching: Playing the video in the webpage (webpage video) and synchronizing it with the video playing in a loop
   on the public screen (desktop video).
    - for our purposes, it is assumed that the desktop video starting playing at a specifc date and time.
	  Ofcourse, this should be changed so that the owner of the video can input the time that the video first
	  started looping

Module 3. Snapshotting: Grabbing snapshots from the video at the precise moment that the user clicks the button.
   Saving the snapshots sequentially in the local filesystem of the server.
	- FFMPEG PHP is a tool that can do the job

*******************************************

Tools Used

1. Server Side Web Languages: PHP
2. Other Web Langauges: HTML, JavaScript
3. Video Editting Tools: FFMPEG php wrapper
	  



