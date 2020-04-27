<?php

function getPlaylists($userID, $sortVal){
    global $db;
    $query = "";    
    if($sortVal == NULL){
        $query = "select * from playlist where userID = $userID";    
    }
    else{
        $query = "select * from playlist where userID = $userID order by $sortVal desc";    
    }
    $statement = $db->prepare($query);
    $statement->execute();
    
    $results = $statement->fetchAll();

    $statement->closeCursor();
    return $results;    
}

function getStats($userID){
    global $db;
    $query = "select * from stats where userID = $userID";
    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement-closeCursor();
    return $results;
}

function getFriends($userID, $sort){
    global $db;
    if($sort == "sortid"){
        $query = "select * from registered_users as u, friend as f where f.userID=:userID and u.usernameID = f.friendID order by usernameID asc";
    }
    else if($sort == "sortname"){
        $query = "select * from registered_users as u, friend as f where f.userID=:userID and u.usernameID = f.friendID order by username asc";
    }
    else{
        $query = "select * from registered_users as u, friend as f where f.userID=:userID and u.usernameID = f.friendID";
    }
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', (int) $userID, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    return $result;
}

function getUsers(){
    global $db;

    $query = "select * from registered_users";
    $statement = $db->prepare($query);
    // $statement->bindValue(':userID', (int) $userID, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    return $result;
}

function getSongs(){
    global $db;

    $query = "select * from song";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    return $result;
}

function searchUsers($username){
    global $db; 

    $tag = '%';
    $username = $username."".$tag; 

    $query = "select * from registered_users where username like :username";

    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    return $result;
}

function getPlaylistCreator($playlistID){
    global $db;
    $query = "select u.name from playlist as p, user as u where p.pID=$playlistID and p.userID=u.userID";
    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement-closeCursor();
    return $results;
}

function getPlaylistSongs($playlistID, $sortVal){
    global $db;
    $query = "";    
    if($sortVal == NULL){
        $query = "select p.name, s.title, s.artist, s.duration from playlist as p, song as s, contains as c where p.pID = $playlistID and c.pID = p.pID and c.songID = s.songID;";    
    }
    else{
        $query = "select p.name, s.title, s.artist, s.duration from playlist as p, song as s, contains as c where p.pID = $playlistID and c.pID = p.pID and c.songID = s.songID order by $sortVal desc";    
    }
    $statement = $db->prepare($query);
    $statement->execute();
    
    $results = $statement->fetchAll();

    $statement->closeCursor();
    return $results;
}

function searchPlaylists($searchQuery){
    global $db;
    $query = "select name, userID from playlist where name like '%$searchQuery%'";    
    $statement = $db->prepare($query);
    $statement->execute();
    
    $results = $statement->fetchAll();

    $statement->closeCursor();
    return $results;
}

function searchSongs($searchQuery){
    global $db;
    $query = "select title, artist from song where title like '%$searchQuery%'";    
    $statement = $db->prepare($query);
    $statement->execute();
    
    $results = $statement->fetchAll();

    $statement->closeCursor();
    return $results;
}

// function searchUsers($searchQuery){
//     global $db;
//     $query = "select name from user where name like '%$searchQuery%';";    
//     $statement = $db->prepare($query);
//     $statement->execute();
    
//     $results = $statement->fetchAll();

//     $statement->closeCursor();
//     return $results;
// }

// function create_table(){
//     global $db;
//     $query = "create table if not exists friends ( 
//                      name varchar(30) primary key, 
//                      major varchar(20),
//                      year int(1) )";
                     
//     $statement = $db->prepare($query);
//     $statement->execute();
//     $statement->closeCursor();
// }

// function drop_table(){
//     global $db;
//     $query = "drop table friends";
//     $statement = $db->prepare($query);
//     $statement->execute();
//     $statement->closeCursor();
// }

// function addFriend($name, $major, $year){
//     global $db;
//     $query = "insert into friends values (:name, :major, :year)";
    
//     $statement = $db->prepare($query);
//     $statement->bindValue(':name', $name);
//     $statement->bindValue(':major', $major);
//     $statement->bindValue(':year', $year);

//     $statement->execute();
//     $statement->closeCursor();
// }

// function getAllFriends(){
//     global $db;
//     $query = "select * from friends";
    
//     $statement = $db->prepare($query);
//     $statement->execute();

//     $results = $statement->fetchAll(); //fetch()

//     $statement->closeCursor();
//     return $results;
// }
?>