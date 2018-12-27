<?php
    require 'db.php';

    $id = $_GET["id"];
    $sql = "DELETE FROM tasks WHERE id=$id";

    $statement = $db->query($sql);

    header("location: index.php");
    exit();