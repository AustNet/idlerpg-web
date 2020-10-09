<?php
    include("header.php");
?>
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
<?php

    if (!isset($_GET['player'])) {
        // if no player is entered go to the players list
        header('Location: players.php');
    } else {
?>
    <h1>PLAYER INFO</h1>
<?php
        $file = fopen($_CONFIG['file_db'],"r");
        fgets($file,1024); // skip top comment
        $found=0;
        while ($line=fgets($file,1024)) {
            if (substr($line,0,strlen($_GET['player'])+1) == $_GET['player']."\t") {
                list($user,,
                    $isadmin,
                    $level,
                    $class,
                    $secs,,
                    $uhost,
                    $online,
                    $idled,
                    $x,$y,
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
                    $alignment,
                ) = explode("\t",trim($line));
                $found=1;
                break;
            }
        }
        if (!$found) echo "<h1>ERROR</h1><p><b>No such user.</b></p>\n";
        else {
            $class=htmlentities($class);
?>
    <table class="irpg-table" style="width: 100%;">
        <tbody>
        <tr>
                <td style="width: 50px; font-weight: bold; text-align: right; padding-right: 10px;"><strong>User:</strong></td>
                <td style="width: ;"><?php echo htmlentities($user); ?></td>
                <td style="width: 150px; font-weight: bold; text-align: right; padding-right: 10px;"><strong>Admin:</strong></td>
                <td style="width: ;"><?php echo ($isadmin ? 'Yes' : 'No'); ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>Level:</strong></td>
                <td><?php echo $level; ?></td>
                <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>Next Level:</strong></td>
                <td><?php echo duration($secs); ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>Status:</strong></td>
                <td><?php echo ($online ? 'Online' : 'Offline'); ?></td>
                <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>Host:</strong></td>
                <td><?php echo $uhost; ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>Created:</strong></td>
                <td><?php echo date('D M j H:i:s Y', $created); ?></td>
                <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>Last Login:</strong></td>
                <td><?php echo date('D M j H:i:s Y', $lastlogin); ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>Idled:</strong></td>
                <td><?php echo duration($idled); ?></td>
                <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>Position:</strong></td>
                <td><?php echo $x .' x '. $y; ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>Alignment:</strong></td>
                <td><?php echo ($alignment == 'e' ? 'Evil' : ($alignment == 'n' ? 'Neutral' : 'Good')); ?></td>
                <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>XML:</strong></td>
                <td><a href="xml.php?player=<?php echo urlencode($user); ?>"><?php echo $user; ?></a></td>
            </tr>
        </tbody>
    </table>

  </div>
</div>

<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container w3-center">
    <div style="margin: auto;">
        <h1>MAP</h1>
        <div id="map"><img src="makemap.php?<?php echo md5(time()); ?>&player=<?php echo urlencode($user); ?>"></div>
    </div>
</div>

<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
    <h1>ITEMS</h1>
<?php
        ksort($item);
        $sum = 0;
        foreach ($item as $key => $val) {
            $uniquecolor="#be9256";
            if ($key == "helm" && substr($val,-1,1) == "a") {
                $val = intval($val)." [<font color=\"$uniquecolor\">Mattt's Omniscience Grand Crown</font>]";
            }
            if ($key == "tunic" && substr($val,-1,1) == "b") {
                $val = intval($val)." [<font color=\"$uniquecolor\">Res0's Protectorate Plate Mail</font>]";
            }
            if ($key == "amulet" && substr($val,-1,1) == "c") {
                $val = intval($val)." [<font color=\"$uniquecolor\">Dwyn's Storm Magic Amulet</font>]";
            }
            if ($key == "weapon" && substr($val,-1,1) == "d") {
                $val = intval($val)." [<font color=\"$uniquecolor\">Jotun's Fury Colossal Sword</font>]";
            }
            if ($key == "weapon" && substr($val,-1,1) == "e") {
                $val = intval($val)." [<font color=\"$uniquecolor\">Drdink's Cane of Blind Rage</font>]";
            }
            if ($key == "boots" && substr($val,-1,1) == "f") {
                $val = intval($val)." [<font color=\"$uniquecolor\">Mrquick's Magical Boots of Swiftness</font>]";
            }
            if ($key == "weapon" && substr($val,-1,1) == "g") {
                $val = intval($val)." [<font color=\"$uniquecolor\">Jeff's Cluehammer of Doom</font>]";
            }
            if ($key == "ring" && substr($val,-1,1) == "h") {
                $val = intval($val)." [<font color=\"$uniquecolor\">Juliet's Glorious Ring of Sparkliness</font>]";
            }
            echo "      $key: $val<br />\n";
            $sum += $val;
        }
        echo "      <br />\n      sum: $sum<br />\n".
             "    </p>";
?>

</div>
  </div>
</div>

<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>PENALTIES</h1>
<?php

        ksort($pen);
        $sum = 0;
        foreach ($pen as $key => $val) {
            echo "      $key: ".duration($val)."<br />\n";
            $sum += $val;
        }
        echo "      <br />\n      total: ".duration($sum)."</p>\n";

        $file = fopen($_CONFIG['file_mod'],"r");
        $temp = array();
        while ($line=fgets($file,1024)) {
            if (strstr($line," ".$_GET['player']." ")          ||
                strstr($line," ".$_GET['player'].", ")         ||
                substr($line,0,strlen($_GET['player'])+1) ==
                       $_GET['player']." "                        ||
                substr($line,0,strlen($_GET['player'])+3) ==
                       $_GET['player']."'s ") {
                array_push($temp,$line);
            }
        }
        fclose($file);
        if (!is_null($temp) && count($temp)) {
            echo('<h2>');
?>

</div>
  </div>
</div>

<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
    <h1>CHARACTER MODIFIERS</h1>

<?php
                foreach ($temp as $line) {
                    $line=htmlentities(trim($line));
                    echo "      $line<br />\n";
                }
                echo "      <br />\n";
        }
        if ((!isset($_GET['allmods']) || ($_GET['allmods'] != 1)) && count($temp) > 5) {
?>
      <br />
      [<a href="<?php echo $_SERVER['PHP_SELF']."?player=".urlencode($user);?>&amp;allmods=1">View all Character Modifiers</a> (<?php echo count($temp); ?>)]
      </p>
<?php
        }
    }
}
?>
    </div>
  </div>
</div>
<?php
    include("footer.php");
?>

