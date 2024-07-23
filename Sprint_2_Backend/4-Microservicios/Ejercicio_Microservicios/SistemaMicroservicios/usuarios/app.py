from flask import Flask, request, jsonify
from flask_cors import CORS  # Importa la extensión Flask-CORS
import requests
import json

app = Flask(__name__)
CORS(app)  # Habilita CORS para todas las rutas de la aplicación

# Simulación de base de datos de usuarios
# users = {
#     "user1": "password1",
#     "user2": "password2"
# }

USER_SERVICE_URL = "http://localhost:5004"


@app.route('/login', methods=['POST'])
def login():
    print('Endpoint de Loging Usuarios')
    data = request.get_json()
    username = data.get('username')
    password = data.get('password')
    print(data)
    response = requests.post(f"{USER_SERVICE_URL}/login", json=data)
    print(response.text)

    json_response = response.json()
    
    if json_response:
        return jsonify({"valid": True}), 200
    else:
        return jsonify({"valid": False}), 200


if __name__ == '__main__':
    #Probar en docker y en pc este caso
    app.run(host='0.0.0.0', port=5000, debug=True)