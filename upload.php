<?php
    /* upload.php
     * Allows a remote bot to upload the database files so the web works on a different system
     * Additional configuration required, $irpg_api to be filled in.
     */

    include("config.php");

    $DATA = file_get_contents("php://input");

    if ($DATA == '') {
        die('ERROR No file uploaded.' . PHP_EOL);
    } elseif (!isset($_GET['api']) || !isset($_GET['file'])) {
        die('ERROR No api/file data included in package.' . PHP_EOL);
    } elseif ($_GET['api'] != $irpg_api) {
        die('ERROR Invalid api key.' . PHP_EOL);
    } elseif (strpos('db mod qfile', $_GET['file']) === false) {
        die('ERROR Invalid file type.' . PHP_EOL);
    } else {
        $FILE = ($_GET['file'] == 'db' ? $irpg_db : ($_GET['file'] == 'mod' ? $irpg_mod : ($_GET['file'] == 'qfile' ? $irpg_qfile : '/dev/null')));

        file_put_contents($FILE, $DATA);
    }

    
// /* debug only
    echo '--------------------------------------------------------'.PHP_EOL;
    echo '  api = '. $irpg_api . PHP_EOL;
    echo '   db = '. $irpg_db . PHP_EOL;
    echo '  mod = '. $irpg_mod . PHP_EOL;
    echo 'qfile = '. $irpg_qfile . PHP_EOL;
    echo ' path = '. $FILE . PHP_EOL;
    echo PHP_EOL;
    echo '|'.$DATA.'|';
    echo '--------------------------------------------------------'.PHP_EOL;
// */
    ?>
