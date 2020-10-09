<?php
function write($map, $txt) {
    imagestring($map, 5, 10, 10, $txt, imagecolorallocate($map, 0, 0, 0));
}
    // get our configuration
    include("include/config.php");

    // load the large map
    $map = imagecreatefromjpeg('images/map.large.jpg');
    $MAP['width'] = imagesx($map);
    $MAP['height'] = imagesy($map);

    // trim the username
    $user = substr($_GET['player'],0,30);

    // set up required variables
    $stringx=$stringy=-1;

    // set up our colours
    $COLOUR['black'] = imagecolorallocate($map, 0, 0, 0);
    $COLOUR['brown'] = imagecolorallocate($map, 102, 51, 0);
    $COLOUR['cream'] = imagecolorallocate($map, 255, 255, 204);
    $COLOUR['blue'] = imageColorAllocate($map, 0, 128, 255);
    $COLOUR['black'] = imageColorAllocate($map, 0, 0, 0);
    $COLOUR['red'] = imageColorAllocate($map, 211, 0, 0);


    // pull the user database and clear the header
    $file = file($_CONFIG['file_db']);
    unset($file[0]);

    // loop through all users
    foreach ($file as $line) {
        // push user information into a readible format
        list($username,,,,,,,,$online,,$x,$y,,,,,,,,,$lastlogin) = explode("\t",trim($line));
        //echo $username . PHP_EOL;

        // print the user location dot
        imageFilledEllipse($map, floor($x * ($MAP['width'] / 500)), floor($y * ($MAP['height'] / 500)), 9, 9, $COLOUR['black']);
        imageFilledEllipse($map, floor($x * ($MAP['width'] / 500)), floor($y * ($MAP['height'] / 500)), 6, 6, $online == 1 ? $COLOUR['blue'] : (($lastlogin < time() - 15780000) ? $COLOUR['black'] : $COLOUR['red']));

        // check if the current user is the user we're looking for
        if ($username == $user) {
            // set up our actual x/y, conversion of original size (500x500) to new
            $USER['x'] = floor($x * ($MAP['width'] / 500));
            $USER['y'] = floor($y * ($MAP['height'] / 500));
            $stringx = $USER['x'];
            $stringy = $USER['y'];
        }
    }

    // a double check to ensure we've retrieved valid data from the database (this should never actually happen)
    if ($stringx == $stringy && $stringx == -1) {
        // display an error message if no user found
        imageString($map,5,200,245,"NO SUCH USER",imagecolorallocate($map,255,0,0));
    }
    else {
        // set up our font dimensions
        $font_width = imageFontWidth(5);
        $font_height = imageFontHeight(5);

        // move the user text in front of the pointer if too far right
        if ($USER['x']+((strlen($user)+1)*$font_width) > $MAP['width']) {
           $stringx = $USER['x'] - ((strlen($user)+1)*$font_width)-18;
        }
        // move the user text above the pointer if too low
        if ($USER['y']+$font_height > $MAP['height']) {
            $stringy = $USER['y'] - ($font_height/2)-2;
        }

        // Avoid drawing a brown dot on a brown area (less 1 because the border sometimes gets stuck)
        $rgb = imageColorAt($map, $USER['x'] - 1, $USER['y'] - 1);
        if ($rgb > 0) { // $rgb is 0 on our parchment-colored areas
            $temp = $COLOUR['brown'];
            $COLOUR['brown'] = $COLOUR['cream'];
            $COLOUR['cream'] = $temp;
        }
        // print the user location dot
        imageFilledEllipse($map, $USER['x'], $USER['y'], 9, 9, $COLOUR['black']);
        imageFilledEllipse($map, $USER['x'], $USER['y'], 6, 6, $COLOUR['brown']);

        // print the username background
        imageFilledRectangle($map, floor($stringx) + 8, floor($stringy) - ($font_height / 2) - 1, floor($stringx) + 10 + $font_width * (strlen($user) + 1), floor($stringy) + ($font_height / 2) + 1, $COLOUR['black']);
        imageFilledRectangle($map, floor($stringx) + 9, floor($stringy) - ($font_height / 2), floor($stringx) + 9 + $font_width * (strlen($user) + 1), floor($stringy) + ($font_height / 2), $COLOUR['brown']);

        // print the username text
        imageString($map, 5, floor($stringx) + 10 + ($font_width / 2), floor($stringy) - ($font_height / 2) - 1, $user, $COLOUR['cream']);
 
        // crop it down, make sure we account for the borders min/max
        $c = array(
            'x' => (($USER['x'] - 600) <= 0) ? 1 : ((($USER['x'] - 600) + 1200) > $MAP['width'] ? ($MAP['width'] - 1200) : ($USER['x'] - 600)),
            'y' => ($USER['y'] - 300) <= 0 ? 1 : ((($USER['y'] - 300) + 600) > $MAP['height'] ? ($MAP['height'] - 600) : ($USER['y'] - 300)),
            'width' => 1200,
            'height' => 600
        );

        // crop the image
        $map2 = imagecrop($map, $c);
        //write($map2, "'x' => (".($x - 600)." <= 0) ? 1 : ".(($x - 600) + 1200)." > ".$MAP['width']." ? ".($MAP['width'] - 1200)." : ($x - 600),");
    }

    // set up the file as an image
    header("Content-type: image/png");

    // display the image
    imagePNG($map2);

    // clean up
    imageDestroy($map);
    imageDestroy($map2);
?>
