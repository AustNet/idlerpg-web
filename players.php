<?php
    include("header.php");
?>

<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>PLAYERS</h1>
      <p>Pick a player to view more information about them. [gray=offline]</p>
      
      <ol>
<?php
    if (!file_exists($_CONFIG['file_db'])) {
      echo '<p>Database file not found, please check website configuration.</p>';
    }
    $FILE = file($_CONFIG['file_db']);
    unset($FILE[0]);
    usort($FILE, 'cmp_level_desc');
    foreach ($FILE as $LINE) {
        list($USER,,,$LEVEL,$CLASS,$SECS,,,$ONLINE) = explode("\t",trim($LINE));

        $CLASS = htmlentities($CLASS);
        $NEXT_LEVEL = duration($SECS);

?>
        <li <?php echo (!$ONLINE ? 'class="w3-text-grey"' : ''); ?>><a href="playerview.php?player=<?php echo urlencode($USER); ?>"><?php echo htmlentities($USER); ?></a>, the level <?php echo $LEVEL; ?> <?php echo $CLASS; ?>. Next level in <?php echo $NEXT_LEVEL; ?>.</li>
<?php
    }
?>
      </ol>
      <p>For a script to view player stats from a terminal, try <a href="scripts/idlerpg-adv.pl">this</a> perl script by <a href="mailto:daxxar@mental.mine.nu">daxxar</a>.</p>

      <p>See player stats in <a href="db.php">table format</a>.</p>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>
