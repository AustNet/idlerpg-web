<?php
    include("header.php");

    // open the quest file
    $FILE = fopen($_CONFIG['file_quest'], 'r');

    while ($LINE = fgets($FILE)) {
        $arg = explode(' ', trim($LINE));
        if ($arg[0] == 'T') {
            // set up the quest text
            $QUEST['text'] = 'To '. substr($LINE, 2) .'.';
        } elseif ($arg[0] == 'Y') {
            // set up the quest type
            $QUEST['type'] = $arg[1];
        } elseif ($arg[0] == 'P') {
            // set up the quest locations
            $QUEST['start']['x'] = $arg[1];
            $QUEST['start']['y'] = $arg[2];
            $QUEST['end']['x'] = $arg[3];
            $QUEST['end']['y'] = $arg[4];
        } elseif (($arg[0] == 'S') && ($QUEST['type'] == '1')) {
            // set up the quest duration (if we are on a v2 quest)
            $QUEST['duration'] = $arg[1] - time();
        } elseif (($arg[0] == 'S') && ($QUEST['type'] == '2')) {
            // set up the quest current stage (if we are on a v3 quest)
            $QUEST['stage'] = $arg[1];
        } elseif ((substr($arg[0], 0, 1) == 'P') && (substr($arg[0], 1, 1))) {
            // set up the quest players
            $PLAYERS[substr($arg[0], 1, 1)]['id'] = substr($arg[0], 1, 1);
            $PLAYERS[substr($arg[0], 1, 1)]['name'] = $arg[1];
            if (isset($arg[2])) {
                // and their current locations
                $PLAYERS[substr($arg[0], 1, 1)]['x'] = $arg[2];
                $PLAYERS[substr($arg[0], 1, 1)]['y'] = $arg[3];
            }
        }
    }

?>
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
            <h1>Current Quest</h1>
<?php
    if (!isset($QUEST['type'])) {
?>
            <p>Sorry, there is no active quest.</p>
<?php
    } else {
?>
            <p><b>Quest:</b> <?php echo $QUEST['text']; ?></p>
<?php
        if ($QUEST['type'] == '1') {
?>
            <p><b>Time to completion:</b> <?php echo duration($QUEST['duration']); ?></p>
<?php
        } elseif ($QUEST['type'] == '2') {
?>
            <p><b>Goals:</b></p>
            <ul>
                <li>Starting goal: <?php echo $QUEST['start']['x'] .' x '. $QUEST['start']['y'] . ($QUEST['stage'] == '2' ? ' [COMPLETE]' : ''); ?></li>
                <li>Finishing goal: <?php echo $QUEST['end']['x'] .' x '. $QUEST['end']['y']; ?></li>
            </ul>

<?php
        }

        foreach ($PLAYERS as $PLAYER) {
?>
            <p><b>Player #<?php echo $PLAYER['id']; ?>:</b> <a href="playerview.php?player=<?php echo urlencode($PLAYER['name']); ?>"><?php echo htmlentities($PLAYER['name']); ?></a> <?php echo ($QUEST['type'] == '2' ? '[Currently: '. $PLAYER['x'] .' x '. $PLAYER['y'] .']' : ''); ?><br>
<?php
        }
?>
        </div>
    </div>
</div>

<?php
        if ($QUEST['type'] == '2') {
?>
<div class="w3-row-padding w3-padding-64 w3-container w3-light-grey">
    <div class="w3-content">
        <h2>Quest Map</h2>
        <p>[Questers are shown in blue, current goal in red]</p>
        <div id="map"><img class="w3-image" src="makequestmap.php" usemap="#quest" border="0" /></div>
        <map id="quest" name="quest">
<?php
            foreach ($PLAYERS as $PLAYER) {
?>
                <area shape="circle" coords="<?php echo $PLAYER['x'] .','. $PLAYER['y']; ?>,6" alt="<?php echo htmlentities($PLAYER['name']); ?>" href="playerview.php?player=<?php echo urlencode($PLAYER['name']); ?>" />
<?php
            }
?>
        </map>
<?php
        }
    }
?>
    </div>
</div>
</div>
<?php
    include("footer.php");
?>
