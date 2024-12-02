<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $tmpFilePath = $file['tmp_name'];
    $name = $file['name'];


    $realFilePath = realpath($tmpFilePath);

    if (file_exists($realFilePath)) {
        echo "Файл $name существует.";
    } else {
        echo "Файл $name не найден.";
    }

} else {
    echo "Неверный запрос.";
}
?>