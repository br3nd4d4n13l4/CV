# Definimos el diccionario con los artículos y sus precios
catalogo = {
    "lapiz": 2.00,
    "pegamento": 18.00,
    "colores": 35.00
}

# Función para calcular el total a pagar
def calcular_total(articulos, tiene_credencial):
    total = sum(articulos.values())  # Suma de todos los valores (precios)
    if tiene_credencial:
        descuento = total * 0.1
        total -= descuento
    return total

# Función principal para manejar la compra
def main():
    carrito = {}  # Diccionario para almacenar los artículos seleccionados y sus cantidades

    while True:
        print("Catálogo de artículos disponibles:")
        for articulo, precio in catalogo.items():
            print(f"- {articulo}: ${precio:.2f}")

        articulo = input("Ingrese el nombre del artículo que desea comprar (o 'fin' para terminar la compra): ").lower()
        
        if articulo == "fin":
            break
        
        if articulo in catalogo:
            if articulo in carrito:
                carrito[articulo] += 1
            else:
                carrito[articulo] = 1
            print(f"Se ha agregado 1 unidad de '{articulo}' al carrito.\n")
        else:
            print("El artículo ingresado no está en el catálogo.\n")

    if not carrito:
        print("No ha seleccionado ningún artículo. ¡Hasta luego!")
        return

    print("\nResumen de su compra:")
    for articulo, cantidad in carrito.items():
        precio_unitario = catalogo[articulo]
        subtotal = precio_unitario * cantidad
        print(f"- {cantidad} {articulo}: ${subtotal:.2f}")

    credencial = input("\n¿Cuenta con credencial de estudiante? (S/N): ").strip().upper()
    if credencial == "S":
        tiene_credencial = True
    else:
        tiene_credencial = False

    total_pagar = calcular_total(carrito, tiene_credencial)
    print(f"\nEl total a pagar{' con descuento de estudiante' if tiene_credencial else ''} es: ${total_pagar:.2f}")

# Llamamos a la función principal para iniciar la compra
if __name__ == "__main__":
    main()
