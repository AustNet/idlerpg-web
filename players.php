<?include("config.php")?>
<?include("commonfunctions.php")?>
<html>
<head>
<title><?php print $irpg_chan?> Idle RPG: Player Info</title>

<?include("header.php")?>

<p>
  <span class="head1">Pick a player to view:</span>
  <span class="smaller">[gray=offline]</span>
</p>
<blockquote>
  <ol>
<?php
    $file = file($irpg_db);
    unset($file[0]);
    usort($file, 'cmp_level_desc');
    foreach ($file as $line) {
        list($user,,,$level,$class,$secs,,,$online) = explode("\t",trim($line));

        /* why not HTML_entity? tb */
			
        $class = str_replace("<","&lt;",$class);
        $class = str_replace(">","&gt;",$class);

        $user2 = str_replace("<","&lt;",$user);
        $user2 = str_replace(">","&gt;",$user2);

        $user_encode = htmlentities(urlencode($user));
        $next_level = duration($secs);


        print "    <li".(!$online?" class=\"offline\"":"")."><a".(!$online?" class=\"offline\"":"")." href=\"playerview.php?player=$user_encode\">$user2</a>, the level $level $class. Next level in $next_level.</li>\n";

    }
?>
  </ol>
  For a script to view player stats from a terminal, try <a
  href="idlerpg-adv.txt">this</a> perl script by
  <a href="mailto:daxxar@mental.mine.nu">daxxar</a>.<br><br>

  See player stats in <a href="db.php">table format</a>.
</blockquote>

<?include("footer.php")?>

