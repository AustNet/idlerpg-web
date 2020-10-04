<?
    include("config.php");
    $file = fopen($irpg_db,"r");
    fgets($file);

    session_start(); // sessions to generate only one map / person / minute
    if (time()-$_SESSION['time'] < 60) {
        header("Location: maperror.png");
        exit(0);
    }
    $_SESSION['time']=time();

    header("Content-type: img/png");
    $map = imageCreateFromPNG("newmap.png");
    $blue = imageColorAllocate($map, 0, 128, 255);
    $red = imageColorAllocate($map, 211, 0, 0);

	while ($line=fgets($file)) {
		list(,,,,,,,,$online,,$x,$y) = explode("\t",trim($line));
		if ($online == 1) imageFilledEllipse($map, $x, $y, 3, 3, $blue);
		else imageFilledEllipse($map, $x, $y, 3, 3, $red);
    }
    header("Content-type: image/png");
    imagePNG($map);
    imageDestroy($map);
?>
