from concurrent.futures import ThreadPoolExecutor
import time

def taera(n):
    print(f'Tarea {n} iniciada')
    time.sleep(2)
    print(f'Tarea {n} finalizada')
    return n 

def main():
    with ThreadPoolExecutor(max_workers=3) as executor:
        resultados = list(executor.map(taera, range(5)))
        print('Resultados: ', resultados)

if __name__ == '__main__':
    main()