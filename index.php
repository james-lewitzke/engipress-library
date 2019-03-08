<?php
$dir = basename(dirname(__FILE__));
header("Location: ../updates/?action=get_metadata&slug=".$dir);
?>
