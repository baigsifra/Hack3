<?php
  include_once 'header.php'
 ?>

    <div id="myDIV" class="header">
      <h2>Daily Log<h2>
      <?php
        if ($_SESSION["usertype"] == "userbbs") {
          echo '<input type ="text" id="myInput" placeholder="Title...">';
          echo '<button type="button" class="addBtn" onclick="newElement();">Add</button>';
        }
       ?>
    </div>

    <ul id="myUL">
      <li> </li>
    </ul>
    <script>
      var dailyLog = document.getElementsByTagName("LI");
      var x;
      for (x = 0; x < dailyLog.length; x++) {
        var s = document.createElement("SPAN");
        var t = document.createTextNode("\u00D7");
        s.className = "close";
        s.appendChild(t);
        dailyLog[x].appendChild(s);
      }

      // Click on a close button to hide the current list item
      var closeBttn = document.getElementsByClassName("close");
      var x;
      for (x = 0; x < close.length; x++) {
        closeBttn[x].onclick = function() {
          var div = this.parentElement;
          div.style.display = "none";
        }
      }

      // Create a new list item when clicking on the "Add" button
      function newElement() {
        var li = document.createElement("li");
        var inputValue = document.getElementById("myInput").value;
        var t = document.createTextNode(inputValue);
        li.appendChild(t);
        if (inputValue === '') {
          alert("You must write something!");
        } else {
          document.getElementById("myUL").appendChild(li);
        }
        document.getElementById("myInput").value = "";

        var span = document.createElement("SPAN");
        var txt = document.createTextNode("\u00D7");
        span.className = "close";
        span.appendChild(txt);
        li.appendChild(span);

        for (i = 0; i < closeBttn.length; i++) {
          closeBttn[i].onclick = function() {
            var div = this.parentElement;
            div.style.display = "none";
          }
        }
      }

      function grabList() {
        let array = [];

        let list = document.getElementById("myUL");
        let tasks = list.getElementsByTagName('li');


        for (var i = 0; i < tasks.length; i++) {
          let str = tasks[i].innerText;
          str = str.substring(0, str.length - 2);
          array.push(str);
        }
        array.shift();
        console.log(array);
        post(array);
      }

      function post(list) {
        $.post('includes/reports.inc.php', {fullList:list},
        function(data) {
          $('myDIV').html(data);
          console.log(data);
        });
      }
    </script>
  </body>
</html>
