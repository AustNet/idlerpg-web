<?php
    include("header.php");
?>

<div class="w3-row-pfadding w3-padding-64 w3-container w3-center">
  <div class="w3-content">

<h1>WORLD MAP</h1>
<p>[offline users are red, online users are blue]</p>

<center>
<div id="map" class="w3-center">
    <img src="makeworldmap.php" alt="IdleRPG World Map" title="IdleRPG World Map" usemap="#world" border="0" />
    <map id="world" name="world">
<?php
    $file = fopen($_CONFIG['file_db'],"r");
    fgets($file);
    while($location=fgets($file)) {
        list($who,,,,,,,,,,$x,$y) = explode("\t",trim($location));
        print "        <area shape=\"circle\" coords=\"".$x.",".$y.",4\" alt=\"".htmlentities($who).
              "\" href=\"playerview.php?player=".urlencode($who)."\" title=\"".htmlentities($who)."\" />\n";
    }
    fclose($file);
?>
    </map>
</div>
</center>
</div>
</div>

<?php include("footer.php");?>
