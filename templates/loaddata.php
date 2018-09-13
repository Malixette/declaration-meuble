<?php
    if( isset( $_POST['codeInsee'] ) )
    {
    
    $codeInsee = $_POST['codeInsee'];
    
    $host = 'localhost';
    $user = 'root';
    $pass = ' ';
    
    mysql_connect($host, $user, $pass);
    
    mysql_select_db('declaration-meuble');
    
    $selectdata = " SELECT * FROM villes WHERE name LIKE '$codeInsee' ";
    
    $query = mysql_query($selectdata);
    
    while($row = mysql_fetch_array($query))
    {
     echo $codeInsee;
    }
    
    }
?>