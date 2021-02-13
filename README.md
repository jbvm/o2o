# o2o
Prueba técnica O2O

Para la realización de la prueba se ha configurado el siguiente VirtualHost:

```
<VirtualHost *:80>
  ServerName pruebas_symfony4.com  
  ServerAlias www.pruebas_symfony4.com  
  DocumentRoot "${INSTALL_DIR}/www/symfony/pruebas_symfony4/public"  
  <Directory "${INSTALL_DIR}/www/symfony/pruebas_symfony4/public">  
    Options +Indexes +Includes +FollowSymLinks +MultiViews    
    AllowOverride All    
    Require local    
  </Directory>  
</VirtualHost>
```

Luego en el host añadimos la linea:

```
127.0.0.1 pruebas_symfony4.com
```

En el fichero config/routes.yaml tenemos las dos rutas siguientes:

1ª) buscar-receta 
Permite peticiones tanto GET como POST
Petición Get de ejemplo: http://pruebas_symfony4.com/receta/buscar/{food}
    Siendo {food} la cadena por la que se quiere buscar. Ejemplo: http://pruebas_symfony4.com/receta/buscar/prueba
Petición Post de ejemplo: http://pruebas_symfony4.com/receta/buscar y en el request que venga un campo food que contenga la cadena a buscar

2ª) get-receta
Sólo permite peticiones GET
Petición Get de ejemplo: http://pruebas_symfony4.com/receta/{id}
    Siendo {id} el identificador de la receta que se quiere mostrar. Ejemplo: http://pruebas_symfony4.com/receta/5
    
Se han creado dos servicios:

1º) ConectorApi para obtener los datos de la Api consultada

2º) ConvertArray para el tratamiento de arrays. En nuestro caso lo usamos para que a partir de un array de entrada 
nos devuelva un array de sálida con los indices del array que nos interesa devolver 
