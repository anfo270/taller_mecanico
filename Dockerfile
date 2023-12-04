# Usa una imagen base con Nginx
FROM nginx:alpine

# Elimina el archivo de configuración predeterminado de Nginx
RUN rm /etc/nginx/conf.d/default.conf

# Copia los archivos de la aplicación web al directorio de Nginx
COPY . /usr/share/nginx/html

# Puerto en el que escuchará Nginx
EXPOSE 80

# Comando para iniciar Nginx
CMD ["nginx", "-g", "daemon off;"]
