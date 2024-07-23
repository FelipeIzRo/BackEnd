from kafka import KafkaProducer,KafkaConsumer
import json
import time
from flask import Flask
from threading import Thread

app = Flask(__name__)


productos=[
    {"id": 1,"name": "Producto_1","price": 10.99, "cantidad":5},
    {"id": 2,"name": "Producto_2","price": 1.50, "cantidad":10},
    {"id": 3,"name": "Producto_3","price": 5.10, "cantidad":30},
    {"id": 4,"name": "Producto_4","price": 15.10, "cantidad":20},
    {"id": 5,"name": "Producto_5","price": 12.60, "cantidad":8}
]
mensaje_transaccion=[{"codigo_transaccion": 0 ,"mensaje":"Realizada con exito"},
                     {"codigo_transaccion": 1,"mensaje":"Fallida"}]

# Configura la dirección del servidor Kafka
bootstrap_servers = ['localhost:9093']

def RecibirMensaje():
    consumer = KafkaConsumer(
        'stock',
        group_id='my_group',
        bootstrap_servers=bootstrap_servers,
        value_deserializer=lambda x: json.loads(x.decode('utf-8'))  # Deserializa el mensaje JSON
    )
    print("LeyendoMensajes")
    
    listaitems=[]
    transaccion = True
    for i,message in enumerate(consumer):
        #es_ultimo = (i == len(message.value) - 1)
        print(message.value)
        print(ComprobarStock(message.value))
        if ComprobarStock(message.value):
            RestarStock(message.value)

            
            
    # consumer.close()
def ComprobarStock(listaItems):
    for producto in productos:
        for item in listaItems:
            if producto["id"] == int(item["id"]):
                if producto["cantidad"] < int(item["cantidad"]):
                    EnviarMensaje(codigo=1)
                    return False
    return True
def RestarStock(listaitems):
    print('restar stock')
    for producto in productos:
        for items in listaitems:
            if producto["id"] == int(items["id"]):
                producto["cantidad"] -= int(items["cantidad"])
    EnviarMensaje(codigo=0)

def EnviarMensaje(codigo):
    producer = KafkaProducer(
        bootstrap_servers=bootstrap_servers,
        value_serializer=lambda x: json.dumps(x).encode('utf-8')  # Serializa el mensaje JSON
    )
    producer.send('confirmacion_stock', value=mensaje_transaccion[codigo])    
    producer.close()

@app.route('/')
def index():
    return productos


if __name__ == "__main__":
    kafka_thread = Thread(target=RecibirMensaje)
    kafka_thread.daemon = True
    kafka_thread.start()
    app.run(host='0.0.0.0', port=5001)