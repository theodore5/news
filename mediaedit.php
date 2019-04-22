<?php
    require 'includes/config.php';
    require 'includes/functions.php';

    // Βρίσκει τον logged χρήστη και το ρόλο του
    // Αν είναι administrator, το $AdminAccess παίρνει τιμή True
    $LoggedUser = new User();
    $Logged_ID = $LoggedUser->GetLoggedUser();
    $AdminAccess = $LoggedUser->IsAdmin($Logged_ID);
    $EditorAccess = $LoggedUser->IsEditor($Logged_ID);
    $WriterAccess = $LoggedUser->IsWriter($Logged_ID);
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
        echo "<li class=\"menuButton\"><a href=\"articlesreview.php\">Άρθρα</a></li>";
        if (strcmp ($AdminAccess,"True")==0)
        {
            include ('adminmenu.php');
        }
        echo "</ul>";
        $art_id_get=$_GET['id'];
        $strSQL = "SELECT articles.art_id, articles.art_title, articles.art_text, articles.art_max_pics, articles.art_person, articles.art_editor, 
                    articles.art_genre, articles.art_timestamp, articles.art_status, status.sts_name, users.Usr_Lastname, 
                    users.Usr_Firstname, genre.gen_name
                    FROM status RIGHT JOIN (genre RIGHT JOIN (users RIGHT JOIN articles ON 
                    users.Usr_ID = articles.art_creator) ON genre.gen_id = articles.art_genre) ON 
                    status.sts_id = articles.art_status WHERE art_id=$art_id_get";
        $result = mysql_query($strSQL);
        if ($result)
        {
            $row = mysql_fetch_array($result);
        }
        ?>
    </nav>

    <!-- Έναρξη φόρμας επεξεργασίας δεδομένων                                   -->
    <!-- Ξεκινά πάνω από το header div της σελίδας, για να περιλάβει τα κουμπιά -->
    <!-- αποθήκευσης και reset                                                  -->
    <form name="edit" action="mediaupdate.php" method="POST" enctype="multipart/form-data">

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
                        echo "Καλωσήρθες ".$_SESSION['LoggedName']." ";
                        echo "<a href=\"message.php?msgid=3\">(press here to logout)</a>";
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

        <?php
        if (isset ($_SESSION['LoggedUserID']))
        {
            $art_id=$row['art_id'];
            $art_title=$row['art_title'];
            $art_text=$row['art_text'];
            $art_max_pics=$row['art_max_pics'];
            $art_person=$row['art_person'];
            $art_editor=$row['art_editor'];
            $art_genre=$row['art_genre'];
            $art_timestamp=$row['art_timestamp'];
            $art_status=$row['art_status'];
            $art_status_name=$row['sts_name'];
            $Usr_Lastname=$row['Usr_Lastname'];
            $Usr_Firstname=$row['Usr_Firstname'];

            $HideDebug = "hidden";
            echo "<input type=\"text\" $HideDebug name=\"art_id\" value=\"$art_id\"></input>";
            echo "<input type=\"text\" $HideDebug name=\"art_max_pics\" value=\"$art_max_pics\"></input>";
            echo "<table id=\"MasterTable\">";
            
            // Πεδίο Media ID
            echo "<tr>";
            echo "<td class=\"Label\">";
            echo "<li>"."ID"."</li>";
            echo "</td>";
            echo "<td class=\"Label\"><li>".$art_id."</li></td>";
            echo "</tr>";

            // Label article title
            echo "<tr>";
            echo "<td class=\"Label\">";
            echo "<li>Τίτλος: </li>";
            echo "</td>";
            echo "<td><li>".$art_title."</li></td>";
            echo "</tr>";
            
            // Label article genre
            echo "<tr>";
            echo "<td class=\"Label\">";
            echo "<li>"."Ύφος"."</li>";
            echo "</td>";
            echo "<td class=\"Label\"><li>".$art_genre."</li></td>";
            echo "</tr>";

            // Πεδίο STATUS
            if ((strcmp ($EditorAccess,"True")==0) || (strcmp ($AdminAccess,"True")==0))
            {
                echo "<tr>";
                echo "<td class=\"Label\">";
                echo "<li>"."Κατάσταση"."</li>";
                echo "</td>";
                echo "<td class=\"InputField\">";
                // Ενημέρωση drop down list με τα ονόματα των Groups
                echo "<select name=\"art_status\">";
                $strSelectSQL = "SELECT sts_id, sts_name FROM status";
                $resultSelect = mysql_query($strSelectSQL);
                while($rowSelect = mysql_fetch_array($resultSelect))
                {
                    if ($rowSelect['sts_id'] == $sts_id)
                        echo "<option value=\"".$rowSelect['sts_id']."\" selected=\"selected\">".$rowSelect['sts_name']."</option>";
                    else
                        echo "<option value=\"".$rowSelect['sts_id']."\">".$rowSelect['sts_name']."</option>";
                }
                echo "</select>";
                echo "</td>";
                echo "</tr>";
            }
            // Αρχεία εικόνας
            for ($i=0; $i<$art_max_pics; $i++)
            {
                echo "<tr>";
                //if (strcmp ($AdminAccess,"True")==0)
                //{
                echo "<td class=\"Label\">";
                $pic_no = $i+1;
                echo "<li>"."Αρχείο εικόνας (".$pic_no.") </li>";
                echo "</td>";
                echo "<td class=\"InputField\">";
                echo "<input type=\"file\" name=\"art_picture$i\" size=\"20\"/>";
                echo "</td>";
                //}
                echo "</tr>";
            }

            // Πεδίο ARTICLE TEXT
            echo "<tr>";
            echo "<td class=\"Label\" style=\"vertical-align: top;\">";
            echo "<li>"."Κείμενο άρθρου"."</li>";
            echo "</td>";
            echo "<td class=\"InputField\">";
            echo "<textarea rows=\"12\" cols=\"80\" name=\"art_text\">".$art_text."</input>";
            echo "</td>";
            echo "</tr>";
            
            echo"</table>";
        }
        else
        {
            header("Location: message.php?msgid=2");
        }
        ?>
    </div>  <!-- DIV Section -->
    </form>
    </body>
</html>
