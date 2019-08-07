<?php

namespace Birthdate;

class Unload
{
    public $studentid;


    public function unloadsave()
    {
        $a = $_GET['studentid'];
        //echo $a;
        if ($a != NULL and $a != 0) {
            include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
            //if(isset($_POST["export"])){
            header('Content-Type: text/csv; charset=utf-8');
            $test = 'test' . date("Y.m.d.H_i_s");
            header('Content-Disposition: attachment; filename=' . $test . '.csv');
            $output = fopen("php://output", "w");
            //fputcsv($output, array('t', 'h', 'm', 'h2', 'm2', 'sort', 'otobr', 'lessontitle', 'lesid'));
            //$query = "SELECT t,h,m,h2,m2,sort,lessontitle,lesid FROM $name order by `sort`";
            $result = mysqli_query($mysqli, "SELECT fname, lname, mname, birthdate,tel, stage, title FROM `student`, `studentgroup` WHERE studentgroup.studentid = $a and student.studentid = $a and student.studentid = studentgroup.studentid");
            while ($row = mysqli_fetch_assoc($result)) {
                fputcsv($output, $row, ";");
            }
            fclose($output);
            //}
        }
    }
}
