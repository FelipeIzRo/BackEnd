from kafka import KafkaProducer,KafkaConsumer
import json
from flask import Flask
from threading import Thread


app = Flask(__name__)

#Simulacion de Almacen
productos=[
    {"id": 1,"name": "Producto_1","price": 10.99, "cantidad":5},
    {"id": 2,"name": "Producto_2","price": 1.50, "cantidad":10},
    {"id": 3,"name": "Producto_3","price": 5.10, "cantidad":30}
]

mensaje_transaccion=[{"transaccion":"Realizada con exito"},{"transaccion":"Fallida"}]

# Configura la dirección del servidor Kafka
bootstrap_servers = ['localhost:9093']
def RecibirMensaje():
    # Crea un consumidor Kafka con deserializador JSON
    consumer = KafkaConsumer(
        'mi_tema',
        group_id='my_group',
        bootstrap_servers=bootstrap_servers,
        value_deserializer=lambda x: json.loads(x.decode('utf-8'))  # Deserializa el mensaje JSON
    )
    
        # Se queda en un bucle para escuchar mensajes
    for message in consumer:
        for diccionario in message.value:            
            for producto in productos:
                if producto["id"] == diccionario["id"]:                                                            
                    if producto["cantidad"] >= diccionario["cantidad"]:
                        producto["cantidad"] -= diccionario["cantidad"]

                        ultimo_mensaje=EnviarMensaje(numero=0)                    
                        print(f"Actualizado: {producto}")
                        print("Hay stock")
                    else:
                        ultimo_mensaje=EnviarMensaje(numero=1)
                        print(f"No hay stock{producto}")                      
    # Cierra el consumidor Kafka
    consumer.close()    
    return ultimo_mensaje

def EnviarMensaje(numero):
    producer = KafkaProducer(
        bootstrap_servers=bootstrap_servers,
        value_serializer=lambda x: json.dumps(x).encode('utf-8')  # Serializa el mensaje JSON
    )
    producer.send('respuesta_transaccion', value=mensaje_transaccion[numero])    
    producer.close()
    return mensaje_transaccion[numero]


@app.route('/')
def index():           
    return productos

@app.route('/stock')
def stock():
    return productos

if __name__ == "__main__":
    kafka_thread = Thread(target=RecibirMensaje)
    kafka_thread.daemon = True
    kafka_thread.start()
    app.run(host='0.0.0.0', port=5001)
