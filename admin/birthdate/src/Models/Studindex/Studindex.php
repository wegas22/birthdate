<?php

namespace Birthdate;

class Studindex
{
    public $json;
    public $table = "studentgroup";
    public $order = "stage";

    function selectbrit()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $result = mysqli_query($mysqli, "SELECT * FROM  $this->table ORDER BY $this->order");
        while ($row = mysqli_fetch_array($result)) {
            $json[] = ['id' => $row[id], 'stage' => $row[stage], 'title' => $row[title], 'orgid' => $row[orgid], 'studentid' => $row[studentid]];
            $this->json = $json;
        }
    }
}
