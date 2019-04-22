<?php
    require 'includes/config.php';
    require 'includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <script  type="text/javascript" src="scripts/phpalbums.js"></script>
        <!-- Τα επόμενα 2 include (script & link) είναι για το javascript plugin "Tables"  -->
        <script type="text/javascript" src="scripts/table.js"></script>
        <link href="scripts/table.css" rel="stylesheet" type="text/css" />

        <link href="styles/styles.css" rel="stylesheet" type="text/css" />
        <title></title>
    </head>
    <body>


<!-- Αριστερό μενού                             -->
<!-- ****************************************** -->
<nav>
    <?php 
    echo "<ul style=\"margin-left:  -20px;\">";
    echo "<li class=\"menuButton\"><a href=\"articlesreview.php\">Εμφάνιση άρθρων</a></li>";
    if (strcmp ($AdminAccess,"True")==0)
    {
        include ('adminmenu.php');
    }
    echo "</ul>";
    ?>
</nav>

    <form name="edit" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
    <!-- Fixed Header ---------------------------------------------------- -->
    <!-- Εμφανίζει το logged χρήστη και τα κουμπιά για αποθήκευση στη βάση  -->
    <div class ="PageHeader">
        <table style="width: 100%">
            <tr>
                <!-- Αριστερό κελί (αναφέρει το logged χρήστη και login/logout -->
                <td style="width: 50%; color:  white; padding-left: 8px;">
                <?php
                    $LoggedUser = new User();
                    $Logged_ID = $LoggedUser->GetLoggedUser();
                    if (strlen($_SESSION['LoggedName']) > 0)
                    {
                        echo "Καλωσήρθατε ".$_SESSION['LoggedName']." ";
                        echo "<a href=\"message.php?msgid=3\">(πατήστε για αποσύνδεση)</a>";
                    }
                    else
                    {
                        echo "Δεν έχετε συνδεθεί στο σύστημα"."<br>";
                        echo "<a href=\"loginmain.php\">Σύνδεση</a>";
                    }
                ?>
                </td>
                <!-- Δεξί κελί (περιέχει τα κουμπιά -->
                <td style="text-align: right; padding-right: 10px; color: white;">
                    <input class="dbButton" type="submit" value="Save" onclick="ResetFieldChange('UnsavedChanges');"/><input class="dbButton" style="margin-left: 6px;" type="reset" value="Reset"/>
                    <input type="text" hidden name="UnsavedChanges" id="UnsavedChanges" value="0"></input>
                </td>
            </tr>
        </table>
    </div>      <!-- Fixed header της σελίδας -->
    
    <div class="section">
    <h1 style="color: #4084b9; margin-left:  12px;">Νέα φωτογραφία</h1>
    <input type="text" hidden name="UnsavedChanges1" id="UnsavedChanges" value="0"></input>

        <?php
        if (isset ($_SESSION['LoggedUserID']))
        {
            $HideDebug = "hidden";
            $AdminAccess = "False";
            $Logged_ID = $LoggedUser->GetLoggedUser();
            $AdminAccess = $LoggedUser->IsAdmin($Logged_ID);

            echo"<table id=\"MasterTable\">";

            // Πεδίο ΠΛΗΘΟΣ ΑΡΘΡΩΝ ΠΟΥ ΘΑ ΔΗΜΙΟΥΡΓΗΘΟΥΝ
            echo"<tr>";
            echo "<td class=\"Label\">";
            echo "<li>"."Πλήθος άρθρων"."</li>";
            echo "</td>";
            echo "<td class=\"InputField\">";
            echo "<input type=\"number\" required name=\"news_number\" value=\"1\" min=\"1\" max=\"10\" size=\"2\" onchange=\"HandleFieldChange()\"></input>";
            echo "</td>";
            echo "</tr>";

            // ΕΛΑΧΙΣΤΟΣ ΑΡΙΘΜΟΣ ΛΕΞΕΩΝ
            echo"<tr>";
            echo "<td class=\"Label\">";
            echo "<li>"."Ελάχιστο πλήθος λέξεων"."</li>";
            echo "</td>";
            echo "<td class=\"InputField\">";
            echo "<input type=\"number\" required name=\"news_words_min\" value=\"20\" min=\"1\" max=\"500\" size=\"3\" onchange=\"HandleFieldChange()\"></input>";
            echo "</td>";
            echo "</tr>";

            // ΜΕΓΙΣΤΟΣ ΑΡΙΘΜΟΣ ΛΕΞΕΩΝ
            echo"<tr>";
            echo "<td class=\"Label\">";
            echo "<li>"."Μέγιστο πλήθος λέξεων"."</li>";
            echo "</td>";
            echo "<td class=\"InputField\">";
            echo "<input type=\"number\" required name=\"news_words_max\" value=\"600\" min=\"600\" max=\"2000\" size=\"3\" onchange=\"HandleFieldChange()\"></input>";
            echo "</td>";
            echo "</tr>";

            // ΜΕΓΙΣΤΟΣ ΑΡΙΘΜΟΣ ΕΙΚΟΝΩΝ
            echo"<tr>";
            echo "<td class=\"Label\">";
            echo "<li>"."Μέγιστο πλήθος εικόνων"."</li>";
            echo "</td>";
            echo "<td class=\"InputField\">";
            echo "<input type=\"number\" required name=\"news_pics_max\" value=\"1\" min=\"1\" max=\"5\" size=\"3\" onchange=\"HandleFieldChange()\"></input>";
            echo "</td>";
            echo "</tr>";

            // Πεδίο ΘΕΜΑ (Κατηγορία)
            echo"<tr>";
            echo "<td class=\"Label\">";
            echo "<li>"."Θέμα"."</li>";
            echo "</td>";
            echo "<td class=\"InputField\">";
            // Ενημέρωση drop down list με τα ονόματα των newscat
            echo "<select name=\"news_cat\">";
            $strSelectSQL = "SELECT nc_id, nc_name FROM newscat";
                            "ORDER BY nc_name";
            $resultSelect = mysql_query($strSelectSQL);
            while($rowSelect = mysql_fetch_array($resultSelect))
            {
                echo "<option value=\"".$rowSelect['nc_name']."\">".$rowSelect['nc_name']."</option>";
            }
            echo"</select>";
            echo "</td>";
            echo"</tr>";

            // Πεδίο ΤΟΝΟΣ
            echo"<tr>";
            echo "<td class=\"Label\">";
            echo "<li>"."Τόνος"."</li>";
            echo "</td>";
            echo "<td class=\"InputField\">";
            // Ενημέρωση drop down list με τα ονόματα των genre
            echo "<select name=\"news_genre\">";
            $strSelectSQL = "SELECT gen_id, gen_name FROM genre";
                            "ORDER BY gen_name";
            $resultSelect = mysql_query($strSelectSQL);
            while($rowSelect = mysql_fetch_array($resultSelect))
            {
                echo "<option value=\"".$rowSelect['gen_id']."\">".$rowSelect['gen_name']."</option>";
            }
            echo"</select>";
            echo "</td>";
            echo"</tr>";

            echo"</tr>";
            echo"</table>";
        }
        else
        {
            header("Location: message.php?msgid=2");
        }
        ?>
    </div>
    </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $news_number = $_POST['news_number'];
            $news_words_min = $_POST['news_words_min'];
            $news_words_max = $_POST['news_words_max'];
            $news_pics_max = $_POST['news_number'];
            $news_cat = $_POST['news_cat'];
            $news_genre = $_POST['news_genre'];
            $news_person = '';
            $LoggedUser = new User();
            $news_creator = $LoggedUser->GetLoggedUser();     
            $news_timestamp = date('Y-m-d H:i:s');
            $news_editor = '';
            echo "News number: ".$news_number."<br>";
            echo "Min words: ".$news_words_min."<br>";
            echo "Max words: ".$news_words_max."<br>";
            echo "Max pics: ".$news_pics_max."<br>";
            echo "Category: ".$news_cat."<br>";
            echo "Genre: ".$news_genre."<br>";

            for ($i = 1; $i <= $news_number; $i++)
            {
                $content = file_get_contents('http://loripsum.net/api/'.$news_number.'short');
                $limited_content = truncateWords($content, $news_words_max, ".");
                $news_content = mysql_escape_string ($limited_content);
                $strSQL = "INSERT INTO articles (art_title, art_text, art_max_pics, art_person, art_genre, art_creator, art_timestamp, art_editor, art_status) VALUES ".
                         "('$news_cat', '$news_content', $news_pics_max, '$news_person', $news_genre, $news_creator, '$news_timestamp', '$news_editor', 1)";
                echo $strSQL."<br>";
                $result = mysql_query($strSQL);
            }
        }
        ?>
    </body>
</html>
