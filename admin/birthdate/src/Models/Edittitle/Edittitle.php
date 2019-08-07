<?php

namespace Birthdate;

class Edittitle
{
    public $columns;
    public $columns2;
    public $id;
    public $table = 'studenttitle_headline';

    function headertitle()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $result3 = mysqli_query($mysqli, "SELECT * FROM $this->table");

        while ($row = mysqli_fetch_assoc($result3)) {
            $columns["$row[name]"] = $row['title']; // выводит заголовок из бд
            $columns2["$row[smalltext]"] = $row['titlesmall']; // выводит small заголовки из бд
            $id["$row[name]"] = $row['id']; // выводит id заголовка из бд
            extract($columns2);
            extract($columns);
            extract($id);
            $this->columns = $columns;
            $this->columns2 = $columns2;
            $this->id = $id;
        }
    }
}
