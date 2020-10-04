<html><head><title>#G7 IRPG: DB-style Player Listing</title>
<?include("header.php")?>
<?include("commonfunctions.php")?>
<?php
    $file = file("../../irpg.db");
    unset($file[0]);
    if (!$_GET['sort'] ||
        (($_GET['sort'] != "cmp_level_asc") &&
        ($_GET['sort'] != "cmp_level_desc") &&
        ($_GET['sort'] != "cmp_ttl_asc") &&
        ($_GET['sort'] != "cmp_ttl_desc") &&
        ($_GET['sort'] != "cmp_pen_asc") &&
        ($_GET['sort'] != "cmp_pen_desc") &&
        ($_GET['sort'] != "cmp_lastlogin_asc") &&
        ($_GET['sort'] != "cmp_lastlogin_desc") &&
        ($_GET['sort'] != "cmp_created_asc") &&
        ($_GET['sort'] != "cmp_created_desc") &&
        ($_GET['sort'] != "cmp_idled_asc") &&
        ($_GET['sort'] != "cmp_idled_desc") &&
        ($_GET['sort'] != "cmp_user_asc") &&
        ($_GET['sort'] != "cmp_user_desc") &&
        ($_GET['sort'] != "cmp_online_asc") &&
        ($_GET['sort'] != "cmp_online_desc") &&
        ($_GET['sort'] != "cmp_uhost_asc") &&
        ($_GET['sort'] != "cmp_uhost_desc") &&
        ($_GET['sort'] != "cmp_sum_asc") &&
        ($_GET['sort'] != "cmp_sum_desc"))) $_GET['sort'] = "cmp_level_desc";
    usort($file,$_GET['sort']);
?>
    <table border=1 cellpadding=2 cellspacing=2>
      <tr>
        <td NOWRAP>
          User
          (<a href="db.php?sort=cmp_user_asc">
             <img src="up.png" border=0>
           </a>
           /
          <a href="db.php?sort=cmp_user_desc">
             <img src="down.png" border=0>
          </a>)
        </td>
        <td NOWRAP>
          Level
          (<a href="db.php?sort=cmp_level_asc">
             <img src="up.png" border=0>
           </a>
           /
          <a href="db.php?sort=cmp_level_desc">
             <img src="down.png" border=0>
          </a>)
        </td>
        <td NOWRAP>Class</td>
        <td NOWRAP>
          TTL
          (<a href="db.php?sort=cmp_ttl_asc">
             <img src="up.png" border=0>
           </a>
           /
          <a href="db.php?sort=cmp_ttl_desc">
             <img src="down.png" border=0>
          </a>)
        </td>
        <td NOWRAP>
          Nick!User@Host
          (<a href="db.php?sort=cmp_uhost_asc">
             <img src="up.png" border=0>
           </a>
           /
          <a href="db.php?sort=cmp_uhost_desc">
             <img src="down.png" border=0>
          </a>)
        </td>
        <td NOWRAP>
          Online
          (<a href="db.php?sort=cmp_online_asc">
             <img src="up.png" border=0>
           </a>
           /
          <a href="db.php?sort=cmp_online_desc">
             <img src="down.png" border=0>
          </a>)
        </td>
        <td NOWRAP>
          Total Time Idled
          (<a href="db.php?sort=cmp_idled_asc">
             <img src="up.png" border=0>
           </a>
           /
          <a href="db.php?sort=cmp_idled_desc">
             <img src="down.png" border=0>
          </a>)
        </td>
        <td NOWRAP>Mesg Pen.</td>
        <td NOWRAP>Nick Pen.</td>
        <td NOWRAP>Part Pen.</td>
        <td NOWRAP>Kick Pen.</td>
        <td NOWRAP>Quit Pen.</td>
        <td NOWRAP>Quest Pen.</td>
        <td NOWRAP>LOGOUT Pen.</td>
        <td NOWRAP>
          Total Pen.
          (<a href="db.php?sort=cmp_pen_asc">
             <img src="up.png" border=0>
           </a>
           /
          <a href="db.php?sort=cmp_pen_desc">
             <img src="down.png" border=0>
          </a>)
        </td>
        <td NOWRAP>
          Acct. Created
          (<a href="db.php?sort=cmp_created_asc">
             <img src="up.png" border=0>
           </a>
           /
          <a href="db.php?sort=cmp_created_desc">
             <img src="down.png" border=0>
          </a>)
        </td>
        <td NOWRAP>
          Last Login
          (<a href="db.php?sort=cmp_lastlogin_asc">
             <img src="up.png" border=0>
           </a>
           /
          <a href="db.php?sort=cmp_lastlogin_desc">
             <img src="down.png" border=0>
          </a>)
        </td>
        <td NOWRAP>Amulet</td>
        <td NOWRAP>Charm</td>
        <td NOWRAP>Helm</td>
        <td NOWRAP>Boots</td>
        <td NOWRAP>Gloves</td>
        <td NOWRAP>Ring</td>
        <td NOWRAP>Leggings</td>
        <td NOWRAP>Shield</td>
        <td NOWRAP>Tunic</td>
        <td NOWRAP>Weapon</td>
        <td NOWRAP>
          Sum
          (<a href="db.php?sort=cmp_sum_asc">
             <img src="up.png" border=0>
           </a>
           /
          <a href="db.php?sort=cmp_sum_desc">
             <img src="down.png" border=0>
          </a>)
        </td>
      </tr>
<?php
    foreach ($file as $line) {
      list($user,
           ,$level,$class,$secs,,$uhost,$online,$idled,
           $pen['mesg'],
           $pen['nick'],
           $pen['part'],
           $pen['kick'],
           $pen['quit'],
           $pen['quest'],
           $pen['logout'],
           $created,
           $lastlogin,
           $item['amulet'],
           $item['charm'],
           $item['helm'],
           $item['boots'],
           $item['gloves'],
           $item['ring'],
           $item['leggings'],
           $item['shield'],
           $item['tunic'],
           $item['weapon'],
          ) = explode("\t",trim($line));
      $class = str_replace("<","&lt;",$class);
      $user = str_replace("<","&lt;",$user);
      $class = str_replace(">","&gt;",$class);
      $user = str_replace(">","&gt;",$user);
      $sum = 0;
      foreach ($item as $k => $v) $sum += $v;
      $pentot = 0;
      foreach ($pen as $k => $v) $pentot += $v;
      echo "      <tr>\n".
           "        <td NOWRAP>$user</td>\n".
           "        <td NOWRAP>$level</td>\n".
           "        <td NOWRAP>$class</td>\n".
           "        <td NOWRAP>".duration($secs)."</td>\n".
           "        <td NOWRAP>$uhost</td>\n".
           "        <td NOWRAP>$online</td>\n".
           "        <td NOWRAP>".duration($idled)."</td>\n".
           "        <td NOWRAP>".duration($pen['mesg'])."</td>\n".
           "        <td NOWRAP>".duration($pen['nick'])."</td>\n".
           "        <td NOWRAP>".duration($pen['part'])."</td>\n".
           "        <td NOWRAP>".duration($pen['kick'])."</td>\n".
           "        <td NOWRAP>".duration($pen['quit'])."</td>\n".
           "        <td NOWRAP>".duration($pen['quest'])."</td>\n".
           "        <td NOWRAP>".duration($pen['logout'])."</td>\n".
           "        <td NOWRAP>".duration($pentot)."</td>\n".
           "        <td NOWRAP>".date("D M j H:i:s Y",$created)."</td>\n".
           "        <td NOWRAP>".date("D M j H:i:s Y",$lastlogin)."</td>\n".
           "        <td NOWRAP>".$item['amulet']."</td>\n".
           "        <td NOWRAP>".$item['charm']."</td>\n".
           "        <td NOWRAP>".$item['helm']."</td>\n".
           "        <td NOWRAP>".$item['boots']."</td>\n".
           "        <td NOWRAP>".$item['gloves']."</td>\n".
           "        <td NOWRAP>".$item['ring']."</td>\n".
           "        <td NOWRAP>".$item['leggings']."</td>\n".
           "        <td NOWRAP>".$item['shield']."</td>\n".
           "        <td NOWRAP>".$item['tunic']."</td>\n".
           "        <td NOWRAP>".$item['weapon']."</td>\n".
           "        <td NOWRAP>$sum</td>\n".
           "      </tr>\n";
    }
?>
    </table>
    <BR><BR>
    * Accounts created before Aug 29, 2003 may have incorrect data fields.
<?include("footer.php")?>
