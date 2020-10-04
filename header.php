    
    <style type="text/css"><!--
    body { font-family: trebuchet ms, Arial, Helvetica, Sans Serif; }
    p { text-indent: 15px; }
    .head1 { font-size: larger; font-weight: bold; }
    .smaller { font-size: smaller; }
    a { text-decoration: none; }
    a:hover { text-decoration: underline; color: black; }
    --></style></head>
  <body bgcolor="#ffffff" text="#000000">

<img src="head.png" alt="#g7 Idle RPG" title="#g7 Idle RPG" width="400" height="100">
<p>
<?php
    if ($_SERVER['PHP_SELF'] == '/g7/index.php') { echo "Game Info /\n"; }
    else {
        echo "<a href=\"http://jotun.ultrazone.org/g7/index.php\">Game Info</a> /\n";
    }
    if ($_SERVER['PHP_SELF'] == '/g7/players.php' && !$_GET['player']) {
        echo "Player Info /\n";
    }
    else {
        echo "<a href=\"http://jotun.ultrazone.org/g7/players.php\">Player Info</a> /\n";
    }
    if ($_SERVER['PHP_SELF'] == '/g7/contact.php' && !($_POST['from'] &&
        $_POST['text'])) {
        echo "Contact /\n";
    }
    else {
        echo "<a href=\"http://jotun.ultrazone.org/g7/contact.php\">Contact</a> /\n";
    }
    if ($_SERVER['PHP_SELF'] == '/g7/source.php') { echo "Source /\n"; }
    else {
        echo "<a href=\"http://jotun.ultrazone.org/g7/source.php\">Source</a> /\n";
    }
    if ($_SERVER['PHP_SELF'] == '/g7/others.php') { echo "Other IRPGs /\n"; }
    else {
        echo "<a href=\"http://jotun.ultrazone.org/g7/others.php\">Other IRPGs</a> /\n";
    }
    if ($_SERVER['PHP_SELF'] == '/g7/sitesource.php') { echo "Site Source\n"; }
    else {
        echo "<a href=\"http://jotun.ultrazone.org/g7/sitesource.php\">Site Source</a>\n";
    }
?>
</p>
