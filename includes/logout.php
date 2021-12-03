<?php
// logout and delete session
session_start();
session_unset();
session_destroy();
header("location: /");
exit();