<?php
  include_once 'header.php'
 ?>

  <section class="signup-form">
    <h2>Sign Up</h2>
    <form action="includes/signup.inc.php" method="post">
      <label for="fname">First Name: </label>
      <input type="text" id="fname" name="fname" placeholder="First name...">
      <br>
      <label for="lname">Last Name: </label>
      <input type="text" id="lname" name="lname" placeholder="Last name...">
      <br>
      <label for="email">Email: </label>
      <input type="email" id="email" name="email" placeholder="email@example.com">
      <br>
      <label for="pwd">Password: </label>
      <input type="password" id="pwd" name="pwd" placeholder="Password...">
      <br>
      <label for="repeatpwd">Repeat Password: </label>
      <input type="password" id="repeatpwd" name="repeatpwd" placeholder="Repeat password...">
      <br>
      <h4>What type of user are you?</h4>
      <input type="radio" id="userbbs" name="user" value="userbbs">
      <label for="userbbs">Babysitter</label>
      <input type="radio" id="userp" name="user" value="userp">
      <label for="userp">Parent</label>
      <br>
      <button type="submit" name="submit">Sign Up</button>
    </form>
    <?php
      if (isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
          echo "<p>Please fill in all fields</p>";
        } else if ($_GET["error"] == "invalidemail") {
          echo "<p>Please enter a valid email</p>";
        } else if ($_GET["error"] == "pwderror") {
          echo "<p>Passwords did not match</p>";
        } else if ($_GET["error"] == "emailtaken") {
          echo "<p>This email is already taken</p>";
        } else if ($_GET["error"] == "stmtfailed") {
          echo "<p>An error occured. Please try again</p>";
        } else if ($_GET["error"] == "none") {
          echo "<p>You have signed up!</p>";
        }
      }
     ?>
  </section>

<?php
  include_once 'footer.php'
 ?>
