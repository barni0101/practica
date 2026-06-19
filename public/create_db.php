<?php
$servername = "localhost";
$username = "root";
$password = ""; // Если пароль есть, укажите его

// Создаём подключение
$conn = new mysqli($servername, $username, $password);

// Проверяем подключение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Создаём базу данных
$sql = "CREATE DATABASE ci4";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully!";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>