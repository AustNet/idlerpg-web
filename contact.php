<?php

include("config.php");

echo('<html><head><title>'.$irpg_chan.' Idle RPG: Contact</title>');

include("header.php");

    if ($_POST['from'] && $_POST['text']) {
        mail($admin_email,"IRPG: ".$_POST['from'],
             "Name: ".$_POST['name']."\nE-mail: ".$_POST['from']."\n\n".
             $_POST['text'],"From: ".$_POST['from']."\r\n");
        echo('      <blockquote>Thanks for your submission.</blockquote>');
    }
    else {
        echo('
      <blockquote>
        <form method="POST" action="contact.php">
          <table border="0" colspan="2">
            <tr>
              <th align="left"><label for="from">Your e-mail address</label>:</th>
              <td align="right">
                <input type="text" size="20" maxlen="50" name="from" id="from">
              </td>
            </tr>
            <tr>
              <th align="left"><label for="name">Your name</label>:</th>
              <td align="right">
                <input type="text" size="20" maxlen="50" name="name" id="name">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <textarea name="text" rows="6" cols="44"></textarea><br>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="right">
                <input type="submit" value="Send">
              </td>
            </tr>
          </table>
        </form>
      </blockquote>
');
    }
    include("footer.php");
?>
