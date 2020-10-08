<?php
    include("header.php");
?>

<div class="w3-row-pfadding w3-padding-64 w3-container w3-center">
  <div class="w3-condtent">

<h1>WORLD MAP</h1>
<p>[offline users are red, online users are blue]</p>

<div style="!display: grid; !height: 100%;">
    <img src="makeworldmap.php?<?php echo md5(time()); ?>" usemap="#world" border="0" style="!max-width: 100%; !max-height: 80vh; !margin: auto;" id="myImageId1" />
    <map name="world" id="myMapId1">
<?php
    $file = fopen($_CONFIG['file_db'],"r");
    fgets($file);
    while($location=fgets($file)) {
        list($who,,,,,,,,,,$x,$y) = explode("\t",trim($location));
?>
        <area shape="circle" coords="<?php echo floor($x * 2.4) .','. floor($y * 1.2).',6'; ?>" alt="<?php echo htmlentities($who); ?>" href="playerview.php?player=<?php echo urlencode($who); ?>" title="<?php echo htmlentities($who); ?>" />
<?php
    }
    fclose($file);
?>
    </map>
</div>
</div>
</div>

<?php include("footer.php");?>
