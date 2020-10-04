    <hr>
    <span class="smaller">
      <p>
        Questions? Comments? Suggestions? Bugs? Naked pics?
        <a href="http://jotun.ultrazone.org/g7/contact.php">
        jotun@ultrazone.org</a> or jotun@IRC.
        <?php
            $hits = file("hits.db");
            $fp = fopen("hits.db", "w");
            if ($fp == false) {
                echo "Error: could not open file hits.db.";
            }
            foreach ($hits as $line) {
                list($page,$numhits,$date) = explode("\t",trim($line));
                if ($page == $_SERVER['PHP_SELF']) {
                    ++$numhits;
                    echo "$numhits hits since $date";
                    $found = 1;
                }
                if ($fp) {
                    fwrite($fp,"$page\t$numhits\t$date\n");
                }
            }
            if (!$found && $fp) {
                echo "1 hits since ".date("M j, Y",time());
                fwrite($fp,$_SERVER['PHP_SELF']."\t1\t".date("M j, Y",time())."\n");
            }
            $fp2 = fopen("combo.log.txt","a");
            fwrite($fp2,$_SERVER['REMOTE_ADDR']." ; ".$_SERVER['REQUEST_URI']." ; ".$_SERVER['HTTP_REFERER']." ; ".$_SERVER['HTTP_USER_AGENT']."\n");
            fclose($fp2);
            fclose($fp);
        ?>
      </p>
    </span>
  </body>
</html>
