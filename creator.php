<?php

define('B', PHP_EOL);
define('D', DIRECTORY_SEPARATOR);

define('API_DIR', dirname(__FILE__).D.'api'.D);
define('VALID_TYPES', array('controller', 'middleware', 'class'));

function help() {
    echo "--------------------------------------------------------------------".B;
    echo "    Usage of the creator: ".B;
    echo "    - php creator.php create <type>* <name>".B;
    echo "       * where <type> can be one of [".implode(", ", VALID_TYPES)."]".B;
}

function create($type, $name) {
    if (empty($type) || empty($name)) throw new Error("Some parameters were not inputted");   
    if (!in_array($type, VALID_TYPES)) throw new Error('Not a valid type');

    $lookup = array(
        'controller' => 'controllers',
        'middleware' => 'middlewares',
        'class' => 'classes',
    );

    $plural = $lookup[$type];
    $fileName = ucfirst($name) . ucfirst(($type == 'class') ? 'model' : $type);

    $extendsOrImplements = array(
        'controller' => 'extends BaseController',
        'middleware' => 'implements ItMiddleware',
        'class' => 'extends BaseModel',
    );
    $extendsOrImplementsText = $extendsOrImplements[$type];

    file_put_contents(API_DIR.$plural.D.$fileName.".php", "<?php
    
class $fileName $extendsOrImplementsText {}");
}

if ($argc <= 1) {
    die(help());
}

try {
    $operation = isset($argv[1]) ? strtolower($argv[1]) : '';

    if ($operation === 'help') die(help());
    $type = isset($argv[2]) ? trim(strtolower($argv[2])) : '';
    $name = isset($argv[3]) ? trim(strtolower($argv[3])) : '';

    if ($operation === 'create') {
        create($type, $name);
    }

} catch (Error $er) {
    echo $er->getMessage().B;
}


