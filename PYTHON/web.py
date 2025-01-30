import requests
from bs4 import BeautifulSoup
import webbrowser

# URL que quieres scrape
url = 'https://estudyando.com/fisica-cuantica-definicion-y-teorias/'  # Cambia esto a la URL deseada
headers = {'User-Agent': 'Edge'}

# Hacer la solicitud
response = requests.get(url, headers=headers)

if response.status_code == 200:
    # Abrir la página en el navegador
    webbrowser.open(url)

    # Analizar el contenido HTML
    soup = BeautifulSoup(response.text, 'html.parser')

    palabra = input("Ingresa la palabra que desea buscar: ")

    texto = soup.get_text()
    
    contador = texto.lower().count(palabra.lower())

    print(f"La palabra '{palabra}' aparece {contador} veces en la pagina")
else:
    print("Error al acceder a la pagina: ", response.status_code)