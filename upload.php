<?php
    /* upload.php
     * Allows a remote bot to upload the database files so the web works on a different system
     * Additional configuration required, $irpg_api to be filled in.
     * 
     * Just uses the following command from command line on cron or something
     * - wget --post-file=original.file.name "http://nic-web01/idlerpg-web/upload.php?api=75d59b8e08bcf53a937afec48c1b80d6&file=db" -O output.log
     */

    include("include/config.php");

    $DATA = file_get_contents("php://input");

    if ($DATA == '') {
        die('ERROR No file uploaded.' . PHP_EOL);
    } elseif (!isset($_GET['api']) || !isset($_GET['file'])) {
        die('ERROR No api/file data included in package.' . PHP_EOL);
    } elseif ($_GET['api'] != $_CONFIG['api_key']) {
        die('ERROR Invalid api key.' . PHP_EOL);
    } elseif (strpos('db mod qfile', $_GET['file']) === false) {
        die('ERROR Invalid file type.' . PHP_EOL);
    } else {
        $FILE = ($_GET['file'] == 'db' ? $_CONFIG['file_db'] : ($_GET['file'] == 'mod' ? $_CONFIG['file_mod'] : ($_GET['file'] == 'qfile' ? $_CONFIG['file_quest'] : '/dev/null')));

        file_put_contents($FILE, $DATA);

        die('SUCCESS');
    }

    
/* debug only
    echo '--------------------------------------------------------'.PHP_EOL;
    echo '  api = '. $irpg_api . PHP_EOL;
    echo '   db = '. $irpg_db . PHP_EOL;
    echo '  mod = '. $irpg_mod . PHP_EOL;
    echo 'qfile = '. $irpg_qfile . PHP_EOL;
    echo ' path = '. $FILE . PHP_EOL;
    echo PHP_EOL;
    echo '|'.$DATA.'|';
    echo '--------------------------------------------------------'.PHP_EOL;
*/
    ?>
