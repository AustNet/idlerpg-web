<?php
    include("header.php");

    if (!isset($_GET['player'])) {
        // if no player is entered go to the players list
        header('Location: players.php');
    } else {
?>
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <h1>Player Information</h1>
        <div class="w3-container">
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
                        <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>Alignment:</strong></td>
                        <td><?php echo ($alignment == 'e' ? 'Evil' : ($alignment == 'n' ? 'Neutral' : 'Good')); ?></td>
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
                        <td style="font-weight: bold; text-align: right; padding-right: 10px;"><strong>XML:</strong></td>
                        <td><a href="xml.php?player=<?php echo urlencode($user); ?>"><?php echo $user; ?></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="w3-row-padding w3-padding-64 w3-container w3-light-grey">
    <div class="w3-content">
        <h1>Items</h1>
        <div class="w3-container">
            <div class="w3-round-large irpg-item irpg-amulet"><?php echo intval($item['amulet']); ?></div>
            <div class="w3-round-large irpg-item irpg-boots"><?php echo intval($item['boots']); ?></div>
            <div class="w3-round-large irpg-item irpg-charm"><?php echo intval($item['charm']); ?></div>
            <div class="w3-round-large irpg-item irpg-gloves"><?php echo intval($item['gloves']); ?></div>
            <div class="w3-round-large irpg-item irpg-helmet"><?php echo intval($item['helm']); ?></div>
            <div class="w3-round-large irpg-item irpg-leggings"><?php echo intval($item['leggings']); ?></div>
            <div class="w3-round-large irpg-item irpg-ring"><?php echo intval($item['ring']); ?></div>
            <div class="w3-round-large irpg-item irpg-shield"><?php echo intval($item['shield']); ?></div>
            <div class="w3-round-large irpg-item irpg-tunic"><?php echo intval($item['tunic']); ?></div>
            <div class="w3-round-large irpg-item irpg-weapon"><?php echo intval($item['weapon']); ?></div>

            <h3>Special Items</h3>
            <ul>
            <?php
                ksort($item);
                $sum = 0;
                foreach ($item as $key => $val) {
                    if (itemfeature($val) != null) {
                        echo '<li>'. itemfeature($val) . '</li>';
                        $sum++;
                    }
                }

                if ($sum == 0) {
                    echo '<li>' . $_GET['player'] .' has no special items.</li>';
                }
            ?>
            </ul>
        </div>
    </div>
</div>

<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <h2>Penalties</h2>
        <ul class="w3-ul w3-white">
        <?php
            // process the penalties
            arsort($pen);
            $LIMIT = 0;
            foreach ($pen as $key => $val) {
                if ($val > $LIMIT) {
                    $LIMIT = $val;
                }
        ?>
            <li class="w3-bar">
                <span class="w3-bar-item irpg-penalty irpg-<?php echo $key; ?>" style="width: 90px; float: left;"></span>
                <div class="w3-bar-item--" style="margin-left: 100px">
                    <span><?php echo penalty2text($key); ?></span>
                    <div class="w3-border">
                        <div class="w3-teal" style="height: 50px; width: <?php echo (($val / $LIMIT) * 100); ?>%"></div>
                    </div>
                    <span><?php echo duration($val); ?></span>
                </div>
            </li>
        <?php
            }
        ?>
        </ul>
    </div>
</div>

<div class="w3-row-padding w3-padding-64 w3-container w3-light-grey">
    <div class="w3-content">
        <h1>World Map</h1>
        <div id="map">
            <img class="w3-image" src="makemap.php?<?php echo md5(time()); ?>&player=<?php echo urlencode($user); ?>">
        </div>
    </div>
</div>

<?php

        $file = fopen($_CONFIG['file_mod'],"r");
        $temp = array();
        while ($line=fgets($file,1024)) {
            if (strstr($line," ".$_GET['player']." ") || strstr($line," ".$_GET['player'].", ") || substr($line,0,strlen($_GET['player'])+1) == $_GET['player']." " || substr($line,0,strlen($_GET['player'])+3) == $_GET['player']."'s ") {
                array_push($temp,$line);
            }
        }
        fclose($file);
        if (!is_null($temp) && count($temp)) {
            echo('<h2>');
?>

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

