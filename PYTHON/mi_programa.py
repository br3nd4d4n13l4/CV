from tkinter import *

#Definir el laberinto como una matriz 3*3
laberinto = [
    [1,0,1],
    [0,1,0],
    [1,0,1]
]

#Funcion para dibujar el laberinto en una ventana tkinter
def dibujar_laberinto():
    root = Tk()
    canvas = Canvas(root, width=150, height=150)
    canvas.pack()

    for i in range(3):
        for j in range(3):
            x0, y0 = j * 50, i * 50
            x1, y1 = x0 + 50, y0 + 50
            if laberinto[i][j] == 1:
                canvas.create_rectangle(x0, y0, x1, y1, fill="black")
            else:
                canvas.create_rectangle(x0, y0, x1, y1, fill="white")

        root.mainloop()
#Llamar a la funcion para dibijar el laberinto
dibujar_laberinto()        