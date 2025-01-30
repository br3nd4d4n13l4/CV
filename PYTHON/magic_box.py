import random

def magic_index(arr):
    for i in range(len(arr)):
        if arr[i] == i:
            return i
    return "No existe"

arr = [random.randint(-10, 10) for _ in range(10)]
print("Arreglo original:", arr)

arr.sort()
print("Arreglo ordenado:", arr)

print("El índice mágico está en:", magic_index(arr))
