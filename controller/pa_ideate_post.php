<?php

//Start the session if it's not already done
if (!isset($_SESSION)) {
    session_start();
}

include('../model/post_note.php');

$id_activity = $_SESSION['id_activity3'];
$id_group = $_SESSION['id_group'];
$id_participant = $_SESSION['id'];
$author = $_POST['note-name'];
$body = $_POST['note-body'];
$color = $_POST['color'];
$xindex = random_int(50, 900);
$yindex = random_int(10, 50);
$zindex = (int)$_POST['zindex'];

postNote($bdd, $id_activity, $id_group, $id_participant, $author, $body, $color, $xindex, $yindex, $zindex);

header('location: ../view/pa_ideate_demo.php');