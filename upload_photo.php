<?php
$photo = $_FILES['photo'];
$photo_name = basename($photo['name']);

$photo_path = "member_photos/" . $photo_name;
$allowed_ext = ['png', 'jpeg', 'jpg', 'gif'];

$ext = pathinfo($photo_name, PATHINFO_EXTENSION);

// Provjerite je li ekstenzija i veličina datoteke ispravna
if (in_array($ext, $allowed_ext) && $photo['size'] < 2000000) {
    if (move_uploaded_file($photo['tmp_name'], $photo_path)) {
        echo json_encode(['success' => true, 'photo_path' => $photo_path]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error moving the file']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid file']);
}
?>
    