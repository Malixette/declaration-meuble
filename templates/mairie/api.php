<?php 

function connectToMairie()
{
    define('USER', 'root');
    define('PASSWORD', '');
    define('DSN', 'mysql:host=localhost;dbname=declaration-meuble;charset=utf8');
    define('DBOPTIONS', array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ));
        
    $dbh = new PDO(DSN, USER, PASSWORD, DBOPTIONS);
    $sth = $dbh->query("SELECT * FROM mairie");
    $dbh = null;
    
    $results = $sth->fetchAll();
    json_encode($results);
    return $results; 
}

?>