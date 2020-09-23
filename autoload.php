<?php

if(file_exists('./env.php')) {
    include './env.php';
}

if(!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        return $value;
    }
}
 
function controllers_autoload($classname){
    require_once __DIR__.'/controllers/' . $classname . '.php';
}

spl_autoload_register('controllers_autoload');
