#!/bin/sh

VIDEOPATH="/run/shm"
SERVICE="omxplayer"
	
while true; do
	#if omxplayer the running then don't do anything
	if ps ax | grep -v grep | grep $SERVICE > /dev/null
	then
	sleep 1;
else
	#for every video in /run/shm, play it in the omxplayer and
	#move the video to /home/pi/Desktop to get rid of it
	for entry in $VIDEOPATH/*
	do
		clear
		omxplayer -o hdmi --orientation 90 $entry > /dev/null
		mv $entry /home/pi/Desktop
	done
fi
done

