<html><head><title>#G7 IRPG: Contact</title>
<?include("header.php")?>
<?php
    if ($_POST['from'] && $_POST['text']) {
        mail("jotun@ultrazone.org","contact.php",
             "Name: ".$_POST['name']."\nE-mail: ".$_POST['from']."\n\n".
             $_POST['text']);
?>
      <blockquote>Thanks for your submission.</blockquote>
<?php
    }
    else {
?>
      <blockquote>
        <form method="POST" action="contact.php">
          <table border="0" colspan="2">
            <tr>
              <td align=left>Your e-mail address:</td>
              <td align=right>
                <input type="text" size="20" maxlen="50" name="from">
              </td>
            </tr>
            <tr>
              <td align=left>Your name:</td>
              <td align=right>
                <input type="text" size="20" maxlen="50" name="name">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <textarea name="text" rows="6" cols="44"></textarea><br>
              </td>
            </tr>
            <tr>
              <td colspan="2" align=right>
                <input type="submit" value="Send">
                <input type="reset" value="Clear"><!-- nobody uses these.. -->
              </td>
            </tr>
          </table>
        </form>
      </blockquote>
<?php
    }
?>
<?include("footer.php")?>
