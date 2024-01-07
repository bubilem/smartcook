<?php
error_reporting(E_ALL);
mb_internal_encoding("UTF-8");
require_once('conf.php');
require_once(DIR_APP . 'utils/Loader.php');
spl_autoload_register('Loader::loadClass');

try {
    Router::route();
} catch (Exception $e) {
    echo (string) (new ResponseModel)
        ->set('stat', 'fail')
        ->set('mess', $e->getMessage());
}
