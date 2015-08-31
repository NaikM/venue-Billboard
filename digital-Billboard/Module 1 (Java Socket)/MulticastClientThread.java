import java.io.*;
import java.net.*;
import java.net.UnknownHostException;

class MulticastClient{
	public static void main(String[] args) {
	
	MulticastSocket socket = null;
	InetAddress group = null;
	
	//create a multicast socket attached to port 4446
	try{
		socket = new MulticastSocket(4446);
	}
	catch(IOException e)
	{
		System.out.println("Could not create socket.");
	}
	
	//create a multicast group defined by the IP address 239.0.0.1
	try{
		group = InetAddress.getByName("239.0.0.1");
	}
	catch(UnknownHostException e){
		System.out.println("Unknown host exception.");
	}
	
	//join the socket to the group
	try{
		socket.joinGroup(group);
	}
	catch(IOException e){
		System.out.println("Socket could not join group");
	}
	
	//just receive the first 5 quotes
	DatagramPacket packet;
	for(int i=0; i<5; i++){
		
		//create a container to hold the packet
		byte[] buf = new byte[256];
		packet = new DatagramPacket(buf, buf.length);
		
		System.out.println("Inside the for loop.");
		try{
			socket.receive(packet);
		}
		catch(IOException e)
		{
			System.out.println("Could not receive the packet.");
		}
		
		//print the quote
		String received = new String(packet.getData());
		System.out.println("Quote of the Moment: " + received);
	}
	
	try{
		socket.leaveGroup(group);
	}
	catch(IOException e){
		System.out.println("Sockt could not leave group.");
	}
	socket.close();
	}
}