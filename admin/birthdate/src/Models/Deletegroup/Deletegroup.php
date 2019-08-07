<?php

namespace Birthdate;

class Deletegroup
{
    public $id;
    public $table = 'studentgroup';
    public function removegroup()
    {
        if (isset($this->id)) {
            include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
            $id = $this->id;
            $result = mysqli_query($mysqli, "DELETE FROM $this->table WHERE id = '$id'");
            if ($result == 1) {
                echo '<div class="container">Успешно</div>';
                echo '<META HTTP-EQUIV=Refresh Content="0;URL=../index.php">';
            } else {
                echo 'Что - то пошло не так, (скорее всего в группе есть ученики, прежде чем удалить группу, удалите или перенесите всех учеников) <a href="../index.php">Назад</a>';
            }
            // mysql_query("INSERT INTO `label` (metka) VALUES ('$metka')"); 

        }
    }
}
