<style type="text/css">
<!--
    body { 
        font-family: trebuchet ms, Arial, Helvetica, Sans Serif; 
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
<img src="head.png" alt="#g7 Idle RPG" title="#g7 Idle RPG" 
width="400" height="100">

<p>
<?php

    $BASEURL = "/g7/"; /* Change This if Needed */

    $topbarurl = array(
        'Game Info' => $BASEURL . 'index.php',
        'Player Info' => $BASEURL . 'players.php',
        'Contact' => $BASEURL . 'contact.php',
        'Source' => $BASEURL . 'source.php',
        'Other IRPGs' => $BASEURL . 'others.php',
        'Site Source' => $BASEURL . 'sitesource.php',
        'Moo' => 'http://moo.liquigel.net/'
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
