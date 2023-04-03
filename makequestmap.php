<?php
    include("include/config.php");
    include('include/idlerpg.php');
    $file = fopen($_CONFIG['file_quest'],"r");

    $type=0;
    while ($line=fgets($file,1024)) {
        $arg = explode(" ",trim($line));
        if ($arg[0] == "Y") {
            $type = $arg[1];
        }
        elseif ($arg[0] == "P") {
            $p1[0] = $arg[1];
            $p1[1] = $arg[2];
            $p2[0] = $arg[3];
            $p2[1] = $arg[4];
        }
        elseif ($arg[0] == "S") {
            if ($type == 1) $time = $arg[1];
            elseif ($type == 2) $stage = $arg[1];
        }
        elseif ($arg[0] == "P1") {
            $player[1]['name'] = $arg[1];
            if ($type == 2) {
                $player[1]['x'] = $arg[2];
                $player[1]['y'] = $arg[3];
            }
        }
        elseif ($arg[0] == "P2") {
            $player[2]['name'] = $arg[1];
            if ($type == 2) {
                $player[2]['x'] = $arg[2];
                $player[2]['y'] = $arg[3];
            }
        }
        elseif ($arg[0] == "P3") {
            $player[3]['name'] = $arg[1];
            if ($type == 2) {
                $player[3]['x'] = $arg[2];
                $player[3]['y'] = $arg[3];
            }
        }
        elseif ($arg[0] == "P4") {
            $player[4]['name'] = $arg[1];
            if ($type == 2) {
                $player[4]['x'] = $arg[2];
                $player[4]['y'] = $arg[3];
            }
        }
    }
    if ($type != 2) {
        header("Location: images/maperror.png");
        exit(0);
    }

    $map = imagecreatefromjpeg('images/map.jpg');
    $MAP['width'] = imagesx($map);
    $MAP['height'] = imagesy($map);

    // set up the colors
    $COLOR = fillcolor($map);

    // show the stage dots
    if ($stage == 1) {
        imageFilledEllipse($map, $p1[0] * ($MAP['width'] / 500), $p1[1] * ($MAP['height'] / 500), 20, 20, $COLOR['black']);
        imageFilledEllipse($map, $p1[0] * ($MAP['width'] / 500), $p1[1] * ($MAP['height'] / 500), 17, 17, $COLOR['red']);
        imageFilledEllipse($map, $p2[0] * ($MAP['width'] / 500), $p2[1] * ($MAP['height'] / 500), 20, 20, $COLOR['black']);
        imageFilledEllipse($map, $p2[0] * ($MAP['width'] / 500), $p2[1] * ($MAP['height'] / 500), 17, 17, $COLOR['red']);
    } else {
        imageFilledEllipse($map, $p1[0] * ($MAP['width'] / 500), $p1[1] * ($MAP['height'] / 500), 20, 20, $COLOR['black']);
        imageFilledEllipse($map, $p1[0] * ($MAP['width'] / 500), $p1[1] * ($MAP['height'] / 500), 17, 17, $COLOR['green']);
        imageFilledEllipse($map, $p2[0] * ($MAP['width'] / 500), $p2[1] * ($MAP['height'] / 500), 20, 20, $COLOR['black']);
        imageFilledEllipse($map, $p2[0] * ($MAP['width'] / 500), $p2[1] * ($MAP['height'] / 500), 17, 17, $COLOR['red']);
    }

    // show the user dots
    imageFilledEllipse($map, $player[1]['x'] * ($MAP['width'] / 500), $player[1]['y'] * ($MAP['height'] / 500), 9, 9, $COLOR['black']);
    imageFilledEllipse($map, $player[1]['x'] * ($MAP['width'] / 500), $player[1]['y'] * ($MAP['height'] / 500), 6, 6, $COLOR['blue']);

    imageFilledEllipse($map, $player[2]['x'] * ($MAP['width'] / 500), $player[2]['y'] * ($MAP['height'] / 500), 9, 9, $COLOR['black']);
    imageFilledEllipse($map, $player[2]['x'] * ($MAP['width'] / 500), $player[2]['y'] * ($MAP['height'] / 500), 6, 6, $COLOR['blue']);

    imageFilledEllipse($map, $player[3]['x'] * ($MAP['width'] / 500), $player[3]['y'] * ($MAP['height'] / 500), 9, 9, $COLOR['black']);
    imageFilledEllipse($map, $player[3]['x'] * ($MAP['width'] / 500), $player[3]['y'] * ($MAP['height'] / 500), 6, 6, $COLOR['blue']);

    imageFilledEllipse($map, $player[4]['x'] * ($MAP['width'] / 500), $player[4]['y'] * ($MAP['height'] / 500), 9, 9, $COLOR['black']);
    imageFilledEllipse($map, $player[4]['x'] * ($MAP['width'] / 500), $player[4]['y'] * ($MAP['height'] / 500), 6, 6, $COLOR['blue']);

    header("Content-type: image/png");
    imagePNG($map);
    imageDestroy($map);
?>
