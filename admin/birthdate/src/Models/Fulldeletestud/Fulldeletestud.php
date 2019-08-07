<?php

namespace Birthdate;

class Fulldeletestud
{
    public $dir;
    public $studentid;

    //функция сохранения файла
    public function fulldeldstud()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $result = mysqli_query($mysqli, "SELECT * FROM `student` WHERE studentid = $this->studentid");
        while ($row = mysqli_fetch_array($result)) {
            $sql = mysqli_query($mysqli, "DELETE FROM student WHERE id = $row[0]");
            echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
        }
        echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
    }
}
