<?php

namespace Birthdate;

class Deletestud
{
    public $id;

    public function imgdelete()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $id = $this->id;
        $result = mysqli_query($mysqli, "SELECT * FROM `student` WHERE id = $id");
        $row = mysqli_fetch_array($result);
        //echo $row[photochash]."</br>";
        //берем название файла
        $dir = $row[photochash];
        //если файл существует
        if (file_exists($dir)) {
            //удаляем
            $del = unlink($dir);
            echo 'Удалено: ' . $dir . ' Статус удаления:' . $del . ' id элемента: ' . $row[0] . '</br>';
            $sql = mysqli_query($mysqli, "UPDATE `student` SET photochash= NULL WHERE id = $row[0]");
            //echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
        } else {
            echo 'Нет такого файла ' . 'id элемента: ' . $row[0] . '</br>';
            $sql = mysqli_query($mysqli, "UPDATE `student` SET photochash= NULL WHERE id = $row[0]");
            //echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
        }
    }
    //функция сохранения файла
    public function deldstud()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $id = $this->id;
        $sql = mysqli_query($mysqli, "DELETE FROM student WHERE id = $id");
        echo 'Успешно удален';
        echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
    }
}
