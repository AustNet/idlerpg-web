<html><head><title>#G7 IRPG: Other IRPGs</title>
<?include("header.php")?>
<?php
    if ($_POST['chan'] && $_POST['text'] && $_POST['nick'] && $_POST['net']) {
        mail("jotun@ultrazone.org","contact.php",
             "Nick: ".$_POST['nick']."\nChannel: ".$_POST['chan']."\nChan URL: ".
             $_POST['chanurl']."\nNet: ".$_POST['net']."\nComments: ".$_POST['text']);
        $fp = fopen("urls.txt","a");
        $_POST['nick'] = str_replace("\t","",$_POST['nick']);
        $_POST['chan'] = str_replace("\t","",$_POST['chan']);
        $_POST['chanurl'] = str_replace("\t","",$_POST['chanurl']);
        $_POST['net'] = str_replace("\t","",$_POST['net']);
        $_POST['text'] = str_replace("\t","",$_POST['text']);

        $_POST['nick'] = htmlentities($_POST['nick']);
        $_POST['chan'] = htmlentities($_POST['chan']);
        $_POST['chanurl'] = urlencode($_POST['chanurl']);
        $_POST['chanurl'] = str_replace("%2F","/",$_POST['chanurl']);
        $_POST['chanurl'] = str_replace("%23","#",$_POST['chanurl']);
        $_POST['chanurl'] = str_replace("%2D",".",$_POST['chanurl']);
        $_POST['chanurl'] = str_replace("%3A",":",$_POST['chanurl']);
        $_POST['net'] = htmlentities($_POST['net']);
        $_POST['text'] = htmlentities($_POST['text']);
        fwrite($fp,join("\t",array($_POST['nick'],$_POST['chan'],
                                   $_POST['chanurl'],$_POST['net'],$_POST['text'])).
                   "\n");
        fclose($fp);
        echo "      <blockquote><b>Your submission has been posted!</b>".
             "</blockquote>\n"
?>
<?php
    }
    else if ($_POST['chan'] || $_POST['text'] || $_POST['nick'] || $_POST['net']) {
        echo "      <blockquote><b>Your submission has NOT been posted! Check ".
             "to make sure you filled out all fields correctly.</b>".
             "</blockquote>\n";
    }

?>
      <blockquote>
        IRPGs around the 'net (in no order):<br><br>
        <table border=0 width=75%>
          <tr>
            <td bgcolor="#FFFFFF">Nick</td>
            <td bgcolor="#FFFFFF">Channel</td>
            <td bgcolor="#FFFFFF">Network</td>
            <td bgcolor="#FFFFFF">Comments</td>
          </tr>
<?
    $urls = file("urls.txt");
    shuffle($urls);
    foreach ($urls as $line) {
        $color++;
        $elem = explode("\t",trim($line));
        echo "          <tr>\n";
        echo "            <td bgcolor=".($color%2?"#E6E6FA":"#FFFFFF").">".$elem[0]."</td>\n";
        echo "            <td bgcolor=".($color%2?"#E6E6FA":"#FFFFFF").">".$elem[1]." [<a href=\"".$elem[2]."\">link</a>]</td>\n";
        echo "            <td bgcolor=".($color%2?"#E6E6FA":"#FFFFFF").">".$elem[3]."</td>\n";
        echo "            <td bgcolor=".($color%2?"#E6E6FA":"#FFFFFF").">".$elem[4]."</td>\n";
        echo "          <tr>\n";
    }
?>
        </table>
        <br><br>
        <center>
          Do you run an IRPG of your own? Enter it here and let others know about it!<br><br>
          <form method="POST" action="others.php">
            <table border="0" colspan="2">
              <tr>
                <td align=left>Your nick:</td>
                <td align=right>
                  <input type="text" size="20" maxlength="25" name="nick">
                </td>
              </tr>
              <tr>
                <td align=left>Channel:</td>
                <td align=right>
                  <input type="text" size="20" maxlength="25" name="chan">
                </td>
              </tr>
              <tr>
                <td align=left>Channel URL:</td>
                <td align=right>
                  <input type="text" size="20" maxlength="100" name="chanurl" value="http://">
                </td>
              </tr>
              <tr>
                <td align=left>Network:</td>
                <td align=right>
                  <input type="text" size="20" maxlen="50" name="net">
                </td>
              </tr>
              <tr>
                <td align=left>Comments:</td>
                <td align=right>
                  <input type="text" name="text" maxlength="50" size=40><br>
                </td>
              </tr>
              <tr>
                <td colspan="2" align=right>
                  <input type="submit" value="Post">
                </td>
              </tr>
            </table>
          </form>
        <center>
      </blockquote>
<?include("footer.php")?>
