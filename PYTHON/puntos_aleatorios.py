import tkinter as tk
import random

def generar_puntos(lienzo, cantidad):
    puntos_generados = set()  # Utilizamos un conjunto para almacenar los puntos generados
    while len(puntos_generados) < cantidad:
        x = random.randint(0, 400)
        y = random.randint(0, 400)
        # Verificar si el punto generado ya existe en el conjunto
        if (x, y) not in puntos_generados:
            puntos_generados.add((x, y))  # Agregar el punto generado al conjunto
            lienzo.create_oval(x, y, x+3, y+3, fill="black")

def main():
    ventana = tk.Tk()
    ventana.title("Puntos Aleatorios Las Vegas")
    lienzo = tk.Canvas(ventana, width=400, height=400, bg="white")
    lienzo.pack()

    cantidad = 1000
    generar_puntos(lienzo, cantidad)

    ventana.mainloop()

if __name__ == "__main__":
    main()
