#Automata finito No determinista
class AFN:
    def __init__(self):
        self.estado = 'q0'

    def transicion(self, simbolo):
        if self.estado == 'q0':
            if simbolo == '0':
                self.estado = 'q0'
            elif simbolo == '1':
                self.estado = 'q1'
        elif self.estado == 'q1':
            if simbolo == '0':
                self.estado = 'q1'
            elif simbolo == '1':
                self.estado = 'q0'

    def procesar_cadena(self, cadena):
        for simbolo in cadena:
            self.transicion(simbolo)
        return self.estado == 'q0'
    
#Ejemplo de uso
afn = AFN()
cadena = "0100" #Cadena de ejemplo
if afn.procesar_cadena(cadena):
    print("La cadena tiene un numero par de unos.")
else:
    print("La cadena tiene un numero impar de unos.")