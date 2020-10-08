<?php
    include("include/config.php");
    include('include/idlerpg.php');
    $file = fopen($_CONFIG['file_db'],"r");
    fgets($file);

    //$map = imageCreate(1536, 1152);
    $map = imagecreatefromjpeg('images/map.jpg');
    $magenta = ImageColorAllocate($map, 255, 0, 255);
    $blue = imageColorAllocate($map, 0, 128, 255);
    $black = imageColorAllocate($map, 0, 0, 0);
    $red = imageColorAllocate($map, 211, 0, 0);
    ImageColorTransparent($map, $magenta);
    while ($line=fgets($file)) {
        list(,,,,,,,,$online,,$x,$y) = explode("\t",trim($line));
        if ($online == 1) {
            imageFilledEllipse($map, floor($x * 2.4), floor($y * 1.2), 9, 9, $black);
            imageFilledEllipse($map, floor($x * 2.4), floor($y * 1.2), 6, 6, $blue);
        } else {
            imageFilledEllipse($map, floor($x * 2.4), floor($y * 1.2), 9, 9, $black);
            imageFilledEllipse($map, floor($x * 2.4), floor($y * 1.2), 6, 6, $red);
        }
    }
    header("Content-type: image/png");
    imagePNG($map);
    imageDestroy($map);
?>
