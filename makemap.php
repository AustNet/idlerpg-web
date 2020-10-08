<?php
    include("include/config.php");
    /* we dont need this anymore
    session_start(); // sessions to generate only one map / person / 20s
    if (isset($_SESSION['time']) && time()-$_SESSION['time'] < 20) {
        header("Location: images/maperror.png");
        exit(0);
    }
    $_SESSION['time']=time();
    */
    $map = imagecreatefromjpeg('images/map.jpg');

    $user = substr($_GET['player'],0,30);

    $stringx=$stringy=-1;

    $file = file($_CONFIG['file_db']);
    unset($file[0]);

    foreach ($file as $line) {
        list($username,,,,,,,,,,$x,$y) = explode("\t",trim($line));
        if ($username == $user) {
            $stringx = $x;
            $stringy = $y;
            break;
        }
    }
    if ($stringx == $stringy && $stringx == -1) {
        imageString($map,5,200,245,"NO SUCH USER",imagecolorallocate($map,255,0,0));
    }
    else {
        $width = imageFontWidth(5);
        $height = imageFontHeight(5);
        if ($x+((strlen($user)+1)*$width) > 500) {
            $stringx = $x - ((strlen($user)+1)*$width)-12;
        }
        if ($y+$height > 500) {
            $stringy = $y - ($height/2)-2;
        }
        $magenta = imageColorAllocate($map,255,0,255);
        imageColorTransparent($map,$magenta);
        $brown = imagecolorallocate($map, 102, 51, 0);
        $parchment = imagecolorallocate($map, 255, 255, 204);
    
        // Avoid drawing a brown dot on a brown area
        $rgb = imageColorAt($map, floor($x * 2.4), floor($y * 1.2));
        if ($rgb > 0) { // $rgb is 0 on our parchment-colored areas
            $temp = $brown;
            $brown = $parchment;
            $parchment = $temp;
        }
        // YOU ARE HERE
        imageFilledEllipse($map, floor($x * 2.4), floor($y * 1.2), 6, 6, $brown);
        // background for text
        imageFilledRectangle($map,floor($stringx * 2.4)+9,floor($stringy * 1.2)-($height/2),floor($stringx * 2.4)+9+$width*(strlen($user)+1),floor($stringy * 1.2)+($height/2),$brown);
        // text itself
        imageString($map,5,floor($stringx * 2.4)+10+($width/2),floor($stringy * 1.2)-($height/2)-1,$user,$parchment);
    }
    header("Content-type: image/png");
    imagePNG($map);
    imageDestroy($map);
?>
