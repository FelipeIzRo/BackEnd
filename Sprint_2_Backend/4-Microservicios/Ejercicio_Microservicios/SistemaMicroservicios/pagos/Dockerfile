# Dockerfile para servicio de pagos
FROM node:14

WORKDIR /usr/src/app

# Copiar package.json y package-lock.json
COPY package*.json ./

# Instalar dependencias
RUN npm install

# Copiar el resto de los archivos de la aplicación
COPY . .

# Puerto expuesto por la aplicación
EXPOSE 3000

# Comando para iniciar la aplicación
CMD ["node", "server.js"]

