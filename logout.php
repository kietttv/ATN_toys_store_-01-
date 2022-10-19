<?php
    session_start();
    session_unset();
    session_destroy();
    echo"<div class = 'alert' role = 'alert'>You have clearned session!</div>";
    header("Refresh:2; URL=index.php");
  ?>