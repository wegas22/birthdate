<?php include($_SERVER['DOCUMENT_ROOT'] . "/config.php"); ?>
<?php
$has_title_row = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (is_uploaded_file($_FILES['csvfile']['tmp_name'])) {
        $filename = basename($_FILES['csvfile']['name']);

        if (substr($filename, -3) == 'csv') {
            echo "<label class='form-control'><center>$filename</center></label>";
            $tmpfile = $_FILES['csvfile']['tmp_name'];
            if (($file = fopen($tmpfile, "r")) !== FALSE) {
                $i = 0;
                //echo $_POST['studentid'];
                //определим studentid    
                //$result = mysql_query("SELECT studentid FROM `studentgroup` WHERE stage = 1 and title = 'А'");
                //$row = mysql_fetch_array($result);

                //$studentid = $row[0]; 
                $studentid = $_POST['studentid'];
                while (($mass = fgetcsv($file, 1024, ';')) !== FALSE) {
                    $j = count($mass);
                    $a = $a + 1;
                    if ($j > 1) {


                        $sql = mysqli_query($mysqli, "INSERT INTO `student` (fname, lname, mname, birthdate, tel, studentid) VALUES ('$mass[0]', '$mass[1]', '$mass[2]', '$mass[3]', '$mass[4]', $studentid)");
                        //echo $mass[0];

                        //mysql_query("INSERT INTO $mysqlTable (`t`, `h`, `m`, `h2`, `m2`, `sort`, `lessontitle`, `lesid`) VALUES ('{$mass[0]}', '{$mass[1]}','{$mass[2]}','{$mass[3]}','{$mass[4]}', '{$mass[5]}', '{$mass[6]}', '{$mass[7]}' )");

                        $i++;
                    }
                }
                echo "<br><label class='form-control'><center>Файл загружен $filename</center></label>";
            }
        } else {
            echo '<label class="form-control"><center>Неверный формат файла. Загрузите CSV file</center></label>';
        }
    } else {
        echo '<label class="form-control"><center>Загрузите CSV file</center></label>';
    }
}

?>