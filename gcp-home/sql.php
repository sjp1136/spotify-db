<?php
function create_table(){
    global $db;
    $query = "create table if not exists friends ( 
                     name varchar(30) primary key, 
                     major varchar(20),
                     year int(1) )";
                     
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function drop_table(){
    global $db;
    $query = "drop table friends";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function addFriend($name, $major, $year){
    global $db;
    $query = "insert into friends values (:name, :major, :year)";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':major', $major);
    $statement->bindValue(':year', $year);

    $statement->execute();
    $statement->closeCursor();
}

function getAllFriends(){
    global $db;
    $query = "select * from friends";
    
    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll(); //fetch()

    $statement->closeCursor();
    return $results;
}
?>