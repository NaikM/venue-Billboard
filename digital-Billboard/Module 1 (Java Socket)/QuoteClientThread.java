
//packages to support input/output and datagram transfer through sockets
import java.io.*;
import java.net.*;
import java.util.Timer;


public class QuoteClientThread extends Thread{
	
	DatagramSocket socket = null;
	Thread t;
	String threadName = "QuoteClient";		//name needed to initialize the server
	public String[] commands;				//used to store the internet address of the server (passed as an argument after running the java program)
	public InetAddress address;
	String received;
	
	public QuoteClientThread(String[] args){
		
		//initialize the address variable
		commands = new String[1];
		commands[0] = args[0];
		
		try{
			address = InetAddress.getByName(commands[0]);
		}
		catch(UnknownHostException e)
		{
			System.out.println("Could not resolve host");
		}
		
	}
	
	public void start(){
		t = new Thread(this, threadName);
		System.out.println("Client thread has started.");
		run();
	}
	
	public DatagramSocket createSocket() throws IOException{
		DatagramSocket socket = new DatagramSocket(4445);
		System.out.println("Client socket has been created.");
		return socket;
	}
	
	public void run(){
		
		//create a socket at port 4445
		do{
		System.out.println("Running.");
		socket = null;
		try{
			socket = createSocket();
		}
		catch(IOException e)
		{
			System.out.println("Could not create socket.");
		}
	
		//prepare a container to hold the data packet 
		byte[] buf = new byte[256];
		DatagramPacket packet = new DatagramPacket(buf, buf.length, address, 4445);
		
		//send a packet to the server to request it to start sending quotes
		try{
			socket.send(packet);
		}
		catch(IOException e)
		{
			System.out.println("Socket could not send packet.");
		}
		
		System.out.println("Client packet has been sent.");
		
		packet = new DatagramPacket(buf, buf.length);
		
		//receive a packet containing quotes
		try{
			socket.receive(packet);
		}
		catch(IOException e){
			System.out.println("Socket could not receive packet.");
		}
		
		System.out.println("Client packet has been received.");
		
		//print the quote
		received = new String(packet.getData(), 0, packet.getLength());
		System.out.println("Quote of the moment: " + received);
		socket.close();
	
		}while(received.equals("done") == false);
		
		return;
	}

}

class QuoteClient {
	public static void main (String[] args) throws IOException 
	{
		new QuoteClientThread(args).start();	
	}
}