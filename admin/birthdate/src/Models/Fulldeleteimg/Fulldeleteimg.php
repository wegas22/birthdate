<?php

namespace Birthdate;

class Fulldelete
{

    public $dir;
    public $studentid;
    //функция сохранения файла
    public function fulldel()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $studentid = $this->studentid;
        $result = mysqli_query($mysqli, "SELECT * FROM `student`, `studentgroup` WHERE student.studentid = $studentid and student.studentid = studentgroup.studentid and photochash IS NOT NULL");
        //echo $this->studentid;
        while ($row = mysqli_fetch_array($result)) {
            //echo $row[photochash]."</br>";
            //берем название файла
            $dir = $row[photochash];
            //если файл существует
            if (file_exists($dir)) {
                //удаляем
                $del = unlink($dir);
                echo 'Удалено: ' . $dir . ' Статус удаления:' . $del . ' id элемента: ' . $row[0] . '</br>';
                $sql = mysqli_query($mysqli, "UPDATE `student` SET photochash= NULL WHERE id = $row[0]");
                echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
            } else {
                echo 'Нет такого файла ' . 'id элемента: ' . $row[0] . '</br>';
                $sql = mysqli_query($mysqli, "UPDATE `student` SET photochash= NULL WHERE id = $row[0]");
                echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
            }
        }
        echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
    }
}
