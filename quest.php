<?php
    include("config.php");
    echo('<html><head><title>'.$irpg_chan.' Idle RPG: Quest Info</title>');
    include("header.php");
    include("commonfunctions.php");
    $file = fopen($irpg_qfile,"r");
    $type=0;
    while ($line=fgets($file)) {
        $arg = explode(" ",trim($line));
        if ($arg[0] == "T") {
            unset($arg[0]);
            $text = implode(" ",$arg);
        }
        elseif ($arg[0] == "Y") {
            $type = $arg[1];
        }
        elseif ($arg[0] == "P") {
            $p1[0] = $arg[1];
            $p1[1] = $arg[2];
            $p2[0] = $arg[3];
            $p2[1] = $arg[4];
        }
        elseif ($arg[0] == "S") {
            if ($type == 1) $time = $arg[1];
            elseif ($type == 2) $stage = $arg[1];
        }
        elseif ($arg[0] == "P1") {
            $player[1]['name'] = $arg[1];
            if ($type == 2) {
                $player[1]['x'] = $arg[2];
                $player[1]['y'] = $arg[3];
            }
        }
        elseif ($arg[0] == "P2") {
            $player[2]['name'] = $arg[1];
            if ($type == 2) {
                $player[2]['x'] = $arg[2];
                $player[2]['y'] = $arg[3];
            }
        }
        elseif ($arg[0] == "P3") {
            $player[3]['name'] = $arg[1];
            if ($type == 2) {
                $player[3]['x'] = $arg[2];
                $player[3]['y'] = $arg[3];
            }
        }
        elseif ($arg[0] == "P4") {
            $player[4]['name'] = $arg[1];
            if ($type == 2) {
                $player[4]['x'] = $arg[2];
                $player[4]['y'] = $arg[3];
            }
        }
    }
    if (!$type) {
        echo "<blockquote>Sorry, there is no active quest.</blockquote>\n";
    }
    else {
        echo "<div style=\"padding-left: 15px\">\n".
             "    <b>Quest:</b> To $text.<br><br>\n";
        if ($type == 1) {
            echo "    <b>Time to completion:</b> ".duration($time-time()).
                 "<br><br>\n";
        }
        elseif ($type == 2) {
            if ($stage == 1) {
                echo "    <b>Current goal:</b> [$p1[0],$p1[1]]<br><br>\n";
            }
            else {
                echo "    <b>Current goal:</b> [$p2[0],$p2[1]]<br><br>\n";
            }
        }
        echo "    <b>Participant 1:</b> <a href=\"playerview.php?player=".$player[1]['name']."\">".$player[1]['name']."</a><br>\n";
        if ($type == 2) {
             echo "    &nbsp;&nbsp;<b>Position:</b> [".$player[1]['x'].",".$player[1]['y']."]<br><br>\n";
        }
        else echo    "<br>\n";
        echo "    <b>Participant 2:</b> <a href=\"playerview.php?player=".$player[2]['name']."\">".$player[2]['name']."</a><br>\n";
        if ($type == 2) {
             echo "    &nbsp;&nbsp;<b>Position:</b> [".$player[1]['x'].",".$player[2]['y']."]<br><br>\n";
        }
        else echo    "<br>\n";
        echo "    <b>Participant 3:</b> <a href=\"playerview.php?player=".$player[3]['name']."\">".$player[3]['name']."</a><br>\n";
        if ($type == 2) {
             echo "    &nbsp;&nbsp;<b>Position:</b> [".$player[1]['x'].",".$player[3]['y']."]<br><br>\n";
        }
        else echo    "<br>\n";
        echo "    <b>Participant 4:</b> <a href=\"playerview.php?player=".$player[4]['name']."\">".$player[4]['name']."</a><br>\n";
        if ($type == 2) {
             echo "    &nbsp;&nbsp;<b>Position:</b> [".$player[1]['x'].",".$player[4]['y']."]<br><br>\n".
                  "    <span class=\"head1\">Quest Map:</span> <span class=\"smaller\">[Questers are shown in blue, current goal in red]</span><br>\n".
                  "    <blockquote>\n".
                  "        <img src=\"makequestmap.php\" alt=\"Idle RPG Quest Map\"><br>\n".
                  "    </blockquote>\n";
        }
        else echo    "<br>\n";
    }
    echo "<br>\n";
    include("footer.php");
?>
