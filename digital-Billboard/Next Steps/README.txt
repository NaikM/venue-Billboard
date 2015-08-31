The next part of the project is to send frames of the video to a cloud Server so that the project works in any network.

At first, the video frames are sent directly from a Raspberry Pi (displaying video captured on a webcam on a monitor) to the cloud server.

The transfer rate was too slow so the computing power of a second Raspberry Ri is used.
One Raspberry Pi is used for displaying and saving video frames.
The second Raspberry Pi is used to transfer the frames to an application on a cloud server.
The frames are transferred between both Raspberry Pi using scp via a network bridge. 