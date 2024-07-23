from flask import Flask,render_template, request,jsonify
import requests
from flask_mysqldb import MySQL
import MySQLdb.cursors

app = Flask(__name__)
 
#Docker
# app.config['MYSQL_HOST'] = 'mysql'
# app.config['MYSQL_USER'] = 'root'
# app.config['MYSQL_PASSWORD'] = 'password'
# app.config['MYSQL_DB'] = 'tienda_online'

#PC
app.config['MYSQL_HOST'] = '127.0.0.1'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = 'root'
app.config['MYSQL_DB'] = 'tienda_online'



mysql = MySQL(app)

@app.route('/login',methods=['POST'])
def index():
    print('Endpoint de Loging GestorBBDD')
    # Conexión a la base de datos
    cursor = mysql.connection.cursor()

    # Obtener los parámetros de usuario y contraseña de la solicitud GET
    data = request.get_json()
    username = data.get('username')
    password = data.get('password')

    print(username)
    print(password)
    # Ejecutar la consulta SELECT (utilizando parámetros para evitar la inyección de SQL)
    cursor.execute("SELECT id FROM usuarios WHERE user = %s AND password = %s", (username, password))

    # Obtener los resultados de la consulta
    results = cursor.fetchall()

    # Convertir los resultados en un formato JSON
    data = []
    for row in results:
        data.append({
            'id': row[0]
        })

    # Cerrar la conexión a la base de datos
    cursor.close()    

    print(data)
    # Devolver los resultados como JSON
    return jsonify(data)

if __name__ == '__main__':    
    #Probar en PC
    app.run(host='0.0.0.0', port=5004, debug=True)
    #Probar en docker
    #app.run(host='0.0.0.0', port=5000, debug=True)