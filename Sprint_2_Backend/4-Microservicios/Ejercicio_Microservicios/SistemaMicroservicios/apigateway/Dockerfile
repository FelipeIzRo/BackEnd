# Utiliza una imagen base de Python
FROM python:3.9-slim

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /app

# Copia los archivos de requerimientos (dependencias)
COPY requirements.txt .

# Instala las dependencias
RUN pip install --no-cache-dir -r requirements.txt

# Copia el código fuente a la imagen
COPY . .

# Expone el puerto en el contenedor
EXPOSE 5000

# Comando para ejecutar la aplicación
CMD ["python", "app.py"]
