<?php
    header('Content-Type: text/plain');
    include("commonfunctions.php");
    $file = file("../../irpg.db");
    $header = explode("\t",$file[0]);
    unset($header[1]);
    unset($header[5]);
    echo join("\t",$header);
    unset($file[0]);
    if ($_GET['player']) {
        foreach ($file as $line) {
            list($user) = explode("\t",trim($line));
            if ($user == $_GET['player']) {
                list($user,
                     ,$level,$class,$secs,,$uhost,$online,$idled,
                     $pen['mesg'],
                     $pen['nick'],
                     $pen['part'],
                     $pen['kick'],
                     $pen['quit'],
                     $pen['quest'],
                     $pen['logout'],
                     $created,
                     $lastlogin,
                     $item['amulet'],
                     $item['charm'],
                     $item['helm'],
                     $item['boots'],
                     $item['gloves'],
                     $item['ring'],
                     $item['leggings'],
                     $item['shield'],
                     $item['tunic'],
                     $item['weapon'],
                    ) = explode("\t",trim($line));
                echo join("\t",
                          array($user,$level,$class,$secs,$uhost,$online,$idled,
                                $pen['mesg'],
                                $pen['nick'],
                                $pen['part'],
                                $pen['kick'],
                                $pen['quit'],
                                $pen['quest'],
                                $pen['logout'],
                                $created,
                                $lastlogin,
                                $item['amulet'],
                                $item['charm'],
                                $item['helm'],
                                $item['boots'],
                                $item['gloves'],
                                $item['ring'],
                                $item['leggings'],
                                $item['shield'],
                                $item['tunic'],
                                $item['weapon']))."\n";
            }
        }
        exit(0);
    }
    usort($file,"cmp_level_desc");
    foreach ($file as $line) {
        list($user,
             ,$level,$class,$secs,,$uhost,$online,$idled,
             $pen['mesg'],
             $pen['nick'],
             $pen['part'],
             $pen['kick'],
             $pen['quit'],
             $pen['quest'],
             $pen['logout'],
             $created,
             $lastlogin,
             $item['amulet'],
             $item['charm'],
             $item['helm'],
             $item['boots'],
             $item['gloves'],
             $item['ring'],
             $item['leggings'],
             $item['shield'],
             $item['tunic'],
             $item['weapon'],
            ) = explode("\t",trim($line));
        echo join("\t",
             array($user,$level,$class,$secs,$uhost,$online,$idled,
             $pen['mesg'],
             $pen['nick'],
             $pen['part'],
             $pen['kick'],
             $pen['quit'],
             $pen['quest'],
             $pen['logout'],
             $created,
             $lastlogin,
             $item['amulet'],
             $item['charm'],
             $item['helm'],
             $item['boots'],
             $item['gloves'],
             $item['ring'],
             $item['leggings'],
             $item['shield'],
             $item['tunic'],
             $item['weapon']))."\n";
    }
?>
