<?php include($_SERVER['DOCUMENT_ROOT'] . "/config.php"); ?>
<?php
//процедурный стиль "переделать"!!
//$a = $_POST['stage'];
//$b = $_POST['title'];
$d = $_POST['studentid'];
$c = $_POST['id'];
echo 'Результат: id: ' . $c . ' id группы: ' . $d . '</br>';

define('MAX_SIZE', '9000');
function getExtension($str)
{
    $i = strrpos($str, '.');
    if (!$i) {
        return '';
    }
    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);

    return $ext;
}

$valid_formats = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploaddir = 'uploads/'; //a directory inside
    include 'classSimpleImage.php';
    $zapisid = $_POST['id'];
    foreach ($_FILES['photos']['name'] as $name => $value) {
        $filename = stripslashes($_FILES['photos']['name'][$name]);

        $size = filesize($_FILES['photos']['tmp_name'][$name]);
        //get the extension of the file in a lower case format
        $ext = getExtension($filename);
        $ext = strtolower($ext);

        // действия с классом classSimpleImage
        $image = new SimpleImage();
        $image->load($_FILES['photos']['tmp_name'][$name]);
        $image->resizeToWidth(225);
        $image->save($_FILES['photos']['tmp_name'][$name]);

        //удаление файлов
        $result3 = mysqli_query($mysqli, "SELECT * FROM student, studentgroup WHERE tableid = '$zapisid' and student.studentid = $d and student.studentid = studentgroup.studentid");
        while ($row = mysqli_fetch_array($result3)) {
            $dir = '';
            if ($row['photochash'] == NULL) { } else {
                // удаляем файл
                $dirdel = $dir . $row['photochash'];
                if (file_exists($dirdel)) {

                    $del = unlink($dir . $row['photochash']);
                    echo 'Удалено: ' . $row['photochash'] . ' Статус удаления:' . $del . '</br>';
                } else {
                    echo "Файл " . $dir . $row['photochash'] . " не существует </br>";
                }
            }
        }



        //запись на сервер и вывод на страницу
        //mysql_query("update student set student_id=@num:=@num+1 where 0 in(select @num:=0) and stage = '1' and title = 'Б'");
        $result2 = mysqli_query($mysqli, "SELECT * FROM student, studentgroup WHERE tableid = '$zapisid' and student.studentid = $d and student.studentid = studentgroup.studentid");
        echo '<table id="customers" cellspacing = "0" border = "1" width = "500">';
        while ($row = mysqli_fetch_array($result2)) {
            //echo '<pre>';
            // print_r($row);
            //echo '</pre>';

            if (in_array($ext, $valid_formats)) {

                if ($size < (MAX_SIZE * 1024)) {
                    $time = time();
                    $image_name = rand() . $time . '.' . $ext;
                    $newname = $uploaddir . $image_name;
                    echo 'Записано: ' . $newname . '</br>';

                    //запись файлов в бд
                    $bd = mysqli_query($mysqli, "UPDATE student, studentgroup SET `photochash`= '$newname' WHERE tableid = '$zapisid' and student.studentid = $d and student.studentid = studentgroup.studentid");
                    echo 'Записанно в бд статус = ' . $bd . ' id записи: ' . $zapisid;


                    if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)) {

                        echo '<tr align = "center">';
                        echo '<td width = "5%" heidth = "5%" >';
                        echo $row['tableid'];
                        echo '</td>';

                        echo '<td width = "25%">';
                        echo $row['fname'];
                        echo '</td>';

                        echo '<td width = "25%">';
                        echo $row['fname'];
                        echo '</td>';

                        echo '<td width = "25%">';
                        echo $row['fname'];
                        echo '</td>';

                        echo '<td width = "25%">';
                        echo $row['fname'];
                        echo '</td>';

                        echo '<td width = "25%">';
                        echo "<img src='" . $uploaddir . $image_name . "' class='imgList'>";
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';

                        //echo $name;


                        $zapisid = $zapisid + 1;
                    } else {
                        echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
                    }
                } else {
                    echo '<span class="imgList">You have exceeded the size limit!</span>';
                }
            } else {
                echo '<span class="imgList">Unknown extension!</span>';
            }
        }
    }
}

?>