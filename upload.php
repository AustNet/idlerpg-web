<?php
    /* upload.php
     * Allows a remote bot to upload the database files so the web works on a different system
     * Additional configuration required, $irpg_api to be filled in.
     * 
     * Just uses the following command from command line on cron or something
     * - wget --post-file=original.file.name "http://nic-web01/idlerpg-web/upload.php?api=75d59b8e08bcf53a937afec48c1b80d6&file=db" -O output.log
     */

    include("include/config.php");
    include('include/idlerpg.php');

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
        // check which file we are writing to and write it (legacy)
        $FILE = ($_GET['file'] == 'db' ? $_CONFIG['file_db'] : ($_GET['file'] == 'mod' ? $_CONFIG['file_mod'] : ($_GET['file'] == 'qfile' ? $_CONFIG['file_quest'] : '/dev/null')));
        file_put_contents($FILE, $DATA);

        if ($_GET['file'] == 'db') {
            $QUERY_USER = $_CONFIG['db']->prepare('INSERT INTO irpg_users (username, pass, is_admin, level, class, next_ttl, nick, userhost, online, idled, x_pos, y_pos, created, last_login, alignment, updated) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');
            $QUERY_PENALTIES = $_CONFIG['db']->prepare('INSERT INTO irpg_penalties');
            $QUERY_ITEMS = '';
    
            // convert the uploaded tsv to array
            $USERS = tsv_to_array($DATA);
    
            // loop through all user entries and write to the database
            foreach ($USERS as $USER) {
                try {
                    echo $QUERY_USER->execute(array($USER['username'], $USER['pass'], $USER['is_admin'], $USER['level'], $USER['class'], $USER['next_ttl'], $USER['nick'], $USER['userhost'], $USER['online'], $USER['idled'], $USER['x_pos'], $USER['y_pos'], gmdate("Y-m-d H:i:s", $USER['created']), gmdate("Y-m-d H:i:s", $USER['last_login']), $USER['alignment']));
                } catch (PDOException $e) {
                    echo 'ERROR: '. $e->getMessage() . PHP_EOL;
                }
                //print_r($INFO);
                
            }
            // parse it out to lines + tab-delim fields
            // chuck it all into the database
    
            die('SUCCESS');
            
        } elseif ($_GET['file'] == 'mod') {

        } elseif ($_GET['file'] == 'qfile') {

        }


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
