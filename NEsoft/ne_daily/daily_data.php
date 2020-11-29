<?php
include_once('daily_arrays.php');

header("Content-Type: application/json"); //json type 일 경우 필요

$idx = $_POST['idx'];

$date = $post_date[$idx];
$title = $post_tit[$idx];
$hash = $post_hash[$idx];
$img_filename = $post_img[$idx];

$result = [$date, $title, $hash, $img_filename];

echo json_encode($result);