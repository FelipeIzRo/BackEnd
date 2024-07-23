# Utiliza una imagen base de Apache HTTP Server
FROM httpd:2.4

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /usr/local/apache2/htdocs

# Copia los archivos del frontend al directorio de trabajo en el contenedor
COPY . .

COPY ./html /usr/local/apache2/htdocs
# Exponer el puerto 80 para el servidor Apache
EXPOSE 80
