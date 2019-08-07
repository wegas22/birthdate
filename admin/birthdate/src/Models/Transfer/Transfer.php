<?php

namespace Birthdate;

class Transfer
{

    public function postsave()
    {

        //$id = mysql_real_escape_string($_GET['id']);
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $result2 = mysqli_query($mysqli, "SELECT * FROM studentgroup WHERE stage != 0");
        while ($row2 = mysqli_fetch_array($result2)) {
            $sum2 = $row2[stage] + 1;
            $id = $row2[id];
            $title = $row2[title];
            //echo $id. ' '.$sum2."</br>";
            mysqli_query($mysqli, "UPDATE studentgroup SET stage='$sum2' WHERE id='$id'");
            echo 'Результат: id = ' . $id . ' Класс = ' . $sum2 . $title . "</br>";
        }
        echo 'Успешно переведены на класс выше </br>  <a href="index.php">Назад</a>';
    }

    public function postsave2()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $result2 = mysqli_query($mysqli, "SELECT * FROM studentgroup WHERE stage != 0");
        while ($row2 = mysqli_fetch_array($result2)) {
            $sum2 = $row2[stage] - 1;
            if ($sum2 == 0) {
                echo 'Что-то пошло не так. Скорее всего уменьшать ниже 1 класса нельзя </br>';
                break;
            }
            $id = $row2[id];
            $title = $row2[title];
            //echo $id. ' '.$sum2."</br>";
            mysqli_query($mysqli, "UPDATE studentgroup SET stage='$sum2' WHERE id='$id'");
            echo 'Результат: id = ' . $id . ' Класс = ' . $sum2 . $title . "</br>";
        }
        echo 'Успешно переведены на класс ниже </br> <a href="../index.php">Назад</a>';
    }
}
