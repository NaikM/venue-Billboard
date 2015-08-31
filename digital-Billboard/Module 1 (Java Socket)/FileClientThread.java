import java.io.*;
import java.net.*;
import java.net.UnknownHostException;

class FileClientThread extends MulticastClient{
	public static void main(String[] args) {
	
		MulticastSocket socket = null;
		InetAddress group = null;
		
		final int FILE_SIZE = 6022386;
		final String FILE_TO_RECEIVE = "C:\\Users\\snaik\\Desktop\\pudding.JPEG";
		FileOutputStream fos = null;
		BufferedOutputStream bos = null;
		
		//Create a multicast socket attached to port 4446
		try{
			socket = new MulticastSocket(4446);
		}
		catch(IOException e)
		{
			System.out.println("Could not create socket.");
		}
		
		//initialize the multicast IP address
		try{
			group = InetAddress.getByName("239.0.0.1");
		}
		catch(UnknownHostException e){
			System.out.println("Unknown host exception.");
		}
		
		//join the socket to the multicast group
		try{
			socket.joinGroup(group);
		}
		catch(IOException e){
			System.out.println("Socket could not join group");
		}
		
		//receive the first 5 files
		DatagramPacket packet;
		for(int i=0; i<5; i++){
			
			//create a packet container that can hold an entire file in it
			byte[] buf = new byte[FILE_SIZE];
			packet = new DatagramPacket(buf, buf.length);
			
			System.out.println("Inside the for loop.");
			try{
				socket.receive(packet);
			}
			catch(IOException e)
			{
				System.out.println("Could not receive the packet.");
			}
			
			//Create an output file on the local filesystem 
			try{
				fos = new FileOutputStream(FILE_TO_RECEIVE);
			}
			catch(IOException e){
				System.out.println("File cannot be outputted to.");
			}
			
			//Output the data to the output file
			bos = new BufferedOutputStream(fos);
			byte[] get = new byte[packet.getLength()];
			get = packet.getData();
			//System.out.println(packet.getLength());
			
			try{
				bos.write(get, 0, 20000);
			}
			catch(IOException e){
				System.out.println("Could not write image to file.");
			}
			
			try{
				bos.flush();		//delete all remaining data in the buffered output stream
			}
			catch(IOException e)
			{
				System.out.println("Could not flush bos.");
			}
				
			
			
		}
		
		//remove the socket from the group
		try{
			socket.leaveGroup(group);
		}
		catch(IOException e){
			System.out.println("Socket could not leave group.");
		}
		
		//close the file output stream
		try{
			fos.close();
		}
		catch(IOException e){
			System.out.println("Can't close file.");
		}
		
		//close the buffered output stream
		try{
			bos.close();
		}
		catch(IOException e){
			System.out.println("Can't close bos.");
		}
		
		//close the socket
		socket.close();
		}
}