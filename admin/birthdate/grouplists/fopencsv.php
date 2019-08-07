<?php

$has_title_row = true;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(is_uploaded_file($_FILES['csvfile']['tmp_name'])){
        $filename = basename($_FILES['csvfile']['name']);
        
        if(substr($filename, -3) == 'csv'){
            echo "<label class='form-control'><center>$filename</center></label>";
            $tmpfile = $_FILES['csvfile']['tmp_name'];
            if (($file = fopen($tmpfile, "r")) !== FALSE) {
                $a = 1;
                echo '<table id="customers" cellspacing = "0" border = "1" width = "500">';
                    echo '<tr align = "center">';
                    echo '<td width = "5%">';
                    echo 'id';
                    echo '</td>';
                    echo '<td width = "35%">';
                    echo 'Фамилия';
                    echo '</td>';
                    echo '<td width = "7%">';
                    echo 'Имя';
                    echo '</td>';
                    echo '<td width = "7%">';
                    echo 'Отчество';
                    echo '</td>';
                    echo '<td width = "7%">';
                    echo 'Дата рождения';
                    echo '</td>';
                    echo '<td width = "7%">';
                    echo 'Телефон';
                    echo '</td>';
                    echo '</tr>';
                while (($mass = fgetcsv($file, 1024, ';')) !== FALSE) {
                    $j = count($mass);
                   
                    if ($j >1){
                    
                    echo '<tr align = "center">';
                    echo '<td width = "5%">';
                    echo $a;
                    echo '</td>';
                    echo '<td width = "25%">';
                    echo $mass[0];
                    echo '</td>';
                    echo '<td width = "5%">';
                    echo $mass[1];
                    echo '</td>';
                    echo '<td width = "5%">';
                    echo $mass[2];
                    echo '</td>';
                    echo '<td width = "5%">';
                    echo $mass[3];
                    echo '</td>';
                    echo '<td width = "5%">';
                    echo $mass[4];
                    echo '</td>';
                    echo '</tr>';

                    $a = $a +1;
                   
                    }
                }
            }
        }
        else{
            echo '<label class="form-control"><center>Неверный формат файла. Загрузите CSV file</center></label>';
        }
    }
    else{
        echo '<label class="form-control"><center>Загрузите CSV file</center></label>';
    }
}
echo '</table>';
