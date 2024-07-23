from kafka import KafkaProducer,KafkaConsumer
import json
from flask import Flask, request, jsonify, render_template
from threading import Thread

app = Flask(__name__)

# Configura la dirección del servidor Kafka
bootstrap_servers = ['localhost:9093']

def EnviarMensaje(pedido):
# Crea un productor Kafka con serializador JSON
    producer = KafkaProducer(
        bootstrap_servers=bootstrap_servers,
        value_serializer=lambda x: json.dumps(x).encode('utf-8')  # Serializa el mensaje JSON
    )
    try:
        
        # Envía el mensaje al tema
        producer.send('pedidos', value=pedido)
        
        print(f"Mensaje enviado: {pedido}")

    except KeyboardInterrupt:
        # Ctrl+C para detener la ejecución
        pass
    finally:
        # Cierra el productor Kafka
        producer.close()  
        return pedido
    
def quitar_cero_cantidad(lista_productos):
    return [producto for producto in lista_productos if int(producto['cantidad']) > 0]
@app.route('/')
def home():
    return render_template('index.html')

@app.route('/pedido', methods=['POST'])
def recibir_pedido():
    pedido = request.json
    # Aquí puedes procesar el pedido, verificar stock, etc.
    print(pedido)
    return EnviarMensaje(quitar_cero_cantidad(pedido))#jsonify({"mensaje": "Pedido recibido", "data": pedido}))

if __name__ == "__main__":
    app.run(host='0.0.0.0', port=5002)