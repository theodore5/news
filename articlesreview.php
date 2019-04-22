<?php
    require 'includes/config.php';
    require 'includes/functions.php';

    // Βρίσκει τον logged χρήστη και το ρόλο του
    // Αν είναι administrator, το $AdminAccess παίρνει τιμή True
    $LoggedUser = new User();
    $Logged_ID = $LoggedUser->GetLoggedUser();
    $ViewPrefs = $LoggedUser->Get_Prefs ($Logged_ID); 
    $AdminAccess = $LoggedUser->IsAdmin($Logged_ID);
    $ArticleView = new Article();  
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
        echo "<li class=\"menuButton\"><a href=\"medianew.php\">Νέα άρθρα</a></li>";

        if (strcmp ($AdminAccess,"True")==0)
        {
            include ('adminmenu.php');
        }
        echo "</ul>";
        ?>
    </nav>

    <!-- Έναρξη φόρμας επεξεργασίας δεδομένων                                   -->
    <!-- Ξεκινά πάνω από το header div της σελίδας, για να περιλάβει τα κουμπιά -->
    <!-- αποθήκευσης και reset                                                  -->

    <!-- Fixed Header ---------------------------------------------------- -->
    <!-- Εμφανίζει το logged χρήστη και τα κουμπιά για αποθήκευση στη βάση -->
    <div class ="PageHeader">
        <table style="width: 100%">
            <tr>
                <!-- Αριστερό κελί (αναφέρει το logged χρήστη και login/logout -->
                <td style="width: 50%; color:  white; padding-left: 8px;">
                <?php
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
                    <input type="text" hidden  name="UnsavedChanges" id="UnsavedChanges" value="0"></input>
                </td>
            </tr>
        </table>
    </div>      <!-- Fixed header της σελίδας -->

    <div class="section">
        <?php
        if (isset ($_SESSION['LoggedUserID']))
        {
            $HideDebug = "Hidden";

            echo"<table id=\"MasterTable\" class=\"example sort01 table-autosort:0 table-stripeclass:alternate\">";
            // ********************************************************************
            // Header block του πίνακα
            // ********************************************************************
            echo"<thead>";

            // Γραμμή κεφαλίδας πίνακα
            echo"<tr>";
            // Στήλη ID
            echo"   <th class=\"table-sortable:Numeric\">";
            echo"        <p class=\"Header\">" . "ID - Επεξεργασία" . "</p>";
            echo"    </th>";
            
            // Στήλη links εμφάνισης
            echo"   <th>";
            echo"        <p class=\"Header\">" . "Προβολή άρθρου" . "</p>";
            echo"    </th>";

            // Στήλη Τίτλος
            echo "<th class=\"table-sortable:default\">";
            echo "<p class=\"Header\">" . "Τίτλος" . "</p>";
            echo "</th>";
            
            // Στήλη Κείμενο άρθρου
            echo "<th class=\"table-sortable:default\">";
            echo "<p class=\"Header\">" . "Κείμενο" . "</p>";
            echo "</th>";

            echo "<th class=\"table-sortable:default\">";
            echo "<p class=\"Header\">" . "Αφορά" . "</p>";
            echo "</th>";
            
            echo "<th class=\"table-sortable:default\">";
            echo "<p class=\"Header\">" . "Δημοσιεύτηκε" . "</p>";
            echo "</th>";
            
            echo "<th class=\"table-sortable:default\">";
            echo "<p class=\"Header\">" . "Συντάκτης" . "</p>";
            echo "</th>";
            
            echo "<th class=\"table-sortable:default\">";
            echo "<p class=\"Header\">" . "Κατάσταση" . "</p>";
            echo "</th>";
            echo"</tr>";

            // *****************************************************************************
            // Γραμμή φίλτρων
            // *****************************************************************************
	        echo "<tr>";
		    echo "<th>-</th>";
		    echo "<th>-</th>";
            
            // Φίλτρο Τίτλος
		    echo "<th><select class=\"filter\" onchange=\"Table.filter(this,this)\"><option value=\"\">All</option>";
            // Ενημέρωση του φίλτρου των Groups
            $strSQL = "SELECT nc_name FROM newscat";
            $result = mysql_query($strSQL);
            while($row = mysql_fetch_array($result))
            {
                echo "<option value=\"".$row['nc_name']."\">".$row['nc_name']."</option>";
            }
            echo "</select>";
            echo "</th>";
            
            // Φίλτρο κειμένου (δεν εφαρμόζουμε φίλτρο)
            echo "<th>-</th>";

            // Φίτρο Αφορά (δεν εφαρμόζουμε φίλτρο)
		    echo "<th>-</th>";
            // Φίτρο Δημοσιεύτηκε (δεν εφαρμόζουμε φίλτρο)
		    echo "<th>-</th>";
            // Φίτρο Συντάκτης (δεν εφαρμόζουμε φίλτρο)
		    echo "<th>-</th>";

            // Φίλτρο Κατάσταση 
		    echo "<th><select class=\"filter\" onchange=\"Table.filter(this,this)\"><option value=\"\">All</option>";
            // Ενημέρωση του φίλτρου των Groups
            $strSQL = "SELECT sts_name FROM status";
            $result = mysql_query($strSQL);
            while($row = mysql_fetch_array($result))
            {
                echo "<option value=\"".$row['sts_name']."\">".$row['sts_name']."</option>";
            }
            echo "</select>";
            echo "</th>";
            
	        echo "</tr>";

            // *****************************************************************************
            // Τέλος του header block του πίνακα
            // *****************************************************************************
            echo"</thead>";

            // Βρίσκει τα data των στηλών
            $strSQL = "SELECT articles.art_id, articles.art_title, articles.art_text, articles.art_max_pics, articles.art_person, 
                        articles.art_editor, articles.art_genre, articles.art_timestamp, articles.art_status, status.sts_name, 
                        users.Usr_Lastname, users.Usr_Firstname 
                        FROM status RIGHT JOIN (genre RIGHT JOIN (users RIGHT JOIN articles ON 
                        users.Usr_ID = articles.art_creator) ON genre.gen_id = articles.art_genre) ON 
                        status.sts_id = articles.art_status";
            $result = mysql_query($strSQL);
            $rowNum = 0;
            
            // *****************************************************************************
            // Περιοχή δεδομένων πίνακα
            // *****************************************************************************
            echo "<tbody>";
            while($row = mysql_fetch_array($result))
            {
                $CurrentMediaID = $row['art_id'];
                echo"<tr>";

                // Στήλη No (Είναι το ID του media)
                echo "<td class=\"Data\" style=\"width: 30px;\">";
                if (strcmp ($AdminAccess,"True")==0)
                    echo "<a href=\"mediaedit.php?id=$CurrentMediaID\"><p class=\"Data\" style=\"text-align: center;\">" . $row['art_id']. "</p></a>";
                else
                    echo "<p class=\"Data\" style=\"text-align: center;\">" . $row['art_id']. "</p>";
                echo "</td>";
                
                // Στήλη links εμφάνισης
                echo "<td class=\"Data\" style=\"width: 30px;\">";
                if ($ViewPrefs == 1)
                    echo "<a href=\"viewer01.php?id=$CurrentMediaID\" style=\"color: black;\"><p class=\"Data\" style=\"text-align: center;\">" . "Εμφάνιση". "</a>";
                if ($ViewPrefs == 2)
                    echo "<a href=\"viewer02.php?id=$CurrentMediaID\" style=\"color: black;\"><p class=\"Data\" style=\"text-align: center;\">" . "Εμφάνιση". "</a>";
                echo "</td>";

                // Στήλη Τίτλος
                echo "<td class=\"Data\">";
                echo "<p class=\"Data\">" . $row['art_title']. "</p>";
                echo "</td>";
                
                // Στήλη Κείμενο
                echo "<td class=\"Data\">";
                echo "<p class=\"Data\" style=\"color: black\">" . truncateWords($row['art_text'], 12, '.'). "</p>";
                echo "</td>";

                // Στήλη Αφορά
                echo "<td class=\"Data\">";
                echo "<p class=\"Data\">" . $row['art_person']. "</p>";
                echo "</td>";
                        
                // Στήλη Δημοσιεύτηκε
                echo "<td class=\"Data\">";
                echo "<p class=\"Data\">" . $row['art_timestamp']. "</p>";
                echo "</td>";
                        
                // Στήλη Συντάκτης
                echo "<td class=\"Data\">";
                echo "<p class=\"Data\">" . $row['Usr_Firstname']." ". $row['Usr_Lastname']. "</p>";
                echo "</td>";
                // Στήλη Κατάσταση
                echo "<td class=\"Data\">";
                echo "<p class=\"Data\">" . $row['sts_name']. "</p>";
                echo "</td>";

                echo"</tr>";
                $rowNum++;
            }
            echo "</tbody>";
            echo"</table>";
        }
        else
        {
            header("Location: message.php?msgid=2");
        }
        ?>
    </div>
<!--    </form>  -->
    </body>
</html>
