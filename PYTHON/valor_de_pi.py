import tkinter as tk
import random

def aproximar_pi(n):
    dentro_circulo = 0
    for _ in range(n):
        x = random.uniform(-1, 1)
        y = random.uniform(-1, 1)
        distancia = x**2 + y**2
        if distancia <= 1:
            dentro_circulo += 1
    return (dentro_circulo / n) * 4

def main():
    ventana = tk.Tk()
    ventana.title("Aproximación de Pi con Monte Carlo")
    lienzo = tk.Canvas(ventana, width=400, height=400, bg="white")
    lienzo.pack()

    n_puntos = 1000
    pi_aproximado = aproximar_pi(n_puntos)
    error = abs(pi_aproximado - 3.14159265358979323846)

    lienzo.create_text(200, 50, text=f"Valor aproximado de Pi: {pi_aproximado:.5f}")
    lienzo.create_text(200, 100, text=f"Error: {error:.5f}")

    # Dibujar cuadrado
    lienzo.create_rectangle(100, 100, 300, 300)

    # Dibujar círculo
    lienzo.create_oval(100, 100, 300, 300, outline="blue")

    # Generar puntos
    for _ in range(n_puntos):
        x = random.uniform(100, 300)
        y = random.uniform(100, 300)
        distancia = x**2 + y**2
        if distancia <= 1:
            lienzo.create_oval(x, y, x+3, y+3, fill="blue")
        else:
            lienzo.create_oval(x, y, x+3, y+3, fill="black")

    ventana.mainloop()

if __name__ == "__main__":
    main()
