<?php

namespace Birthdate;

class EditSelect
{
    public $stage;
    public $title;

    public $id;

    public $editstage;
    public $edittitle;

    public function select()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $id = $this->id;
        $result = mysqli_query($mysqli, "SELECT * FROM `studentgroup` WHERE id = $id");
        $row = mysqli_fetch_array($result);
        $this->stage = $row[stage];
        $this->title = $row[title];
    }

    public function save()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $id = $_GET['id'];
        $stage = $this->editstage;
        $title = $this->edittitle;
        mysqli_query($mysqli, "UPDATE studentgroup SET stage='$stage', title='$title'  WHERE id='$id'");
        //$metka = time(); 
        echo 'Успех';
        echo '<META HTTP-EQUIV=Refresh Content="0;URL=../index.php">';
    }
}
