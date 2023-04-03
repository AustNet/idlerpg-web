<?php
    include("header.php");
?>

<div class="w3-row-padding w3-padding-64 w3-container w3-center">

<h1>WORLD MAP</h1>
<p>[<span style="color: #D30000;">offline</span> | <span style="color: #0080FF">online</span> | <span style="color: #000000">quit</span>]</p>

<div>
    <img src="makeworldmap.php?<?php echo md5(time()); ?>" usemap="#world" border="0" />
    <map name="world">
<?php
    $file = fopen($_CONFIG['file_db'],"r");
    fgets($file);
    while($location=fgets($file)) {
        list($who,,,,,,,,,,$x,$y) = explode("\t",trim($location));
?>
        <area shape="circle" coords="<?php echo floor($x * 2.4) .','. floor($y * 1.2).',5'; ?>" alt="<?php echo htmlentities($who); ?>" href="playerview.php?player=<?php echo urlencode($who); ?>" title="<?php echo htmlentities($who); ?>" />
<?php
    }
    fclose($file);
?>
    </map>
</div>
</div>

<?php include("footer.php");?>
