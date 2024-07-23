from flask import Flask, render_template, request, Response
from flask_mysqldb import MySQL
import MySQLdb.cursors
from prometheus_client import start_http_server, Counter
import prometheus_client

app = Flask(__name__)


app.config['MYSQL_HOST'] = 'mysql'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = 'password'
app.config['MYSQL_DB'] = 'todo_app'
mysql = MySQL(app)


tasks_counter_index = Counter(
    'tasks_counter_index', 'Total de veces que se ejecuta la funcion index'
)
tasks_counter_add = Counter(
    'tasks_counter_add', 'Total de veces que se ejecuta la funcion add'
)
tasks_counter_delete = Counter(
    'tasks_counter_delete', 'Total de veces que se ejecuta la funcion delete'
)

@app.route('/')
def index():

    tasks_counter_index.inc()

    cursor = mysql.connection.cursor()
    cursor.execute('''CREATE TABLE IF NOT EXISTS tasks(ID BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(512))''')
    mysql.connection.commit()
    cursor.close()

    cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
    cursor.execute('''SELECT * FROM tasks''')
    tasks = cursor.fetchall()
    cursor.close()

    return render_template('index.html', tasks=tasks, len=len(tasks))

@app.route('/add', methods=['POST', 'GET'])
def add():

    tasks_counter_add.inc()

    if request.method == 'GET':
        return index()

    task = request.form['title']
    cursor = mysql.connection.cursor()
    cursor.execute('''INSERT INTO tasks(name) VALUES(%s)''', (task,))
    mysql.connection.commit()
    cursor.close()
    return index()

@app.route('/delete/<int:id>')
def delete(id):

    tasks_counter_delete.inc()

    cursor = mysql.connection.cursor()
    cursor.execute('''DELETE FROM tasks WHERE ID = %s''', (id,))
    mysql.connection.commit()
    cursor.close()
    return index()

@app.route('/metrics')
def metrics():
    return Response(prometheus_client.generate_latest(), mimetype='text/plain')

if __name__ == '__main__':
    print("INICIO DE PROGRAMA")
    try:
        app.run()
    except:
        print("Error al iniciar la aplicacion")
    print("FIN DE PROGRAMA")
