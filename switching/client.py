import socket
import threading

nickname = input("Choose your nickname: ")

client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

HOST = '127.0.0.1'   # Same machine
PORT = 5000

client.connect((HOST, PORT))


def receive():
    while True:
        try:
            message = client.recv(1024).decode()

            if message == 'NICK':
                client.send(nickname.encode())
            else:
                print(message)

        except:
            print("Disconnected from server.")
            client.close()
            break


def write():
    while True:
        message = f"{nickname}: {input()}"
        client.send(message.encode())


receive_thread = threading.Thread(target=receive)
receive_thread.start()

write_thread = threading.Thread(target=write)
write_thread.start()