<?php
    require 'includes/config.php';
    require 'includes/functions.php';    
    $art_id = $_POST['art_id'];
    $art_title = $_POST['art_title'];
    $art_genre = $_POST['art_genre'];
    $art_status = $_POST['art_status'];
    $art_text = $_POST['art_text'];
    $art_max_pics = $_POST['art_max_pics'];
    for ($i=0; $i<$art_max_pics; $i++)
    {
        $k = "art_picture".$i;
        //echo $k."<br>";
        $art_Photo_File = $_FILES[$k]['name'];
        echo $art_Photo_File."<br>";
        if (strlen ($art_Photo_File) > 0)
        {
            $strSQL = "INSERT INTO artpics (art_id, art_filename) VALUES ".
                        "(".$art_id.", '".$art_Photo_File."')";
            echo $strSQL."<br>";
            $result = mysql_query($strSQL);
            if ($result)
            {
                move_uploaded_file($_FILES[$k]["tmp_name"], "cms/" . $_FILES[$k]["name"]);
                header("Location: articlesreview.php");
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
