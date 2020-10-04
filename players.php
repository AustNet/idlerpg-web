<html><head><title>#G7 IRPG: Player
<?php
      if ($_GET['player']) {
        echo "Info: ".$_GET['player'];
      }
      else echo "Info";
?>
</title>
<?include("header.php")?>
<?include("commonfunctions.php")?>
<?php
    if ($_GET['player']) {
        $file = file("../../irpg.db");
        unset($file[0]);
        foreach ($file as $line) {
            if (substr($line,0,strlen($_GET['player'])+1) == $_GET['player']."\t") {
                list($user,,$level,$class,$secs,,$uhost,$online,$idled,
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
            }
        }
        $class = str_replace("<","&lt;",$class);
        $user = str_replace("<","&lt;",$user);
        $class = str_replace(">","&gt;",$class);
        $user = str_replace(">","&gt;",$user);
        echo "    <b>User:</b> $user<br>\n".
             "    <b>Class:</b> $class<br>\n".
             "    <b>Level:</b> $level<br>\n".
             "    <b>Next level:</b> ".duration($secs)."<br>\n".
             "    <b>Status:</b> O".($online?"n":"ff")."line<br>\n".
             "    <b>Host:</b> ".($uhost?$uhost:"Unknown")."<br>\n".
             "    <b>Account Created:</b> ".date("D M j H:i:s Y",$created)."<br>\n".
             "    <b>Last login:</b> ".date("D M j H:i:s Y",$lastlogin)."<br>\n".
             "    <b>Total time idled:</b> ".duration($idled)."<br>\n".
             "    <p><span class=\"head1\">Items:</span></p>\n".
             "    <blockquote>\n";
        if (!is_null($item)) {
            ksort($item);
            $sum = 0;
            foreach ($item as $key => $val) {
                echo "      $key: $val<br>\n";
                $sum += $val;
            }
            echo "      <br>\n      sum: $sum<br>\n".
                 "    </blockquote>".
                 "    <p><span class=\"head1\">Penalties:</span></p>\n".
                 "    <blockquote>\n";
        }
        else echo "      No such user.<br>\n".
                  "    </blockquote>\n";
        if (!is_null($pen)) {
            ksort($pen);
            $sum = 0;
            foreach ($pen as $key => $val) {
                echo "      $key: ".duration($val)."<br>\n";
                $sum += $val;
            }
            echo "      <br>\n      total: ".duration($sum)."<br>\n";
        }
        else echo "      No such user.<br>\n";
        $file = file("../../modifiers.txt");
        if (!is_null($file)) {
            $file = preg_grep("/\b".$_GET['player']."\b|^".
                              $_GET['player']." | ".
                              $_GET['player']." | ".
                              $_GET['player'].", /",$file);
            if (!is_null($file) && count($file)) {
?>
    </blockquote>
    <p>
      <span class="head1">
        <?php echo $_GET['alltime']!=1?"Recent ":""?>Time Modifiers:
      </span>
    </p>
    <blockquote>
<?php
                if ($_GET['alltime'] == 1) {
                    foreach ($file as $line) {
                        $line=trim($line);
                        echo "      $line<BR>\n";
                    }
                }
                else {
                    end($file);
                    for ($i=0;$i<4;++$i) prev($file);
                    for ($line=trim(current($file));$line;$line=trim(next($file))) {
                        echo "      $line<BR>\n";
                    }
                }
            }
        }
        if ($_GET['alltime'] != 1) {
?>
      <BR>
      [<a href="<?php echo $_SERVER['PHP_SELF']."?player=".$_GET['player'];?>&alltime=1">View all Time Modifiers</a>]
<?php
        }
?>
      <BR><BR>
      * Accounts created on or before Aug 29, 2003 may have incowrect data fields
<?php
    }
    else {
?>
    <p><span class="head1">Pick a player to view</span></p>
    <blockquote>
<?php
        $file = file("../../irpg.db");
        unset($file[0]);
        usort($file,"cmp_level_desc");
        $i=1;
?>
      <ol>
<?php
        foreach ($file as $line) {
            list($user,,$level,$class,$secs) = explode("\t",trim($line));
            $class = str_replace("<","&lt;",$class);
            $class = str_replace(">","&gt;",$class);
            $user2 = str_replace("<","&lt;",$user);
            $user2 = str_replace(">","&gt;",$user2);
            echo "        <li><a href=\"players.php?player=".
                 htmlentities(urlencode($user)).
                 "\">$user2</a>, the level $level $class. Next level in ".
                 duration($secs).".<BR>\n";
        }
?>
      </ol>
<!--
      For a script to view player stats from a terminal, try <a
      href="idlerpg.txt">this</a> perl script by mikegrb/parallax.<br><br>

      For a script to view player stats from a terminal, try <a
      href="idlerpg.txt">this</a> perl script by parallax.<br><br>
-->
      For a script to view player stats from a terminal, try <a
      href="idlerpg-adv.txt">this</a> perl script by
      <a href="mailto:daxxar@mental.mine.nu">daxxar</a>.<br><br>

      See player stats in <a href="db.php">table format</a>.
<?php
    }
?>
    </blockquote>
<?include("footer.php")?>

