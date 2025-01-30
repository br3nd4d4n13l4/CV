import re

# Conjunto de caracteres válidos en el lenguaje C (simplificado)
CARACTER_VALIDO_C = re.compile(r'^[a-zA-Z0-9_ \t\+\-\*/\(\)\[\]\{\}\.,;=\>\<\&\|\'\"\!\%\^\~\:\?]+$')

# Palabras reservadas del lenguaje C (puedes agregar más si es necesario)
PALABRAS_RESERVADAS_C = {
    'int', 'char', 'float', 'double', 'void', 'if', 'else', 'while', 'for', 'return', 'switch', 'case', 'break', 'continue', 'struct', 'union', 'typedef', 'const', 'volatile', 'static', 'extern', 'unsigned', 'signed'
}

# Expresión regular para identificadores válidos en C
IDENTIFICADOR_REGEX = re.compile(r'^[a-zA-Z_][a-zA-Z0-9_]*$')

# Expresión regular para símbolos
SIMBOLOS_REGEX = re.compile(r'[+\-*/\(\)\[\]\{\}\.,;=\>\<\&\|\'\"\!\%\^\~\:\?]')

# Expresión regular para verificar el símbolo de igualdad
SIMBOLO_IGUALDAD = re.compile(r'=')

# Expresión regular para verificar el símbolo de fin de línea
SIMBOLO_FIN_LINEA = re.compile(r';')

# Expresion regular para verificar numeros
SIMBOLO_DE_NUMERO = re.compile(r'^[0-9]+$')

def es_caracter_valido_c(linea):
    return CARACTER_VALIDO_C.match(linea) is not None

def es_identificador_valido(word):
    return IDENTIFICADOR_REGEX.match(word) is not None

def clasificar_simbolo(simbolo):
    if SIMBOLO_IGUALDAD.match(simbolo):
        return 'IG'  # Igualdad
    elif SIMBOLO_FIN_LINEA.match(simbolo):
        return 'FL'  # Fin de Línea
    elif SIMBOLOS_REGEX.match(simbolo):
        return 'SA'  # Símbolo
    elif SIMBOLO_DE_NUMERO.match(simbolo):
        return 'NU'  #Numeros
    else:
        return 'Desconocido'

def procesar_archivo(nombre_archivo):
    try:
        with open(nombre_archivo, 'r') as file:
            for line in file:
                line = line.strip()
                
                # Verificar si la línea contiene solo caracteres válidos en C
                if es_caracter_valido_c(line):
                    print(f"Línea válida en C: {line}")
                else:
                    print(f"Línea NO válida en C: {line}")
                
                # Verificar cada palabra en la línea
                words = re.split(r'(\W+)', line)  # Divide por símbolos y mantiene los símbolos
                for word in words:
                    word = word.strip()
                    if word == '':
                        continue
                    
                    if word in PALABRAS_RESERVADAS_C:
                        print(f"'{word}' es una palabra reservada en C (PR).")
                    elif es_identificador_valido(word):
                        print(f"'{word}' es un identificador válido en C (ID).")
                    elif clasificar_simbolo(word) == 'IG':
                        print(f"'{word}' es un símbolo de igualdad (IG).")
                    elif clasificar_simbolo(word) == 'FL':
                        print(f"'{word}' es un símbolo de fin de línea (FL).")
                    elif clasificar_simbolo(word) == 'SA':
                        print(f"'{word}' es un símbolo (SA).")
                    elif clasificar_simbolo(word) == 'NU':
                        print(f"'{word}' es un numero (NU).")
                    else:
                        print(f"'{word}' NO es un identificador válido en C.")
    
    except FileNotFoundError:
        print(f"El archivo '{nombre_archivo}' no se encontró.")
    except Exception as e:
        print(f"Ocurrió un error: {e}")

# Nombre del archivo a procesar
nombre_archivo = 'entrada.txt'
procesar_archivo(nombre_archivo)
