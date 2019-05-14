<?php

session_start();
unset($_SESSION["autenticado"]);
header("Location: index.html");

  ?>