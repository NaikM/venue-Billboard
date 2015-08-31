import java.io.*;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.util.Date;

public class QuoteServerThread extends Thread {
	
	String dString = null;					//dString is used to signal when there are no more quotes to be received
	Thread t;
	String threadName = "QuoteServer";		//threadName is needed during thread initialization
	
	QuoteServerThread(){}					//thread constructor
	
	public void start(){
		t = new Thread(this, threadName);
		System.out.println("Server thread has started.");
		run();								//thread's run function
	}
	
	//create a server-side socket at a port
	public DatagramSocket createSockets() throws IOException{
			DatagramSocket socket = new DatagramSocket(4445);
			return socket;
	}
	
	public void run(){
			
			//open the file with quotes
			BufferedReader in = null;
			try {
				in = new BufferedReader(new FileReader("quotes.txt"));
			}
			catch (FileNotFoundException e){
				System.out.println("Couldn't open quote file. Serving time instead.");
			}
			
			
			
			do{
					//create a socket at port 4445 
					DatagramSocket socket = null; 
					try{
						socket = createSockets();
					}
					catch(IOException e)
					{
						System.out.println("Could not create the socket.");
					}
					
					//creates the container for the packet it will receive 
					byte[] buf = new byte[256];
					DatagramPacket packet = new DatagramPacket(buf, buf.length);
					
					//receive a packet sent to the socket at port 4445 from the client
					try{
						socket.receive(packet);
					}
					catch(IOException e){
						System.out.println("Could not receive datagram socket.");
					}
					
					//input a quote from the open file 
					//decide if there are any more quotes to be received. Program finishes when the line read is null
					if (in == null){
						dString = "done";
					}
					else
					{
						try{
							dString = in.readLine();
						}
						catch(IOException e){
							System.out.println("Could not read the file.");
						}
					}

					
					if(dString == null || dString == "done")
						buf = "done".getBytes();
					else
						buf = dString.getBytes();
					
					
					//send packet to the correct port and address
					InetAddress address = packet.getAddress();
					int port = packet.getPort();
					packet = new DatagramPacket(buf, buf.length, address, port);
					try{
						socket.send(packet);
					}
					catch(IOException e){
						System.out.println("Could not send the quote from the socket.");
					}
					//closing the socket each time
					socket.close();
			}while(dString != null);
			
		try{
			in.close();
		}
		catch(IOException e){
			System.out.println("Could not close the file");
		}
		
	}
	
}

class QuoteServer {
	public static void main (String[] args) throws IOException 
	{
		System.out.println("Hello");
		new QuoteServerThread().start();	
	}
}


