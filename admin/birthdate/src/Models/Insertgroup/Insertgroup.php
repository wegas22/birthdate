<?php

namespace Birthdate;

class Insertgroup
{
    public $stage;
    public $title;

    public function save()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $stage = $this->stage;
        $title = $this->title;
        if (($stage != '') and ($title != '')) {
            $timestamp = time();
            mysqli_query($mysqli, "INSERT INTO `studentgroup` (`stage`, `title`, `studentid`) VALUES ($stage, '$title', $timestamp);");
            echo '<META HTTP-EQUIV=Refresh Content="0;URL=../index.php">';
        } else {
            echo 'Ошибка: Поля не заполнены!!!';
        }
    }
}
