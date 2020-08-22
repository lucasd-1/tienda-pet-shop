<!--Crear un archivo `env.php` en el root con el siguiente contenido -->
<!--reemplazando los valores de las variables por los correspondientes para cada ambiente-->

<?php
$variables = [
    'BASE_PATH' => 'http://localhost/tienda-pet-shop',
    'DB_HOST' => 'localhost',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',
    'DB_NAME' => 'tienda_master',
    'DB_PORT' => '3306'
];

foreach ($variables as $key => $value) {
    putenv("$key=$value");
}
?>