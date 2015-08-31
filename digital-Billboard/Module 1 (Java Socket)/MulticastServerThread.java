import java.io.*;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.util.*;

public class MulticastServerThread extends QuoteServerThread{

	//create a server socket attached to port 4446
	public DatagramSocket createSocket() throws IOException{
			DatagramSocket socket = new DatagramSocket(4445);
			return socket;
	}

	
	public void run() {
		String dString = " ";		//string to signal when to stop sending
		DatagramSocket socket = null;

		//open the file containing the quotes
		BufferedReader in = null;
		try {
			in = new BufferedReader(new FileReader("quotes.txt"));
		}
		catch (FileNotFoundException e){
			System.out.println("Couldn't open quote file. Serving time instead.");
		}

		//for each quote, we need to initialize a new socket
		while (dString != null){
			try{ 
				try{
					socket = createSocket();
				}
				catch(IOException e)
				{
					System.out.println("Could not create the socket.");
				}
				
				//Create a container for the packet
				byte[] buf = new byte[256];
				
				//determine the value of dString
				if (in == null){
					dString = "done";
				}
				else{
					try{
						dString = in.readLine();
					}
					catch(IOException e){
						System.out.println("Could not read the file.");
					}
				}

				//stop sending quotes when dString is "done or null"
				if(dString == null)
					buf = "done".getBytes();
				else
					buf = dString.getBytes();
				
				//send the packet to the multicast IP address
				InetAddress group = InetAddress.getByName("239.0.0.1");
				DatagramPacket packet = new DatagramPacket(buf, buf.length, group, 4446);
				socket.send(packet);
				System.out.println("Packet was just sent");				

				//wait for a bit
				try{
					sleep((long)Math.random() * 5000);
				}
				catch (InterruptedException e){}
			}
			catch (IOException e){
				e.printStackTrace();
				//moreQuotes = false;
			}
		socket.close();
		}
	//socket.close();
	}
}

class MulticastServer{
	public static void main(String[] args) throws IOException{
		new MulticastServerThread().start();
	}
}
