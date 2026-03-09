import socket
import threading

HOST = '127.0.0.1'   # Localhost (same machine)
PORT = 5000

server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
server.bind((HOST, PORT))
server.listen()

print("Server started on 127.0.0.1:5000")

clients = []
nicknames = []


def broadcast(message):
    for client in clients:
        client.send(message)


def handle_client(client):
    while True:
        try:
            message = client.recv(1024)
            broadcast(message)
        except:
            index = clients.index(client)
            clients.remove(client)
            client.close()

            nickname = nicknames[index]
            broadcast(f"{nickname} left the chat!".encode())

            nicknames.remove(nickname)
            break


def receive():
    while True:
        client, address = server.accept()
        print("Connected with", address)

        client.send("NICK".encode())
        nickname = client.recv(1024).decode()

        nicknames.append(nickname)
        clients.append(client)

        print("Nickname is", nickname)

        broadcast(f"{nickname} joined the chat!".encode())
        client.send("Connected to the server!".encode())

        thread = threading.Thread(target=handle_client, args=(client,))
        thread.start()


receive()