# Valores dados
ingreso_mensual = 1200
meta = 1000
inversion = 200
gastos = 1000
extras = 200

# Calcular el total
total = ingreso_mensual + inversion - gastos + extras

# Mostrar resultados
print(f"Total: {total}")
if total >= meta:
    print("¡Meta alcanzada!")
else:
    print("Meta no alcanzada")
