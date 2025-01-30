import threading

#Funcion que sera ejecutada en un hilo
def worker():
    print("Hilo en ejecucion")

#Crear un hilo
thread = threading.Thread(target=worker)

#Iniciar el hilo
thread.start()

#Esperar a que el hilo termine
thread.join()
print("Hilo terminado")