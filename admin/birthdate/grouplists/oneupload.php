<?php
class Upload
{
    public $dir;
    public $img;
    public $tmp;
    public $id;
    public $height;
    public $width;
    public $filename;

    //функция сохранения файла
    public function save()
    {
        //если темповый файл существует
        if (@file_exists($this->tmp)) {
            //var_dump(getimagesize($this -> tmp)); // проверка принятого файла
            $info = getimagesize($this->tmp);
            // проверяем является ли файл изображением
            if (preg_match('{image/(.*)}is', $info['mime'], $p)) {
                //обрабатываем через класс изменяем размер
                include 'SimpleImage.php';
                $image = new \claviska\SimpleImage();
                $image->fromFile($this->tmp);
                $image->flip('x');
                //$image->resize($this->width, $this->height);
                //$image->save($this->tmp);
                $image->toFile($this->tmp, 'image/png');

                //записываем файл в папку
                $filename = $this->dir . time() . '.' . $p[1];
                //записываем называние переменной
                $this->filename = $filename;
                move_uploaded_file($this->tmp, $filename);
            }
        }
    }

    public function generateImage()

    {

        $folderPath = $this->dir;
        $img = $this->img;
        $file = $folderPath . uniqid() . '.jpg';
        file_put_contents($file, base64_decode($img));

        //пропустим через класс немного уменшим размер файла
        //include 'SimpleImage.php';
        //$image = new \claviska\SimpleImage();
        //$image->fromFile($file);
        //$image->resize(225, 225);
        //$image->save($this->tmp);
        //$image->toFile($file, 'image/png');

        $this->filename = $file;
    }

    //функция записи в бд с фото upload.php
    public function uploadmysqlsave()
    {
        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
        $sql = mysqli_query($mysqli, "UPDATE student SET photochash='{$this->filename}' WHERE id='{$this->id}'");
        //echo $sql = mysql_query("INSERT INTO student (fname, lname, mname, birthdate, tel, photochash, studentid) VALUES('{$this->fname}', '{$this->lname}', '{$this->mname}','{$this->date}', '{$this->tel}', '{$this->filename}','{$this->studentid}')");
        echo "Успех</br>";
        //echo "<META HTTP-EQUIV=Refresh Content='0;URL=editst.php?studentid={$this->studentid}&id={$this->id}'>";
        //echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
    }
    public function uploadsave()
    {
        $this->generateImage();
        $this->uploadmysqlsave();
    }
}

$member2 = new Upload();
//директрория
$member2->dir = 'uploads/';
$member2->img = $_POST['file'];
$member2->id = $_POST['id'];
//$member2->file = $_FILES['file'];
//$member2->tmp = $member2->file['tmp_name'];
//$member2->height = 225;
//$member2->width = 225;
//$_FILES['file']['tmp_name'];
$member2->uploadsave();

echo $member2->id;
echo "</br>";
echo $member2->filename;
//echo $img = $_POST['file'];
//file_put_contents('uploads/imag.png', base64_decode($img));
