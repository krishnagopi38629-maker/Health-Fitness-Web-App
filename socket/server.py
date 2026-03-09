import socket

# Create socket
server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

# Bind to host and port
host = '127.0.0.1'
port = 5000
server_socket.bind((host, port))

# Start listening
server_socket.listen(1)
print("Server is listening on port 5000...")

# Accept connection
conn, addr = server_socket.accept()
print("Connected by", addr)

while True:
    data = conn.recv(1024).decode()
    
    if not data:
        print("Client disconnected.")
        break

    print("Client:", data)

    message = input("Server: ")
    conn.send(message.encode())

conn.close()
server_socket.close()