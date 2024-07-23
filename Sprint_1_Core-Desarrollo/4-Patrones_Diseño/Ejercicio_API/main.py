from fastapi import FastAPI
from datetime import datetime

app = FastAPI()

@app.get('/')
def rootAPI():
    return{'bienvenida':'Bienvenido a la API Calculadora'}

@app.get('/suma/{valor1}/{valor2}')
def suma(valor1,valor2):    
    try:
        return{'resultado' : int(valor1)+int(valor2)}
    except:
        return{'error' : 'Los parametros deben de ser numero enteros no decimales ni caracteres'}

@app.get('/resta/{valor1}/{valor2}')
def resta(valor1,valor2):    
    try:
        return{'resultado' : int(valor1)-int(valor2)}
    except:
        return{'error' : 'Los parametros deben de ser numero enteros no decimales ni caracteres'}

@app.get('/multiplicacion/{valor1}/{valor2}')
def multiplicacion(valor1,valor2):    
    try:
        return{'resultado' : int(valor1)*int(valor2)}
    except:
        return{'error' : 'Los parametros deben de ser numero enteros no decimales ni caracteres'}

@app.get('/division/{valor1}/{valor2}')
def division(valor1,valor2):    
    try:
        return{'resultado' : int(valor1)/int(valor2)}
    except:
        return{'error' : 'Los parametros deben de ser numero enteros no decimales ni caracteres'}            