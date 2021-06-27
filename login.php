<?php
  include_once 'header.php'
 ?>

  <section class="signup-form">
    <h2>Log In</h2>
    <form action="includes/login.inc.php" method="post">
      <label for="email">Email: </label>
      <input type="email" id="email" name="email" placeholder="email@example.com">
      <br>
      <label for="pwd">Password: </label>
      <input type="password" id="pwd" name="pwd" placeholder="Password...">
      <button type="submit" name="submit">Log In</button>
    </form>
    <?php
      if (isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
          echo "<p>Please fill in all fields</p>";
        } else if ($_GET["error"] == "wronglogin") {
          echo "<p>Your email/password is incorrect</p>";
        }
      }
     ?>
  </section>

<?php
  include_once 'footer.php'
 ?>
