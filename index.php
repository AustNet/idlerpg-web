<html><head><title>#G7 IRPG: Game Info</title>
<?include("header.php")?>

    <p>The Idle RPG is just what it sounds like: an RPG in which the
    players idle. In addition to merely gaining levels, players can find
    items and battle other players. However, this is all done for you;
    you just idle. There are no set classes; you can name your character
    anything you like, and have its class be anything you like, as well.</p>

    <span class="head1">Location</span>
    <blockquote>
      <p>
        The IRPG can be played on the <a href="http://www.slashnet.org/">
        SlashNet IRC Network</a> in the channel #G7. See <a 
        href="http://www.slashnet.org/servers/">this</a> link for a list of
        servers.
      </p>
    </blockquote>

    <span class="head1">Registering</span>
    <blockquote>
      <p>To register, simply:</p>
      <blockquote>
        <code>
          /msg bot REGISTER &lt;char name&gt; &lt;password&gt; &lt;char
          class&gt;
        </code>
      </blockquote>
      <p>Where 'char name' can be up to 16 chars long, 'password' can be up
      to 8 characters, and 'char class' can be up to 30 chars.</p>
    </blockquote>

    <span class="head1">Logging in</span>
    <blockquote>
      <p>To login, simply:</p>
      <blockquote>
        <code>
          /msg bot LOGIN &lt;char name&gt; &lt;password&gt;
        </code>
      </blockquote>
      <p>This is a p0 (see <a href="#penalties">Penalties</a>) command.</p>
    </blockquote>

    <span class="head1">Logging Out</span>
    <blockquote>
      <p>To logout, simply:</p>
      <blockquote>
        <code>
          /msg bot LOGOUT
        </code>
      </blockquote>
      <p>This is a p20 (see <a href="#penalties">Penalties</a>) command.</p>
    </blockquote>

    <span class="head1">Leveling</span>
    <blockquote>
      <p>To gain levels, you must only be logged in and idle. The time
      between levels is based on your character level, and is calculated
      by the formula:</p>
      <blockquote>
        600*(1.16^YOUR_LEVEL)
      </blockquote>
      <p>Where ^ represents power.</p>
    </blockquote>

    <span class="head1">Checking the active quest</span>
    <blockquote>
      <p>To see the active quest, its users, and its time left to
      completion:</p>
      <blockquote>
        <code>
          /msg bot QUEST
        </code>
      </blockquote>
      <p>This is a p0 (see <a href="#penalties">Penalties</a>) command.</p>
    </blockquote>

    <span class="head1">Checking your online status</span>
    <blockquote>
      <p>To see whether you are logged on, simply:</p>
      <blockquote>
        <code>
          /msg bot WHOAMI
        </code>
      </blockquote>
      <p>This is a p0 (see <a href="#penalties">Penalties</a>) command.</p>
    </blockquote>

    <a name="penalties"><span class="head1">Penalties</span></a>

    <blockquote>
      <p>If you do something other than idle, like part, quit, talk in the
      channel, change your nick, or notice the channel, you are
      penalized. The penalties are time, in seconds, added to your next
      time to level and are based on your character level. The formulae
      are as follows:</p>

	  <table bgcolor="#000000" cellpadding="0" cellspacing="1" border="0"><tbody><tr><td bgcolor="#ffffff">
      <table border="0" cols="3" rows="6" cellspacing="0" cellpadding="2">
        <tbody>
        <tr>
          <td align="right" nowrap="nowrap"><b>Nick change</b></td>
          <td rowspan="8" width="5" background="tablegrad.gif"><img src="fake.gif" width="5" height="5"></td>
          <td nowrap="nowrap">30*(1.14^(YOUR_LEVEL))</td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap"><b>Part</b></td>
          <td nowrap="nowrap">200*(1.14^(YOUR_LEVEL))</td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap"><b>Quit</b></td>
          <td nowrap="nowrap">20*(1.14^(YOUR_LEVEL))</td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap"><b>LOGOUT command</b></td>
          <td nowrap="nowrap">20*(1.14^(YOUR_LEVEL))</td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap"><b>Being Kicked</b></td>
          <td nowrap="nowrap">250*(1.14^(YOUR_LEVEL))</td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap"><b>Channel privmsg</b></td>
          <td nowrap="nowrap">[message_length]*(1.14^(YOUR_LEVEL))</td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap"><b>Channel notice</b></td>
          <td nowrap="nowrap">[message_length]*(1.14^(YOUR_LEVEL))</td>
        </tr>
      </tbody></table>
      </td></tr></tbody></table>
      <br>
      <p>So, a level 25 character changing their nick would be penalized
      793 seconds towards their next level.</p>
      <p>Penalty shorthand is p[num]. So, a nick change is a p30 event,
      parting the channel is a p200 event, and quitting IRC is a p20 event.
      Messages and notices are p[length of message in characters].</p>
    </blockquote>

    <span class="head1">Items</span>
    <blockquote>
      <p>Each time you level, you find an item. You can find an item as
      high as 1.5*YOUR_LEVEL (unless you find a <a href="#uniqueitems">
      unique item</a>). There are 10 types of items: rings,
      amulets, charms, weapons, helms, tunics, gloves, leggings,
      shields, and boots. You can find one of each type. When you find
      an item with a level higher than the level of the item you already
      have, you toss the old item and start using the new one. There is
      no way to see what items you have over irc, but you can see which
      items you have on the web <a href="players.php">here</a>.</p>

      <p>As you may guess, you have a higher chance of rolling an item
      below your character level than you do of rolling one above your
      level. The exact formula is as follows:</p>
      <blockquote>
           for each 'number' from 1 to YOUR_LEVEL*1.5<br>
           &nbsp;&nbsp;you have a 1 / ((1.4)^number) chance to find an
           item at this level<br>
           end for
      </blockquote>
      <p>As for item type, you have an equal chance to roll any
      type.</p>
      <p>Note that because of this formula's inability to roll an item less
      than level 5, it may change in the near future.</p>
    </blockquote>


    <span class="head1">Battle</span>
    <blockquote>
      <p>Each time you level, if your level is less than 25, you have a 25%
      chance to challenge someone to combat. If your level is greater
      than or equal to 25, you have a 100% chance to challenge someone.
      A pool of opponents is chosen of all online players, and one is
      chosen randomly. If there are no online players, you fight no one.
      However, if you do challenge someone, this is how the victor is
      decided:</p>
      <ul>
      <li>Your item levels are summed.</li>
      <li>Their item levels are summed.</li>
      <li>A random number between zero and your sum is taken.</li>
      <li>A random number between zero and their sum is taken.</li>
      <li>If your number is larger than their number, you win.</li>
      </ul>
      <p>If you win, your time towards your next level is lowered. The
      amount that it is lowered is based on your opponent's level. The
      formula is:</p>
      <blockquote>
         ((the larger number of (OPPONENT_LEVEL/4) and 7) / 100) * YOUR_NEXT_TIME_TO_LEVEL
      </blockquote>
      <p>This means that you lose no less than 7% from your next time to level.
      If you win, your opponent is not penalized any time, unless you land a
      <a href="#critstrike">Critical Strike</a>.</p>
      <p>If you lose, you will be penalized time. The penalty is calculated
      using the formula:</p>
      <blockquote>
        ((the larger number of (OPPONENT_LEVEL/7) and 7) / 100) * YOUR_NEXT_TIME_TO_LEVEL
      </blockquote>
      <p>This means that you gain no less than 7% of your next time to level.
      If you lose, your opponent is not awarded any time.</p>
      <p>Battling the IRPG bot is a special case. The bot has an item sum of
      1+[highest sum of all players]. The percent awarded if you win is a
      constant 20%, and the percent penalized if you lose is a constant 10%.</p>
    </blockquote>
    
    <a name="uniqueitems"><span class="head1">Unique Items</span></a>
    <blockquote>
      <p>As of v2.1.2, after level 25, you have a chance to roll items
      significantly higher than items you would normally find at that level.
      These are unique items, and have the following stats:</p>
      <blockquote>
        <b>Name</b>: Mattt's Omniscience Grand Crown<br>
        <b>Item Level</b>: 50-74<br>
        <b>User Level</b>: 25 or greater<br>
        <b>Chance to Roll</b>: 1 / 40<br><br>

        <b>Name</b>: Res0's Protectorate Plate Mail<br>
        <b>Item Level</b>: 75-99<br>
        <b>User Level</b>: 30 or greater<br>
        <b>Chance to Roll</b>: 1 / 40<br><br>

        <b>Name</b>: Dwyn's Storm Magic Amulet<br>
        <b>Item Level</b>: 100-124<br>
        <b>User Level</b>: 35 or greater<br>
        <b>Chance to Roll</b>: 1 / 40<br><br>

        <b>Name</b>: Jotun's Fury Colossal Sword<br>
        <b>Item Level</b>: 150-174<br>
        <b>User Level</b>: 40 or greater<br>
        <b>Chance to Roll</b>: 1 / 40<br><br>

        <b>Name</b>: Drdink's Cane of Blind Rage<br>
        <b>Item Level</b>: 175-200<br>
        <b>User Level</b>: 45 or greater<br>
        <b>Chance to Roll</b>: 1 / 40<br><br>
        
      </blockquote>
    </blockquote>
    
    <span class="head1">The Hand of God</span>
    <blockquote>
      <p>As of v2.0.3, every 5 seconds there is a 1/4,000 chance of a
      "Hand of God" occurring. HoG can help or hurt your character by carrying
      it between 5 and 75 percent towards or away from its next time to
      level. The odds are in your favor, however, with an 80% chance to help
      your character, and only a 20% chance of your character being smitten.</p>
      <p>In addition to occurring randomly, admins may summon the HoG at their
      will.</p>
    </blockquote>

    <a name="critstrike"><span class="head1">Critical Strike</span></a>
    <blockquote>
      <p>As of v2.0.4, if a challenger beats his opponent in battle, he has a
      1/35 chance of landing a Critical Strike. If this occurs, his opponent
      is penalized time towards his next time to level. This amount is
      calculated by the formula:</p>
      <blockquote>
        ((random number from 5 to 25) / 100) * OPPONENT'S_NEXT_TIME_TO_LEVEL
      </blockquote>
      <p>Meaning he gains no less than 5% and no more than 25% of his next time
      to level.</p>
    </blockquote>

    <span class="head1">Team Battles</span>
    <blockquote>
      <p>As of v2.2, there is a 1/4,000 chance every five seconds of a
      'team battle.' Team battles pit three online players against three other
      online players. Each side's items are summed, and a winner is chosen
      as in regular battling. If the first group bests the second group in
      combat, 20% of the lowest of the three's TTL is removed from their
      clocks. If the first group loses, 20% of their lowest member's TTL is
      added to their TTL.</p>
    </blockquote>

    <span class="head1">Calamities</span>
    <blockquote>
      <p>As of v2.3, there is a 1/4,000 chance every five seconds of a
      calamity occurring. A calamity is a bit of extremely bad luck that
      slows a player 5-12% of their next time to level. Calamities only occur
      for online players.</p>
    </blockquote>

    <span class="head1">Godsends</span>
    <blockquote>
      <p>As of v2.3, there is a 1/2,000 chance every five seconds of a
      godsend occurring. A godsend is a bit of extremely good luck that
      accelerates a player 5-12% of their next time to level. Godsends only
      occur for online players.</p>
    </blockquote>

    <span class="head1">Quests</span>
    <blockquote>
      <p>As of v2.3, there are Quests. Four level 40+ users that have been
      online for more than ten hours are chosen to represent and assist the
      Realm by going on a quest. If all four users make it to the quest's end,
      all questers are awarded by removing 25% of their TTL (ie, their TTL at
      quest's end). To complete a quest, no user can be penalized until the
      quest's end. Quests last a random time between 12 and 24 hours. If the
      quest is not completed, ALL online users are penalized a p15 as
      punishment.</p>
    </blockquote>

    <span class="head1">Credits</span>
    <blockquote>
      <p>
        The IRPG would not be possible without help from a lot of people.
        To jwbozzy, yawnwraith, Tosirap, res0, dwyn, Parallax, protomek,
        Bert, clavicle, drdink, jeff, rasher, Sticks, Nerje, Asterax,
        emad, inkblot(!), schmolli, mikegrb, mumkin, sean, Minhiriath,
        and Dan, I give many thanks. If I've forgotten your name here, e-mail
        me!
      </p>
    </blockquote>
<?include("footer.php")?>

