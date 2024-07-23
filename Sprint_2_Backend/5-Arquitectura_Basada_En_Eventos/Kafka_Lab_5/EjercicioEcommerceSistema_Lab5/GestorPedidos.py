from kafka import KafkaProducer,KafkaConsumer
import json
import time
from flask import Flask

app = Flask(__name__)

# Configura la dirección del servidor Kafka
bootstrap_servers = ['localhost:9093']

topic = 'mi_tema'

def EnviarMensaje():
# Crea un productor Kafka con serializador JSON
    producer = KafkaProducer(
        bootstrap_servers=bootstrap_servers,
        value_serializer=lambda x: json.dumps(x).encode('utf-8')  # Serializa el mensaje JSON
    )
    try:

        # Mensaje a enviar
        message = [{"id": 2, "cantidad": 6}]
        
        # Envía el mensaje al tema
        producer.send(topic, value=message)
        
        print(f"Mensaje enviado: {message}")
        
        RecibirMensaje()

        # Espera un segundo antes de enviar el próximo mensaje
        time.sleep(3)
        
        print("FIN DE PROGRAMA")
    except KeyboardInterrupt:
        # Ctrl+C para detener la ejecución
        pass
    finally:
        # Cierra el productor Kafka
        producer.close()  
        return message

def RecibirMensaje():
    consumer = KafkaConsumer(
        'respuesta_transaccion',
        group_id='my_group',
        bootstrap_servers=bootstrap_servers,
        value_deserializer=lambda x: json.loads(x.decode('utf-8'))  # Deserializa el mensaje JSON
    )
    consumer.close()

# Define el tema al que se enviarán los mensajes



@app.route('/')
def index():
    return EnviarMensaje()

if __name__ == "__main__":
    app.run(host='0.0.0.0', port=5002)