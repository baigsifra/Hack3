<?php
  include_once 'header.php'
 ?>

  <section class="link-form">
    <h2>Link with Babysitter</h2>
    <form action="includes/link.inc.php" method="post">
      <h4>Please enter the email of your babysitter</h4>
      <label for="email">Email: </label>
      <input type="email" id="linkEmail" name="email" placeholder="email@example.com">
      <button type="submit" name="submit">Link</button>
    </form>
    <?php
      if (isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
          echo "<p>Please fill in all fields</p>";
        }
        if($_GET["error"] == "noemail") {
          echo "<p>That email does not exist</p>";
        }
        if($_GET["error"] == "notbbs") {
          echo "<p>That email is not registered as a babysitter</p>";
        }
      }
      if (isset($_GET["info"])) {
        echo '<p>Confirm whether the following information is correct. If not, please enter a different email.</p>';
        echo '<p>First Name: '.$_SESSION['bbsfname'].'</p>';
        echo '<p>Last Name: '.$_SESSION['bbslname'].'</p>';
        echo '<p>Email: '.$_SESSION['bbsemail'].'</p>';
        echo '<form action="includes/confirmlink.inc.php" method="post">';
        echo '<button type="submit" name="submit">Confirm</button>';
        echo '</form>';
      }
     ?>
  </section>

<?php
  include_once 'footer.php'
 ?>
