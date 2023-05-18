# 📝 RESUMEN DE LA APLICACION WEB

## 📋 DATOS GENERALES

<ul>
  <li><b>Nombre:</b> 🕹️ API de servicios ISP</li>
  <li><b>Cliente:</b> 🦷 Xavier Bermeo</li>
  <li><b>Fecha de inicio:</b> 📅 18/05/2023</li>
  <li><b>Fecha de entrega:</b> 📅 --/05/2023</li>
  <li><b>Estado:</b> 🚧 En desarrollo</li>
  <li><b>Version:</b> 🚀 1.0.0</li>
</ul>

## 📋 DESCRIPCION

<p>
  Nuestra API de servicios de ISP, desarrollada por Ideasoft, ofrece una solución centralizada para gestionar los procesos internos y compartir servicios de internet en distintos aplicativos. Esta API proporciona funciones y endpoints para administrar la configuración de los servicios, gestionar cuentas de usuario, obtener información de uso y consumo, realizar pagos y facturación, entre otras funcionalidades.
  <br><br>
  Con nuestra API, los desarrolladores pueden integrar de manera sencilla los servicios de internet de nuestro ISP en sus aplicaciones, mejorando la eficiencia y reutilizando funcionalidades existentes. Al unificar los procesos internos, facilitamos el desarrollo de aplicativos personalizados y optimizamos la calidad y consistencia de los servicios.
  <br><br>
  Nuestra API de servicios de ISP de Ideasoft es una herramienta poderosa que permite una integración eficiente y escalable de los servicios de internet en aplicaciones diversas. Simplificamos los procesos internos y ofrecemos una experiencia fluida para nuestros clientes y usuarios finales.
  <br><br>
  Simplifica el desarrollo de aplicaciones con nuestra API de servicios de ISP de Ideasoft y maximiza el valor de los servicios de internet para tus usuarios.
</p>

## 📝 LICENCIA

<p>
  MIT License
  <br><br>
  Derechos de autor (c) 2023 Ideasoft
  <br><br>
  Se concede permiso, de forma gratuita, a cualquier persona que obtenga una copia de este software y los archivos de documentación asociados (el "Software"), para utilizar el Software sin restricciones, incluyendo, entre otras, las siguientes acciones:
  <br>
  - Utilizar, copiar, modificar, fusionar, publicar, distribuir, sublicenciar y/o vender copias del Software.
  - Permitir a las que se les proporcione el Software hacer lo mismo, de acuerdo con las condiciones establecidas en esta licencia.
  <br><br>
  El propietario del código fuente de este software es Ideasoft. Si bien esta versión específica del software es propiedad de Ideasoft, se permite utilizar el código fuente para otros propósitos sin restricciones, siempre y cuando se cumplan los términos de esta licencia.
  <br><br>
  EL SOFTWARE SE PROPORCIONA "TAL CUAL", SIN GARANTÍA DE NINGÚN TIPO, EXPRESA O IMPLÍCITA, INCLUYENDO PERO NO LIMITADO A GARANTÍAS DE COMERCIABILIDAD, ADECUACIÓN PARA UN PROPÓSITO PARTICULAR Y NO INFRACCIÓN. EN NINGÚN CASO LOS AUTORES O PROPIETARIOS DEL COPYRIGHT SERÁN RESPONSABLES DE NINGÚN RECLAMO, DAÑO U OTRA RESPONSABILIDAD, YA SEA EN UNA ACCIÓN DE CONTRATO, AGRAVIO O CUALQUIER OTRO MOTIVO, DERIVADO DE, FUERA DE O EN RELACIÓN CON EL SOFTWARE O EL USO U OTROS TRATOS EN EL SOFTWARE.
</p>

# 📦 DOCUMENTACION DE INSTALACION

## 📄 VARIABLES DE ENTORNO

Crea el archivo <b><i>.env</i></b> en la raiz del proyecto y configuralo

```env
  # PROJECT
  HTTP_DOMAIN = {{YOUR_DOMAIN}}
  APP_NAME = {{YOUR_APP_NAME}}

  # MYSQLI
  DB_HOST = {{YOUR_DB_HOST}}
  DB_USER = {{YOUR_DB_USER}}
  DB_PASS = {{YOUR_DB_PASS}}
  DB_NAME = {{YOUR_DB_NAME}}
  DB_PORT =  {{YOUR_DB_PORT}}

  # MIKROWISP
  MKW_API_VERSION = {{YOUR_MIKROWISP_VERSION}} # Esta diseñado para la version 5 y 6 de la MIKROWISP
  MKW_API_URL = {{YOUR_MIKROWISP_URL}}
  MKW_API_USER = {{YOUR_MIKROWISP_USER}} # si la version de la API es 6, este campo no es necesario
  MKW_API_PASS = {{YOUR_MIKROWISP_PASS}} # Si la version de la API es 6, este campo es el token
```

## 🐬 MYSQL

Crea la base de datos

```sql
  CREATE DATABASE {{YOUR_DB_NAME}};
```

-   Asegurate de que el nombre de la base de datos sea el mismo que el que usas en el archivo .env
-   Si estas en CPANEL tendras que crearla con ayuda de la interfaz grafica.

### 🛠 CONFIGURACION

Luego puedes usar el servicio de configuración para crear las tablas y los datos inciales:

```http
  {{YOUR_DOMAIN}}/service/configuration
```

para generar la base de datos y las tablas.
Luego es importante que desabilites el servicio de configuración para que no se sobreescriban los datos.

## 🪶 APACHE

Crea el archivo <b><i>.htaccess</i></b> en la raiz del proyecto y configuralo

```htaccess
  RewriteEngine On
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule . index.php [L]

  # Denegar el acceso a los directorios
  Options -Indexes

  <FilesMatch "\.(php|html?)$">
    Order Deny,Allow
    Deny from all
  </FilesMatch>
  <Files "index.php">
    Order Allow,Deny
    Allow from all
  </Files>
```

#### 🛠 En caso de que tu proyecto ya este funcionando con un dominio y quieras usar _https_, puedes agregar esta configuracion en _htaccess_

```htaccess
  RewriteEngine On
  RewriteCond %{HTTPS} !=on
  RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301,NE]
  Header always set Content-Security-Policy "upgrade-insecure-requests;"
```

## 🚪 LOGIN

Para abrir el login puedes presionar la combinacion de teclas " <b><i>CTRL + .</i></b> " o puedes ir a la siguiente ruta

```http
  {{YOUR_DOMAIN}}/panel/login
```

Para iniciar sesion por primera vez usa los siguientes credenciales

```txt
  USUARIO: admin
  CONTRASEÑA: admin
```
