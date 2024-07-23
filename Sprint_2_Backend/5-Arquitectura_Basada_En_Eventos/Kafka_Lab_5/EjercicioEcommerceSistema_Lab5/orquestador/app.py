from kafka import KafkaProducer,KafkaConsumer
import json
from flask import Flask
from threading import Thread

app = Flask(__name__)

# Configura la dirección del servidor Kafka
bootstrap_servers = ['localhost:9093']

cod=[2]
mensaje_transaccion=[{"codigo_transaccion": 0 ,"mensaje":"Realizada con exito"},
                     {"codigo_transaccion": 1,"mensaje":"Fallida"},
                     {"codigo_transaccion": 2,"mensaje":"Transaccion sin realizar"}
                     ]

def RecibirGestorPedidos():
    topicPedido = "pedidos"
    
    consumerPedido = KafkaConsumer(
        topicPedido,
        group_id='my_group',
        bootstrap_servers=bootstrap_servers,
        value_deserializer=lambda x: json.loads(x.decode('utf-8'))  # Deserializa el mensaje JSON
    )
    print("Primer for para consumerPedido")
    for message in consumerPedido:
        for dicc in message.value:
            ConfirmarStock(message.value)


def RecibirConfirmacionStock():
    topicStock = "confirmacion_stock"

    consumerStock = KafkaConsumer(
        topicStock,
        group_id='my_group',
        bootstrap_servers=bootstrap_servers,
        value_deserializer=lambda x: json.loads(x.decode('utf-8'))  # Deserializa el mensaje JSON
    )
    
    print("Segundo for para consumerStock")
    for message in consumerStock:
        print(message.value)
        ConfirmarUsuario(message.value)
        cod[0]=message.value['codigo_transaccion']
def ConfirmarStock(message):
    try:
        topicStock='stock'

        producer = KafkaProducer(
            bootstrap_servers=bootstrap_servers,
            value_serializer=lambda x: json.dumps(x).encode('utf-8')  # Serializa el mensaje JSON
        )

        producer.send(topicStock, value=message)
    except KeyboardInterrupt:
        # Ctrl+C para detener la ejecución
        pass
    finally:
        # Cierra el productor Kafka
        producer.close()

def ConfirmarUsuario(message):
    try:
        topicStock='confirmar_usuario'

        producer = KafkaProducer(
            bootstrap_servers=bootstrap_servers,
            value_serializer=lambda x: json.dumps(x).encode('utf-8')  # Serializa el mensaje JSON
        )

        producer.send(topicStock, value=message)
    except KeyboardInterrupt:
        # Ctrl+C para detener la ejecución
        pass
    finally:
        # Cierra el productor Kafka
        producer.close()

def RecibirOrden():
    topicPedido = "pedido_usuario"
    
    print("Pedido de usuario")
    consumerPedido = KafkaConsumer(
        topicPedido,
        group_id='my_group',
        bootstrap_servers=bootstrap_servers,
        value_deserializer=lambda x: json.loads(x.decode('utf-8'))  # Deserializa el mensaje JSON
    )
    print("Tercer for para recibirOrden")
    for message in consumerPedido:
        for dicc in message.value:
            ConfirmarStock(message.value)

@app.route('/')
def index():     
    return mensaje_transaccion[cod[0]]

if __name__ == "__main__":
    kafka_thread_pedidos = Thread(target=RecibirGestorPedidos)
    kafka_thread_pedidos.daemon = True

    kafka_thread_stock = Thread(target=RecibirConfirmacionStock)
    kafka_thread_stock.daemon = True

    kafka_thread_orden = Thread(target=RecibirOrden)
    kafka_thread_orden .daemon = True

    kafka_thread_pedidos.start()
    kafka_thread_stock.start()
    kafka_thread_orden.start()
    app.run(host='0.0.0.0', port=5003)