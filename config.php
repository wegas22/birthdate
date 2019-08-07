<?php
//проект давольно давно написан, поэтому есть разные способы написания подключения к бд... но предпочтительно используется этот способ...
$mysqli = mysqli_connect("localhost", "root", "", "student");
if (mysqli_connect_errno($mysqli)) {
    echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
}
