<style type="text/css">
<!--
    body { 
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; 
        background-color: white;
        color: black;
    }

    p { text-indent: 15px; }
    .head1 { font-size: larger; font-weight: bold; }
    .smaller { font-size: smaller; }

    a { text-decoration: none; }
    a:hover { text-decoration: underline; color: black; }
-->
</style>
</head>

<body>

<!-- Idle RPG Logo -->
<?php
echo('
<img src="'. $irpg_logo .'" alt="'. $irpg_chan .' Idle RPG" title="'. $irpg_chan .' Idle RPG" width="329" height="117">
<p>
');

    $topbarurl = array(
        'Game Info' => $BASEURL . 'index.php',
        'Player Info' => $BASEURL . 'players.php',
        'Contact' => $BASEURL . 'contact.php',
        'Source [offsite]' => 'http://idlerpg.net/source.php',
        'Other IRPGs [o/s]' => 'http://idlerpg.net/others.php',
        'Site Source [o/s]' => 'http://idlerpg.net/sitesource.php',
        'World Map' => $BASEURL . 'worldmap.php',
        'Quest Info' => $BASEURL . 'quest.php',
        'Forum [o/s]' => 'http://idlerpg.net/forum.php',
        'moo. [o/s]' => 'http://cowcult.org',
    );

    $c = 1;
    foreach ($topbarurl as $key => $value) {
        if ($topbarurl[$key] ==  $_SERVER['PHP_SELF']) {
            echo $key, ' ';
        }
        else {
            echo "<a href=\"$value\">$key</a> ";
        }
        echo ($c == count($topbarurl)) ? "\n" : "| \n";
        ++$c;
    }
?>
</p>
