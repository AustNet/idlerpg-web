<?php
    include("include/config.php");
    include('include/idlerpg.php');
    $file = fopen($_CONFIG['file_db'],"r");
    fgets($file);

    // check if we are opening the BIG map!
    if ((isset($_GET['style'])) && ($_GET['style'] == 'large')) {
        $map = imagecreatefromjpeg('images/map.large.jpg');
    } else {
        $map = imagecreatefromjpeg('images/map.jpg');
    }

    $MAP['width'] = imagesx($map);
    $MAP['height'] = imagesy($map);

    $magenta = ImageColorAllocate($map, 255, 0, 255);
    $blue = imageColorAllocate($map, 0, 128, 255);
    $black = imageColorAllocate($map, 0, 0, 0);
    $red = imageColorAllocate($map, 211, 0, 0);
    ImageColorTransparent($map, $magenta);
    while ($line=fgets($file)) {
        list($user,,,,,,,,$online,,$x,$y,,,,,,,,,$lastlogin) = explode("\t",trim($line));
        if ($online == 1) {
            imageFilledEllipse($map, floor($x * ($MAP['width'] / 500)), floor($y * ($MAP['height'] / 500)), 9, 9, $black);
            imageFilledEllipse($map, floor($x * ($MAP['width'] / 500)), floor($y * ($MAP['height'] / 500)), 6, 6, $blue);
        } elseif ($lastlogin < time() - 15780000) {
            imageFilledEllipse($map, floor($x * ($MAP['width'] / 500)), floor($y * ($MAP['height'] / 500)), 9, 9, $black);
        } else {
            imageFilledEllipse($map, floor($x * ($MAP['width'] / 500)), floor($y * ($MAP['height'] / 500)), 9, 9, $black);
            imageFilledEllipse($map, floor($x * ($MAP['width'] / 500)), floor($y * ($MAP['height'] / 500)), 6, 6, $red);
        }
    }
    header("Content-type: image/png");
    imagePNG($map);
    imageDestroy($map);
?>
