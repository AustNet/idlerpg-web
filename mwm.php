<?php
    include("include/config.php");
    $file = fopen($_CONFIG['file_db'],"r");
    fgets($file);

    /* don't think we need this anymore..
    session_start(); // sessions to generate only one map / person / 20s
    if (isset($_SESSION['time']) && time()-$_SESSION['time'] < 20) {
        header("Location: images/maperror.png");
        exit(0);
    }
    $_SESSION['time']=time();
    */

    $map = imageCreate(500,500);
    $magenta = ImageColorAllocate($map, 255, 0, 255);
    $blue = imageColorAllocate($map, 0, 128, 255);
    $red = imageColorAllocate($map, 211, 0, 0);
    ImageColorTransparent($map, $magenta);
    while ($line=fgets($file)) {
        list(,,,,,,,,$online,,$x,$y) = explode("\t",trim($line));
        if ($online == 1) imageFilledEllipse($map, $x, $y, 3, 3, $blue);
        else imageFilledEllipse($map, $x, $y, 3, 3, $red);
    }
    header("Content-type: image/png");
    imagePNG($map);
    imageDestroy($map);
?>
