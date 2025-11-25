<?php
session_start();
session_unset();
session_destroy();
header("Location: ..interface/interface.php"); //Uma página pra entrar ao sair do login
exit;