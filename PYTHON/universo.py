import tkinter as tk
import threading
import time
from tkinter import messagebox, simpledialog
import matplotlib.pyplot as plt
import numpy as np
import re

class BinaryStringGenerator(tk.Tk):
    def __init__(self):
        super().__init__()

        self.title("Generador de cadenas binarias")
        self.geometry("400x400")

        self.label = tk.Label(self, text="Introduce un valor para n (0 <= 1000): ")
        self.label.pack()

        self.entry = tk.Entry(self)
        self.entry.pack()

        self.generate_button = tk.Button(self, text="Generar Cadenas (Manual)", command=self.generate_manual)
        self.generate_button.pack()

        self.auto_button = tk.Button(self, text="Inicia Modo Automatico", command=self.start_auto_mode)
        self.auto_button.pack()

        self.plot_button = tk.Button(self, text="Graficar Unos y Ceros", command=self.plot_ones_zeros)
        self.plot_button.pack()
        
        self.output_text = tk.Text(self, height=15, width=50)
        self.output_text.pack()

        self.is_auto_running = False

    def generate_binary_strings(self, n):
        if n < 0 or n > 1000:
            raise ValueError("El valor de n debe estar en el rango [0, 1000].")
        
        binary_strings = []
        for i in range(2**n):
            binary_string = bin(i)[2:].zfill(n)
            binary_strings.append(binary_string)

        return binary_strings
    
    def save_to_file(self, binary_strings, n, chunk_size=100):
        total_strings = len(binary_strings)
        num_chunks = (total_strings // chunk_size) + (1 if total_strings % chunk_size > 0 else 0)

        for chunk in range(num_chunks):
            start_index = chunk * chunk_size
            end_index = min(start_index + chunk_size, total_strings)
            chunked_strings = binary_strings[start_index:end_index]
            
            with open(f'binary_strings_n_{n}_chunk_{chunk + 1}.txt', 'w') as f:
                f.write(f'{{\n')
                for binary_string in chunked_strings:
                    f.write(f'  "{binary_string}",\n')
                f.write(f'}}\n')

    def generate_manual(self):
        try:
            n = int(self.entry.get())
            if n < 0 or n > 1000:
                raise ValueError("El valor de n debe estar en el rango [0, 1000].")

            all_binary_strings = []
            for i in range(n + 1):  # Generar para n desde 0 hasta el ingresado
                binary_strings = self.generate_binary_strings(i)
                all_binary_strings.extend(binary_strings)

            self.output_text.delete(1.0, tk.END)

            # Mostrar el conjunto en el Text Widget
            output_set = '{\n' + ',\n'.join(f'  "{bs}"' for bs in all_binary_strings) + '\n}'
            self.output_text.insert(tk.END, output_set)
            self.output_text.insert(tk.END, f"\nTotal de cadenas generadas: {len(all_binary_strings)}\n")

            # Guardar en archivos en partes
            self.save_to_file(all_binary_strings, n)

        except ValueError as e:
            self.output_text.delete(1.0, tk.END)
            self.output_text.insert(tk.END, str(e))

    def start_auto_mode(self):
        if not self.is_auto_running:
            self.is_auto_running = True
            threading.Thread(target=self.auto_generate).start()

    def auto_generate(self):
        n = 3
        while self.is_auto_running:
            all_binary_strings = []
            for i in range(n + 1):  # Generar para n desde 0 hasta n
                binary_strings = self.generate_binary_strings(i)
                all_binary_strings.extend(binary_strings)

            self.output_text.delete(1.0, tk.END)

            # Mostrar el conjunto en el Text Widget
            output_set = '{\n' + ',\n'.join(f'  "{bs}"' for bs in all_binary_strings) + '\n}'
            self.output_text.insert(tk.END, output_set)
            self.output_text.insert(tk.END, f"\nTotal de cadenas generadas: {len(all_binary_strings)}\n")

            # Guardar en archivos en partes
            self.save_to_file(all_binary_strings, n)

            time.sleep(5)

            # Preguntar si quiere continuar
            if not self.ask_continue():
                self.is_auto_running = False

    def ask_continue(self):
        return messagebox.askyesno("Continuar", "¿Quieres calcular otra 'n'?")

    def plot_ones_zeros(self):
        n = self.entry.get()
        
        # Asking for chunk number to plot
        chunk_number = simpledialog.askinteger("Chunk Number", "Introduce el número de chunk a graficar:", minvalue=1)
        filename = f'binary_strings_n_{n}_chunk_{chunk_number}.txt'
        
        try:
            with open(filename, 'r') as f:
                content = f.read()

            # Extraer cadenas binarias usando una expresión regular
            binary_strings = re.findall(r'"([01]+)"', content)
            counts_ones = [bs.count('1') for bs in binary_strings]
            counts_zeros = [bs.count('0') for bs in binary_strings]

            # Crear gráfico
            x = np.arange(len(binary_strings))  # Posiciones en x

            plt.figure(figsize=(10, 5))
            plt.bar(x - 0.2, counts_ones, width=0.4, label='Unos', color='blue')
            plt.bar(x + 0.2, counts_zeros, width=0.4, label='Ceros', color='orange')

            plt.xlabel('Cadenas binarias')
            plt.ylabel('Conteo')
            plt.title('Conteo de Unos y Ceros en Cadenas Binarias')
            plt.xticks(x, binary_strings, rotation=90)
            plt.legend()
            plt.tight_layout()
            plt.show()

        except FileNotFoundError:
            messagebox.showerror("Error", "El archivo no se encuentra. Genera cadenas primero.")
        except Exception as e:
            messagebox.showerror("Error", str(e))

    def on_closing(self):
        self.is_auto_running = False
        self.destroy()

if __name__ == "__main__":
    app = BinaryStringGenerator()
    app.protocol("WM_DELETE_WINDOW", app.on_closing)
    app.mainloop()
