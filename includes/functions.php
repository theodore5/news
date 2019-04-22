<?php

class Article
{
    public $art_id;
    public $art_title;
    public $art_text;
    public $art_max_pics;
    public $art_person;
    public $art_genre;
    public $art_creator;
    public $art_timestamp;
    public $art_editor;
    public $art_status;
    
    public $art_Images = array();

    function Get_Article ($ID)
    {
        $ID = mysql_real_escape_string($ID);
        $sql="SELECT articles.art_id, articles.art_title, articles.art_text, articles.art_max_pics, articles.art_person, articles.art_editor, 
                    articles.art_genre, articles.art_timestamp, articles.art_status, status.sts_name, users.Usr_Lastname, 
                    users.Usr_Firstname, genre.gen_name
                    FROM status RIGHT JOIN (genre RIGHT JOIN (users RIGHT JOIN articles ON 
                    users.Usr_ID = articles.art_creator) ON genre.gen_id = articles.art_genre) ON 
                    status.sts_id = articles.art_status WHERE art_id=".$ID;
        $result = mysql_query($sql);
        if ($result)
        {
            //$this->User_List = array();
            while ($row = mysql_fetch_array ($result))
            {
                $this->art_id = $row['art_id'];
                $this->art_title = $row['art_title'];
                $this->art_text = $row['art_text'];
                $this->art_max_pics = $row['art_max_pics'];
                $this->art_person = $row['art_person'];
                $this->art_genre = $row['gen_name'];
                $this->art_creator = $row['Usr_Firstname']." ".$row['Usr_Lastname'];
                $this->art_timestamp = $row['art_timestamp'];
                $this->art_editor = $row['art_editor'];
                $this->art_status = $row['sts_name'];
            }
        }
        $sql="SELECT art_id, art_filename FROM artpics WHERE art_id=".$ID;
        $result = mysql_query($sql);
        if ($result)
        {
            //$this->User_List = array();
            while ($row = mysql_fetch_array ($result))
            {
                $this->art_Images[]=$row['art_filename'];
            }
        }
    }

    function Set_Prefs ($UID, $Pref)
    {
        $UID = mysql_real_escape_string($UID);
        $sql="UPDATE USERS SET Usr_Prefs=$Pref";
        $result = mysql_query($sql);
    }

}

class User
{
    public $Usr_ID;
    public $Usr_Username;
    public $Usr_Password;
    public $Usr_Lastname;
    public $Usr_Firstname;
    public $Usr_Email;
    public $Usr_Phone;
    public $Usr_Mobile;
    public $Usr_Role_Admin;
    public $Usr_Role_Editor;
    public $Usr_Status;
    public $Usr_Prefs;

    public $User_List = array();

    function login ($user, $pass)
    {
        $user = strip_tags(mysql_real_escape_string($user));
        $pass = strip_tags(mysql_real_escape_string($pass));
        //$pass = md5($pass);
        $sql = "SELECT * FROM users WHERE Usr_Username = '$user' AND Usr_Password = '$pass'";
        echo $sql;
        $result = mysql_query($sql) or die('Query failed. ' . mysql_error());
        if (mysql_num_rows($result) == 1) 
        {
            $row = mysql_fetch_array($result);
            $_SESSION['authorized'] = true;
            $_SESSION['LoggedUserID'] = $row['Usr_ID'];
            $_SESSION['LoggedName'] = $row['Usr_Username'];
            return TRUE;
            exit();
        } 
        else 
        {
            $_SESSION['error'] = 'Wrong username or password';
            return FALSE;
        }
    }
    
    function GetLoggedUser()
    {
        $LoggedID = 0;
       
        if (isset ($_SESSION['LoggedUserID']))
            $LoggedID = $_SESSION['LoggedUserID'];
        else
            $LoggedID = 0;
            
        return $LoggedID;
    }

    function IsAdmin($ID)
    {
        
        $ID = mysql_real_escape_string($ID);
        $sql = "SELECT * FROM users WHERE Usr_ID=".$ID;
        $result = mysql_query($sql);
        if ($result)
        {
            while ($row = mysql_fetch_array ($result))
            {
                $this->Usr_ID = $row['Usr_ID'];
                $this->Usr_Role_Admin = $row['Usr_Role_Admin'];
            }
        }
        return $this->Usr_Role_Admin;
    }

    function IsEditor($ID)
    {
        
        $ID = mysql_real_escape_string($ID);
        $sql = "SELECT * FROM users WHERE Usr_ID=".$ID;
        $result = mysql_query($sql);
        if ($result)
        {
            while ($row = mysql_fetch_array ($result))
            {
                $this->Usr_ID = $row['Usr_ID'];
                $this->Usr_Role_Editor = $row['Usr_Role_Editor'];
            }
        }
        return $this->Usr_Role_Editor;
    }

    function IsWriter($ID)
    {
        
        $ID = mysql_real_escape_string($ID);
        $sql = "SELECT * FROM users WHERE Usr_ID=".$ID;
        $result = mysql_query($sql);
        if ($result)
        {
            while ($row = mysql_fetch_array ($result))
            {
                $this->Usr_ID = $row['Usr_ID'];
                $this->Usr_Role_Writer = $row['Usr_Role_Writer'];
            }
        }
        return $this->Usr_Role_Writer;
    }


    function Get_User ($ID)
    {
        $ID = mysql_real_escape_string($ID);
        $sql="SELECT * FROM users WHERE Usr_ID=".$ID;
        $result = mysql_query($sql);
        if ($result)
        {
            $this->User_List = array();
            while ($row = mysql_fetch_array ($result))
            {
                $this->Usr_ID = $row['Usr_ID'];
                $this->Usr_Username = $row['Usr_Username'];
                $this->Usr_Password = $row['Usr_Password'];
                $this->Usr_Lastname = $row['Usr_Lastname'];
                $this->Usr_Firstname = $row['Usr_Firstname'];
                $this->Usr_Email = $row['Usr_Email'];
                $this->Usr_Phone = $row['Usr_Phone'];
                $this->Usr_Mobile = $row['Usr_Mobile'];
                $this->Usr_Role_Admin = $row['Usr_Role_Admin'];
                $this->Usr_Role_Editor = $row['Usr_Role_Editor'];
                $this->Usr_Status = $row['Usr_Status'];
                $this->User_List[]=$row;
            }
        }
    }

    function Get_Prefs ($UID)
    {
        $UID = mysql_real_escape_string($UID);
        $sql="SELECT Usr_Prefs FROM USERS WHERE Usr_ID=$UID";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array ($result))
        {
            $this->Usr_Prefs=$row['Usr_Prefs'];
            return $this->Usr_Prefs;
        }
    }

}

function truncateWords($input, $numwords, $padding="")
{
    $output = strtok($input, " \n");
    while(--$numwords > 0) $output .= " " . strtok(" \n");
    if($output != $input) $output .= $padding;
    return $output;
}
?>

