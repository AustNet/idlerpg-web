<?php
    if ($_GET['player']!="") {
        header('Location: playerview.php?player='.$_GET['player']);
        exit(0);
    }
?>
<html>
<head>
<title>#G7 IRPG: Player Info</title>
<?include("header.php")?>
<?include("commonfunctions.php")?>

	<p><span class="head1">Pick a player to view</span></p>
	<blockquote>

<?php
        $file = file("../../irpg.db");
        unset($file[0]);
        usort($file, 'cmp_level_desc');
        $i=1;
?>
      <ol>
<?php

	foreach ($file as $line) {
		list($user,,$level,$class,$secs) = explode("\t",trim($line));

		/* why not HTML_entity? tb */
			
		$class = str_replace("<","&lt;",$class);
		$class = str_replace(">","&gt;",$class);

		$user2 = str_replace("<","&lt;",$user);
		$user2 = str_replace(">","&gt;",$user2);

		$user_encode = htmlentities(urlencode($user));
		$next_level = duration($secs);

		echo <<<EOQ
					<li><a href="playerview.php?player=$user_encode">$user2</a>, the level
					$level $class. Next level in $next_level. <BR>
EOQ;
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
      href="http://idlerpg.net/idlerpg-adv.txt">this</a> perl script by
      <a href="mailto:daxxar@mental.mine.nu">daxxar</a>.<br><br>

      See player stats in <a href="db.php">table format</a>.
<?php
?>
    </blockquote>
<?include("footer.php")?>

