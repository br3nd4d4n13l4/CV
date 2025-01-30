import tkinter as tk
from tkinter import Canvas, messagebox
from PIL import Image, ImageTk
import random

class PuzzleApp:
    def __init__(self, root, image_path, rows, cols):
        self.root = root
        self.rows = rows
        self.cols = cols
        self.image_path = image_path
        self.pieces = []
        self.create_widgets()
        self.load_image()
        self.create_puzzle()
        self.shuffle_pieces()
        self.draw_puzzle()

    def create_widgets(self):
        self.canvas = Canvas(self.root, width=600, height=600)
        self.canvas.pack()
        self.canvas.bind('<Button-1>', self.on_click)
        self.canvas.bind('<B1-Motion>', self.on_drag)
        self.canvas.bind('<ButtonRelease-1>', self.on_drop)
        self.selected_piece = None
        self.original_position = None

    def load_image(self):
        self.image = Image.open(self.image_path)
        self.image = self.image.resize((600, 600))
        self.piece_width = self.image.width // self.cols
        self.piece_height = self.image.height // self.rows

    def create_puzzle(self):
        for i in range(self.rows):
            for j in range(self.cols):
                left = j * self.piece_width
                upper = i * self.piece_height
                right = (j + 1) * self.piece_width
                lower = (i + 1) * self.piece_height

                piece_image = self.image.crop((left, upper, right, lower))
                piece_image = ImageTk.PhotoImage(piece_image)
                piece = {'image': piece_image, 'x': j * self.piece_width, 'y': i * self.piece_height, 'original': (j, i)}
                self.pieces.append(piece)

    def shuffle_pieces(self):
        random.shuffle(self.pieces)
        for index, piece in enumerate(self.pieces):
            piece['x'] = (index % self.cols) * self.piece_width
            piece['y'] = (index // self.cols) * self.piece_height

    def draw_puzzle(self):
        self.canvas.delete('all')
        for piece in self.pieces:
            self.canvas.create_image(piece['x'], piece['y'], image=piece['image'], anchor='nw', tags='piece')

    def on_click(self, event):
        x, y = event.x, event.y
        for piece in self.pieces:
            if piece['x'] <= x < piece['x'] + self.piece_width and piece['y'] <= y < piece['y'] + self.piece_height:
                self.selected_piece = piece
                self.original_position = (piece['x'], piece['y'])

    def on_drag(self, event):
        if self.selected_piece:
            self.canvas.delete('piece')
            self.selected_piece['x'] = event.x - self.piece_width // 2
            self.selected_piece['y'] = event.y - self.piece_height // 2
            self.draw_puzzle()

    def on_drop(self, event):
        if self.selected_piece:
            x, y = event.x, event.y
            new_x = (x // self.piece_width) * self.piece_width
            new_y = (y // self.piece_height) * self.piece_height
            self.selected_piece['x'] = new_x
            self.selected_piece['y'] = new_y
            self.draw_puzzle()
            self.selected_piece = None
            self.check_win()

    def check_win(self):
        for piece in self.pieces:
            if (piece['x'], piece['y']) != (piece['original'][0] * self.piece_width, piece['original'][1] * self.piece_height):
                return  # Si encuentra una pieza fuera de su posición original, sale de la función

        # Si todas las piezas están en su posición original, muestra el mensaje de felicitación
        self.show_win_message()

    def show_win_message(self):
        messagebox.showinfo("¡Juego completado!", "¡Has resuelto el rompecabezas!")

root = tk.Tk()
root.title("Rompecabezas de Paisaje")
app = PuzzleApp(root, 'C:/Users/ASUS/Desktop/landscape.jpg', 3, 3)
root.mainloop()
