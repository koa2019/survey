<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Find by Email</title>
        <!-- Javascript -->
        <script type= "text/javascript" src="./assets/javascript/cookies.js"></script>
        <style>
            body {
                background-color: black;
                color: limegreen;
            }
            #selectByEmail-div {
                margin: auto;
                text-align: center;
            }
        </style>     
    </head>
    <body>
        <div id="selectByEmail-div"></div>
        <script type="text/javascript">
            console.log("Hit selectByEmail.php");            
            //var cookie = readCookie(); // reads cookie passed from login.html and returns object with cookies key:value pairs
            //console.log('Hit selectByEmail.php.\ncookie={name=' + cookie.name + '\nemail=' + cookie.email);
            //makeButton('selectByEmail-div','Looking for email', 'Survey.html','Take Survey');  
        </script>

        <?php
        // This code is based off Dr. Lehr's JSON_Cookies > cookieTransferObject.php
        echo "</br>Gotta Read the cookie </br>";
        $text = $_COOKIE["object"];
        echo $text . "</br>";      // prints the entire cookie object
        $cookieObj = json_decode($text);
        echo '<pre>';
        var_dump($cookieObj);  // Confirm votes is added to the object by printing it
        echo '</pre></br>';
        //print_r($cookieObj);  // Confirm votes is added to the object by printing it
        echo '</br></br>';


        // Create a connection to the database
        // This code is based off Dr. Lehr's DBConnect > DBSelect.php
        require_once ('ConnectTest.php'); // Connect to the db locally via localhost
        
        
        // Query database.  This query is from surveyDB2.odb OpenOffice Query for user_votes_4
        // YOU can get this query from openOffice.createQuery>editQuery>copy and paste it here. See screenshots in mySQL_openOffice>lecture>05-22-23
        $sql = " SELECT `id`,`first_name`,`email`, `password`, `votes0`, `votes1`, `votes2` 
                FROM `test`.`entity_user_votes` AS `entity_user_votes`
                WHERE `email` = '" . $cookieObj->email . "' ";

        $result = $conn->query($sql);
        echo "<table border='1'>";
        echo "<tr><th>" . 'id' . "</th>";
        echo "<th>" . 'name' . "</th>";
        echo "<th>" . 'email' . "</th>";
        echo "<th>" . 'password' . "</th>";
        echo "<th>" . 'votes0' . "</th>";
        echo "<th>" . 'votes1' . "</th>";
        echo "<th>" . 'votes2' . "</th></tr>";
        while ($re = $result->fetch_assoc()) {
            echo "<tr><td>" . $re['id'] . "</td>";
            echo "<td>" . $re['first_name'] . "</td>";
            echo "<td>" . $re['email'] . "</td>";
            echo "<td>" . $re['password'] . "</td>";
            echo "<td>" . $re['votes0'] . "</td>";
            echo "<td>" . $re['votes1'] . "</td>";
            echo "<td>" . $re['votes2'] . "</td></tr>";
        }
        echo "</table>";
        ?>
        <br><button onclick="window.location.assign('Survey.html')">Take Survey</button>
    </body>
</html>
