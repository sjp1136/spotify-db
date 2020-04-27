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

function addFriend($friendID, $myID){
    global $db;
    $query = "insert into friend values($friendID, $myID)";
    $query2 = "insert into friend values($myID, $friendID)";
    $s = $db->prepare($query);
    $s2 = $db->prepare($query2);

    $s->execute();
    $s2->execute();
    $r = $s->fetchAll();
    $r2 = $s2->fetchAll();
    $s->closeCursor();
    $s2->closeCursor();
    if ($s && $s2){
        return True;
    }
    return False;
}


function getFriends($userID){
    global $db;
    $query = "select u2.username from registered_users as u, friend as f where f.userID=:username and u.usernameID = f.friendID";
    $statement = $db->prepare($query);
    $statement->bindValue(':username',$userID);

    $statement->execute();

    $results = $statement->fetchAll();

    $statement-closeCursor();
    return $results;
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

function searchUsers($searchQuery){
    global $db;
    $query = "select name from user where name like '%$searchQuery%';";    
    $statement = $db->prepare($query);
    $statement->execute();
    
    $results = $statement->fetchAll();

    $statement->closeCursor();
    return $results;
}

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