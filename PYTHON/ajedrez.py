import tkinter as tk
import random
import networkx as nx
import matplotlib.pyplot as plt

class ChessBoard(tk.Tk):
    def __init__(self):
        super().__init__()

        self.title("Tablero de Ajedrez 5x5 - Dos Jugadores")
        self.geometry("400x400")

        self.board = [[None for _ in range(5)] for _ in range(5)]
        self.current_positions = [(0, 0), (1, 4)]  # Jugador 1 en (0, 0) y Jugador 2 en (1, 4)
        self.auto_mode = False
        self.current_player = random.choice([0, 1])
        self.winner = None

        self.create_board()
        self.update_board()

        self.entry = tk.Entry(self)
        self.entry.grid(row=5, column=0, columnspan=5)

        self.move_button = tk.Button(self, text="Ejecutar Movimientos", command=self.execute_moves)
        self.move_button.grid(row=6, column=0, columnspan=5)

        self.random_button = tk.Button(self, text="Generar Movimientos Aleatorios", command=self.generate_random_moves)
        self.random_button.grid(row=7, column=0, columnspan=5)

        self.toggle_button = tk.Button(self, text="Activar Modo Automático", command=self.toggle_mode)
        self.toggle_button.grid(row=8, column=0, columnspan=5)

        self.start_message = tk.Label(self, text=f"Jugador {self.current_player + 1} inicia.", font=("Helvetica", 12))
        self.start_message.grid(row=9, column=0, columnspan=5)

        self.save_moves_button = tk.Button(self, text="Guardar Movimientos", command=self.save_moves)
        self.save_moves_button.grid(row=10, column=0, columnspan=5)

        self.nfa_button = tk.Button(self, text="Graficar NFA", command=self.draw_nfa)
        self.nfa_button.grid(row=11, column=0, columnspan=5)

    def create_board(self):
        for row in range(5):
            for col in range(5):
                btn = tk.Button(self, text="", width=6, height=3,
                                command=lambda r=row, c=col: self.move_piece(r, c))
                btn.grid(row=row, column=col)
                self.board[row][col] = btn

    def update_board(self):
        for row in range(5):
            for col in range(5):
                self.board[row][col].config(bg="white")

        self.board[self.current_positions[0][0]][self.current_positions[0][1]].config(bg="blue")
        self.board[self.current_positions[1][0]][self.current_positions[1][1]].config(bg="red")

    def toggle_mode(self):
        self.auto_mode = not self.auto_mode
        self.toggle_button.config(text="Activar Modo Manual" if self.auto_mode else "Activar Modo Automático")
        if self.auto_mode:
            self.auto_move()  # Comenzar el movimiento automático
        else:
            self.after_cancel(self.auto_move_id)  # Detener el movimiento automático

    def execute_moves(self):
        moves = self.entry.get().strip()
        for move in moves.split():
            if move in ['U', 'D', 'L', 'R', 'UL', 'UR', 'DL', 'DR']:
                self.move_piece_manual(move)

    def generate_random_moves(self):
        random_moves = random.choices(['U', 'D', 'L', 'R', 'UL', 'UR', 'DL', 'DR'], k=5)
        moves_str = ' '.join(random_moves)
        self.entry.delete(0, tk.END)
        self.entry.insert(0, moves_str)
        self.execute_moves()

    def move_piece_manual(self, direction):
        r, c = self.current_positions[self.current_player]

        if direction == 'U' and (r - 1, c) in self.get_possible_moves(r, c):
            self.current_positions[self.current_player] = (r - 1, c)
        elif direction == 'D' and (r + 1, c) in self.get_possible_moves(r, c):
            self.current_positions[self.current_player] = (r + 1, c)
        elif direction == 'L' and (r, c - 1) in self.get_possible_moves(r, c):
            self.current_positions[self.current_player] = (r, c - 1)
        elif direction == 'R' and (r, c + 1) in self.get_possible_moves(r, c):
            self.current_positions[self.current_player] = (r, c + 1)
        elif direction == 'UL' and (r - 1, c - 1) in self.get_possible_moves(r, c):
            self.current_positions[self.current_player] = (r - 1, c - 1)
        elif direction == 'UR' and (r - 1, c + 1) in self.get_possible_moves(r, c):
            self.current_positions[self.current_player] = (r - 1, c + 1)
        elif direction == 'DL' and (r + 1, c - 1) in self.get_possible_moves(r, c):
            self.current_positions[self.current_player] = (r + 1, c - 1)
        elif direction == 'DR' and (r + 1, c + 1) in self.get_possible_moves(r, c):
            self.current_positions[self.current_player] = (r + 1, c + 1)

        self.update_board()
        self.check_winner()
        self.switch_player()

    def check_winner(self):
        player1_win = (4, 4)
        player2_win = (4, 0)

        if self.current_positions[0] == player1_win:
            self.winner = "Jugador 1 gana!"
            self.end_game()
        elif self.current_positions[1] == player2_win:
            self.winner = "Jugador 2 gana!"
            self.end_game()

    def end_game(self):
        for btn in self.board:
            for b in btn:
                b.config(state=tk.DISABLED)
        result_label = tk.Label(self, text=self.winner, font=("Helvetica", 16))
        result_label.grid(row=12, column=0, columnspan=5)

    def switch_player(self):
        self.current_player = 1 - self.current_player
        self.start_message.config(text=f"Jugador {self.current_player + 1} es el turno.")

    def get_possible_moves(self, r, c):
        possible_moves = []
        for dr, dc in [(-1, 0), (1, 0), (0, -1), (0, 1)]:
            nr, nc = r + dr, c + dc
            if 0 <= nr < 5 and 0 <= nc < 5:
                possible_moves.append((nr, nc))

        for dr, dc in [(-1, -1), (-1, 1), (1, -1), (1, 1)]:
            nr, nc = r + dr, c + dc
            if 0 <= nr < 5 and 0 <= nc < 5:
                possible_moves.append((nr, nc))

        return possible_moves

    def auto_move(self):
        if self.auto_mode:
            can_move = True
            r, c = self.current_positions[self.current_player]
            possible_moves = self.get_possible_moves(r, c)

            if possible_moves:
                move = random.choice(possible_moves)
                self.current_positions[self.current_player] = move
            else:
                can_move = False

            self.update_board()

            if not can_move:
                self.switch_player()
            else:
                self.check_winner()

            self.auto_move_id = self.after(1000, self.auto_move)

    def save_moves(self):
        all_moves = []
        winning_moves = []

        for i in range(2):
            r, c = self.current_positions[i]
            possible_moves = self.get_possible_moves(r, c)

            all_moves.append(f"Movimientos posibles para Jugador {i + 1} desde {self.current_positions[i]}: {possible_moves}")

            for move in possible_moves:
                if self.check_winning_move(move, i):
                    winning_moves.append(f"Movimiento ganador para Jugador {i + 1} desde {self.current_positions[i]}: {move}")

        with open('all_moves.txt', 'w') as f:
            for move in all_moves:
                f.write(move + '\n')

        with open('winning_moves.txt', 'w') as f:
            for move in winning_moves:
                f.write(move + '\n')

        print("Movimientos guardados en 'all_moves.txt' y 'winning_moves.txt'.")

    def check_winning_move(self, move, player):
        if player == 0 and move == (4, 4):
            return True
        elif player == 1 and move == (4, 0):
            return True
        return False

    def create_nfa(self):
        G = nx.DiGraph()

        for r in range(5):
            for c in range(5):
                state = (r, c)
                G.add_node(state)

                for dr, dc in [(-1, 0), (1, 0), (0, -1), (0, 1), (-1, -1), (-1, 1), (1, -1), (1, 1)]:
                    nr, nc = r + dr, c + dc
                    if 0 <= nr < 5 and 0 <= nc < 5:
                        next_state = (nr, nc)
                        G.add_edge(state, next_state)

        return G

    def draw_nfa(self):
        G = self.create_nfa()
        plt.figure(figsize=(10, 8))
        pos = {(r, c): (c, -r) for r in range(5) for c in range(5)}
        nx.draw(G, pos, with_labels=True, node_size=700, node_color='lightblue', font_size=10, font_weight='bold', arrows=True)
        plt.title("NFA de Movimientos en el Tablero de Ajedrez 5x5")
        plt.show()

if __name__ == "__main__":
    app = ChessBoard()
    app.mainloop()
