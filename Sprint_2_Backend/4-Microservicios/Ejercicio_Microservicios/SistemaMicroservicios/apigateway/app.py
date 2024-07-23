from flask import Flask, request, jsonify
from flask_cors import CORS  # Importa la extensión Flask-CORS
import requests

app = Flask(__name__)
CORS(app)  # Habilita CORS para todas las rutas de la aplicación

USER_SERVICE_URL = "http://localhost:5000"

@app.route('/login', methods=['POST'])  # Asegúrate de que la ruta sea para POST
def login():
    try:
        print('Endpoint de Loging API')
        data = request.get_json()
        print(data)
        response = requests.post(f"{USER_SERVICE_URL}/login", json=data)
        return jsonify(response.json()), response.status_code
    except Exception as e:
        return {"Error en usuarios": str(e)}

if __name__ == '__main__':
    #Probar PC
    app.run(host='0.0.0.0', port=5002, debug=True)
    #Probar en docker
    #app.run(host='0.0.0.0', port=5000, debug=True)
