from tkinter import *

#definir el laberinto como uma matriz 3*3
laberinto = [
    [0, 1, 0, 0],
    [0, 0, 0, 1],
    [1, 1, 0, 0],
    [0, 0, 1, 0]
]

def dfs(x, y, path):
    if x == len(laberinto) - 1 and y == len(laberinto[0]) - 1:
        path.append((x, y))
        return True

    if x < len(laberinto) - 1 and laberinto[x + 1][y] == 0:
        path.append((x, y))
        if dfs(x + 1, y, path):
            return True
        path.pop()
    
    if y < len(laberinto[0]) - 1 and laberinto[x][y + 1] == 0:
        path.append((x, y))
        if dfs(x, y + 1, path):
            return True
        path.pop()

    return False

def dibujar_laberinto():
    root = Tk()
    canvas = Canvas(root, width=200, height=200)
    canvas.pack()

    for i in range(len(laberinto)):
        for j in range(len(laberinto[0])):
            x0, y0 = j * 50, i * 50
            x1, y1 = x0 + 50, y0 + 50
            if laberinto[i][j] == 1:
                canvas.create_rectangle(x0, y0, x1, y1, fill="black")
            else:
                canvas.create_rectangle(x0, y0, x1, y1, fill="white")
    
    path = [(0, 0)]
    dfs(0, 0, path)
    for i in range(1, len(path)):
        x0, y0 = path[i - 1][1] * 50 + 25, path[i - 1][0] * 50 + 25
        x1, y1 = path[i][1] * 50 + 25, path[i][0] * 50 + 25
        canvas.create_line(x0, y1, x1, y1, width=3, fill="red")
    
    root.mainloop()

dibujar_laberinto()