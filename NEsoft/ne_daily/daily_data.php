<?php
include_once('daily_arrays.php');

header("Content-Type: application/json");

$idx = $_POST['idx'];

$date = $post_date[$idx];
$title = $post_tit[$idx];
$hash = $post_hash[$idx];
$img_filename = $post_img[$idx];
$note = $post_note[$idx];

$result = [$date, $title, $hash, $img_filename, $note];

echo json_encode($result);