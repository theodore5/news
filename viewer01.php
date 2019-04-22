<?php
    require 'includes/config.php';
    require 'includes/functions.php';

    // Βρίσκει τον logged χρήστη και το ρόλο του
    // Αν είναι administrator, το $AdminAccess παίρνει τιμή True
    $Art_ID = $_GET['id'];
    $UID = $_GET['uid'];
    $ArticleView = new Article();
    $ArticleView->Get_Article($Art_ID);
    $ArticleView->Set_Prefs ($UID, 1);
    echo "<a href=viewer02.php?id=$Art_ID&uid=$UID>Εμφάνιση με πρότυπο 2</a>";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <table style="width: 70%; margin-left:  auto; margin-right:  auto;">
            <tr>
                <td style="width: 70%">
                    <h1><?php echo $ArticleView->art_title;?></h1>
                    <p><?php echo $ArticleView->art_text;?></p>
                </td>
                <td>
                <?php 
                    foreach ($ArticleView->art_Images as $pic)
                    {
                        echo "<img src=\"cms/".$pic."\" style=\"width: 260px;\" /><br>";
                    }
                ?>                
                </td>
            </tr>
            <tr>
                <td>
                    <p>Συντάκτης: <?php echo $ArticleView->art_creator;?> στις <?php echo $ArticleView->art_timestamp;?></p>
                </td>
            </tr>
        </table>
    </body>
</html>
