import numpy as np
import tkinter as tk
from tkinter import messagebox

class RubikCube:
    def __init__(self):
        self.cube = np.array([
            [['white']*3 for _ in range(3)],  # Blanco
            [['green']*3 for _ in range(3)],  # Verde
            [['red']*3 for _ in range(3)],    # Rojo
            [['blue']*3 for _ in range(3)],   # Azul
            [['orange']*3 for _ in range(3)], # Naranja
            [['yellow']*3 for _ in range(3)]  # Amarillo
        ])
    
    def rotate_face(self, face, clockwise=True):
        if clockwise:
            self.cube[face] = np.rot90(self.cube[face], -1)
        else:
            self.cube[face] = np.rot90(self.cube[face], 1)
    
    def apply_algorithm(self, algorithm):
        moves = {
            'F': 0, 'B': 1, 'L': 2, 'R': 3, 'U': 4, 'D': 5
        }
        for move in algorithm:
            if move in moves:
                self.rotate_face(moves[move], clockwise=True)
            elif move == "F'":
                self.rotate_face(0, clockwise=False)
            elif move == "B'":
                self.rotate_face(1, clockwise=False)
            elif move == "L'":
                self.rotate_face(2, clockwise=False)
            elif move == "R'":
                self.rotate_face(3, clockwise=False)
            elif move == "U'":
                self.rotate_face(4, clockwise=False)
            elif move == "D'":
                self.rotate_face(5, clockwise=False)
    
    def solve_cross(self):
        cross_algorithm = ['F', 'R', 'U', 'R\'', 'U\'']
        self.apply_algorithm(cross_algorithm)

class RubikCubeGUI:
    def __init__(self, root):
        self.root = root
        self.root.title("Rubik's Cube")
        self.cube = RubikCube()
        self.create_widgets()
    
    def create_widgets(self):
        # Create buttons for actions
        self.solve_button = tk.Button(self.root, text="Solve Cross", command=self.solve_cross)
        self.solve_button.pack()

        # Create a canvas to display the cube
        self.canvas = tk.Canvas(self.root, width=600, height=400, bg="white")
        self.canvas.pack()
        self.draw_cube()
    
    def draw_cube(self):
        self.canvas.delete("all")
        colors = ['white', 'green', 'red', 'blue', 'orange', 'yellow']
        x_start = 10
        y_start = 10
        size = 50
        
        for i, face in enumerate(self.cube.cube):
            for r in range(3):
                for c in range(3):
                    color = face[r][c]
                    self.canvas.create_rectangle(x_start + c*size, y_start + r*size,
                                                 x_start + (c+1)*size, y_start + (r+1)*size,
                                                 fill=color, outline="black")
            x_start += 4*size
        
    def solve_cross(self):
        self.cube.solve_cross()
        self.draw_cube()
        messagebox.showinfo("Info", "Cruz completada.")

if __name__ == "__main__":
    root = tk.Tk()
    app = RubikCubeGUI(root)
    root.mainloop()
