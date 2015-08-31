import java.nio.file.Files;
import java.nio.file.Paths;
import java.nio.file.Path;

import java.io.*;
import java.net.*;
import java.io.IOException.*;
import java.io.BufferedReader;
import java.io.FileReader.*;

public class FileServerThread extends MulticastServerThread{
	
	public void run() {
		//checking whether the input file exists
		String dir = "C:\\Users\\snaik\\Desktop\\cake.JPEG";
		File file = new File(dir);
		
		DatagramSocket socket = null;

		//reading the file as bytes
		Path path = Paths.get(dir);
		byte[] data = new byte[(int)file.length()];
		try{
			data = Files.readAllBytes(path);
		}
		catch(IOException e)
		{
			System.out.println("Image file could not be read.");
		}

		
			try{ 
				try{
					socket = createSocket();
				}
				catch(IOException e)
				{
					System.out.println("Could not create the socket.");
				}
				
				//initialize the multicast IP address
				InetAddress group = InetAddress.getByName("239.0.0.1");
				
				//prepare the packet with file data and send it
				DatagramPacket packet = new DatagramPacket(data, data.length, group, 4446);
				socket.send(packet);
				System.out.println("Packet was just sent");				

				//wait for a little bit
				try{
					sleep((long)Math.random() * 5000);
				}
				catch (InterruptedException e){}
			}
			catch (IOException e){
				e.printStackTrace();
			}
		socket.close();
		
	}
}

class FileServer{
	public static void main(String[] args) throws IOException{
		new FileServerThread().start();
	}
}
