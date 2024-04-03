<?php

require("../session.php");

$subject = htmlspecialchars(trim(strip_tags($_GET['valor'])));
$_SESSION['subject'] = $subject;

header("location: ../principal.php");

