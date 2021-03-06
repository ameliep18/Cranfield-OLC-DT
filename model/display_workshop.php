<?php

//Connect to the database
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=cranfield_old_dt;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Error : ' . $e->getMessage());
}

//Function to display the list of workshops
function displayWorkshop(PDO $bdd, $status) {
    $statement = $bdd->prepare('SELECT * FROM workshop WHERE status=:status ORDER BY id_workshop ASC');
    $statement->bindParam(":status", $status);
    $statement->execute();

// Display each coaching info
    $tab=array();
    while ($data = $statement->fetch()) {
        echo $tab[] = $data['id_workshop'];
        echo $tab[] = $data['title'];
        $tab[] = $data['start_date'];
        $tab[] = $data['end_date'];
        $tab[] = $data['goals'];
        $tab[] = $data['link'];
        $tab[] = getNameFromId($bdd, $data['id_coordinator']);
        $tab[] = getNameFromId($bdd, $data['id_judges']);
        $tab[] = getNameFromId($bdd, $data['id_technicians']);
        $tab[] = $data['nb_groups'];
    }
    return $tab;
}

/*//Function to display the requested coachings
function displayRequestedCoachings(PDO $bdd) {
    $statement = $bdd->prepare('SELECT * FROM coaching WHERE status=0');
    $statement->execute();

// Display each coaching info
    $tab=array();
    while ($data = $statement->fetch()) {
        $tab[] = $data['id_coaching'];
        $tab[] = getNameFromId($bdd,$data['id_creator']);
        $tab[] = $data['topic'];
        $tab[] = $data['justification'];
    }
    return $tab;
}

//Function to display the requested coachings of one coach/coachee
function displayMyRequestedCoachings(PDO $bdd, $id, $status) {
    $statement = $bdd->prepare('SELECT * FROM coaching WHERE status=:status AND id_creator=:id');
    $statement->bindParam(":status", $status);
    $statement->bindParam(":id", $id);
    $statement->execute();

// Display each coaching info
    $tab=array();
    while ($data = $statement->fetch()) {
        $tab[] = $data['id_coaching'];
        $tab[] = $data['topic'];
        $tab[] = $data['justification'];
    }
    return $tab;
}
*/

//Function to display all my IG workshop
function displayMyWorkshops(PDO $bdd, $id, $status) {
    $statement = $bdd->prepare('SELECT * FROM workshop WHERE status=:status AND (id_judges=:id OR id_technicians=:id)');
    $statement->bindParam(":id", $id);
    $statement->bindParam(":status", $status);
    $statement->execute();

// Display each coaching info
    $tab=array();
    while ($data = $statement->fetch()) {
        $tab[] = $data['id_workshop'];
        $tab[] = $data['title'];
        $tab[] = $data['start_date'];
        $tab[] = $data['end_date'];
        $tab[] = $data['goals'];
        $tab[] = $data['link'];
        $tab[] = getNameFromId($bdd, $data['id_coordinator']);
        $tab[] = getNameFromId($bdd, $data['id_judges']);
        $tab[] = getNameFromId($bdd, $data['id_technicians']);
        $tab[] = $data['nb_groups'];

    }
    return $tab;
}


function displayMyGroupsID(PDO $bdd, $id_expert) {
    $statement = $bdd->prepare('SELECT id_group, id_workshop FROM workshop_group WHERE id_expert=:id_expert');
    $statement->bindParam(":id_expert", $id_expert);
    $statement->execute();
    $tab=array();
    while ($data = $statement->fetch()) {
        $tab[] = $data['id_group'];
        $tab[] = $data['id_workshop'];
    }
    return $tab;
}

//Function to display my workshop
function displayMyWorkshop(PDO $bdd, $id_workshop) {
    $statement = $bdd->prepare('SELECT * FROM workshop WHERE id_workshop=:id');
    $statement->bindParam(":id", $id_workshop);
    $statement->execute();

// Display workshop info
    $tab=array();
    while ($data = $statement->fetch()) {
        echo $tab[] = $data['id_workshop'];
        echo $tab[] = $data['title'];
        $tab[] = $data['start_date'];
        $tab[] = $data['end_date'];
        $tab[] = $data['goals'];
        $tab[] = $data['link'];
        $tab[] = getFirstnameFromId($bdd, $data['id_coordinator']);
        $tab[] = getFirstnameFromId($bdd, $data['id_judges']);
        $tab[] = getFirstnameFromId($bdd, $data['id_technicians']);
        $tab[] = $data['nb_groups'];
    }
    return $tab;
}
function displayMyGroup(PDO $bdd, $id_group) {
    $statement = $bdd->prepare('SELECT * FROM workshop_group WHERE id_group=:id');
    $statement->bindParam(":id", $id_group);
    $statement->execute();

// Display workshop info
    $tab=array();
    while ($data = $statement->fetch()) {
        echo $tab[] = $data['id_group'];
        echo $tab[] = $data['id_workshop'];
        echo $tab[] = getNamesFromId($bdd, $data['id_participants']);
        echo $tab[] = getFirstnameFromId($bdd, $data['id_expert']);
    }
    return $tab;
}
/*
//Function to display one coaching title
function displayCoachingTitle(PDO $bdd, $id_coaching) {
    $statement = $bdd->prepare('SELECT title FROM coaching WHERE id_coaching=:id');
    $statement->bindParam(":id", $id_coaching);
    $statement->execute();

// Display each coaching info
    while ($data = $statement->fetch()) {
        $title = $data['title'];
    }
    return $title;
}

//Function to display one requested coaching
function displayOnePendingCoachings(PDO $bdd, $id) {
    $statement = $bdd->prepare('SELECT * FROM coaching WHERE status=3 AND id_coaching=:id');
    $statement->bindParam(":id", $id);
    $statement->execute();

// Display each coaching info
    $tab=array();
    while ($data = $statement->fetch()) {
        $tab[] = $data['id_activities'];
        $tab[] = $data['start_date'];
        $tab[] = $data['end_date'];
    }
    return $tab;
}

//Function to update one requested coaching
function updateOneRequestedCoachings(PDO $bdd, $id, $topic, $justification) {
    $statement = $bdd->prepare('UPDATE coaching SET topic=:topic, justification=:justification WHERE id_coaching=:id; ');
    $statement->bindParam(":id", $id);
    $statement->bindParam(":topic", $topic);
    $statement->bindParam(":justification", $justification);
    $statement->execute();
}

//Function to display the in-going or delivered coachings of one coach/coachee
function displayMyCoachings(PDO $bdd, $id, $status)
{
    $statement = $bdd->prepare('SELECT * FROM coaching WHERE status=:status AND (id_coach=:id OR id_coachee1=:id OR id_coachee2=:id OR id_coachee3=:id)');
    $statement->bindParam(":id", $id);
    $statement->bindParam(":status", $status);
    $statement->execute();

// Display each coaching info
    $tab = array();
    while ($data = $statement->fetch()) {
        $tab[] = $data['id_coaching'];
        $tab[] = $data['title'];
        $tab[] = $data['topic'];
        $tab[] = $data['description'];
        $tab[] = getNameFromId($bdd, $data['id_coach']);
        if ($data['id_coachee2'] == 0 && $data['id_coachee3'] == 0) {
            $tab[] = getNameFromId($bdd, $data['id_coachee1']);
            $tab[] = "";
            $tab[] = "";
        } else if ($data['id_coachee3'] == 0) {
            $tab[] = getNameFromId($bdd, $data['id_coachee1']);
            $tab[] = getNameFromId($bdd, $data['id_coachee2']);
            $tab[] = "";
        } else {
            $tab[] = getNameFromId($bdd, $data['id_coachee1']);
            $tab[] = getNameFromId($bdd, $data['id_coachee2']);
            $tab[] = getNameFromId($bdd, $data['id_coachee3']);
        }
    }
    return $tab;
}

//Function to update one pending coaching
function updateOnePendingCoachings(PDO $bdd, $id, $start_date, $end_date) {
    $statement = $bdd->prepare('UPDATE coaching SET start_date=:start_date, end_date=:end_date WHERE id_coaching=:id; ');
    $statement->bindParam(":id", $id);
    $statement->bindParam(":start_date", $start_date);
    $statement->bindParam(":end_date", $end_date);
    $statement->execute();
}

//Function to display the coachings ID of one coach/coachee
function displayMyCoachingsID(PDO $bdd, $id, $status)
{
    $statement = $bdd->prepare('SELECT id_coaching FROM coaching WHERE status=:status AND (id_coach=:id OR id_coachee1=:id OR id_coachee2=:id OR id_coachee3=:id)');
    $statement->bindParam(":id", $id);
    $statement->bindParam(":status", $status);
    $statement->execute();

// Display each coaching info
    $tab = array();
    while ($data = $statement->fetch()) {
        $tab[] = $data['id_coaching'];
    }
    return $tab;
}

//Function to update one coaching status
function updateCoachingStatus(PDO $bdd, $id, $status) {
    $statement = $bdd->prepare('UPDATE coaching SET status=:status WHERE id_coaching=:id; ');
    $statement->bindParam(":id", $id);
    $statement->bindParam(":status", $status);
    $statement->execute();
}

//Function to update one coaching
function updateCoaching(PDO $bdd, $id_request, $title, $description, $goal, $id_coach, $id_coachee1, $id_coachee2, $id_coachee3, $time_alloc, $status) {
    $statement = $bdd->prepare('UPDATE coaching SET title=:title, description=:description, goal=:goal, id_coach=:id_coach, id_coachee1=:id_coachee1, id_coachee2=:id_coachee2, id_coachee3=:id_coachee3, time_alloc=:time_alloc, status=:status WHERE id_coaching=:id; ');
    $statement->bindParam(":id", $id_request);
    $statement->bindParam(":title", $title);
    $statement->bindParam(":description", $description);
    $statement->bindParam(":goal", $goal);
    $statement->bindParam(":id_coach", $id_coach);
    $statement->bindParam(":id_coachee1", $id_coachee1);
    $statement->bindParam(":id_coachee2", $id_coachee2);
    $statement->bindParam(":id_coachee3", $id_coachee3);
    $statement->bindParam(":time_alloc", $time_alloc);
    $statement->bindParam(":status", $status);
    $statement->execute();
}

function getIDcreator(PDO $bdd, $id_request){
    $statement = $bdd->prepare('SELECT id_creator FROM coaching WHERE id_coaching=:id');
    $statement->bindParam(":id", $id_request);
    $statement->execute();

    while ($data = $statement->fetch()) {
        $resp = $data['id_creator'];
    }
    return $resp;
}

function deleteCoaching(PDO $bdd, $id_request) {
    $statement = $bdd->prepare('DELETE FROM coaching WHERE id_coaching=:id');
    $statement->bindParam(":id", $id_request);
    $statement->execute();
}

function getCoachees(PDO $bdd, $id_coaching) {
    $statement = $bdd->prepare('SELECT id_coachee1, id_coachee2, id_coachee3 FROM coaching WHERE id_coaching=:id');
    $statement->bindParam(":id", $id_coaching);
    $statement->execute();

    $tab = array();
    $tabresult = array();
    while ($data = $statement->fetch()) {
        $tab[] = $data['id_coachee1'];
        $tab[] = $data['id_coachee2'];
        $tab[] = $data['id_coachee3'];
    }
    if ($tab[1]==0) {
        $tabresult[] = $tab[0];
    }
    else if ($tab[1]!=0 && $tab[2]==0) {
        $tabresult[] = $tab[0];
        $tabresult[] = $tab[1];
    }
    else {
        $tabresult[] = $tab[0];
        $tabresult[] = $tab[1];
        $tabresult[] = $tab[2];
    }
    return $tabresult;
} */

//Function to display the ID of the workshop knowing his title
function getIdFromTitle(PDO $bdd, $title) {
    $statement = $bdd->prepare('SELECT id_workshop FROM workshop WHERE title=:title');
    $statement->bindParam(":title", $title);
    $statement->execute();
    while ($data = $statement->fetch()) {
        $id = $data['id_workshop'];
    }
    return $id;
}

function getTitleFromId(PDO $bdd, $id_workshop) {
    $statement = $bdd->prepare('SELECT title FROM workshop WHERE id_workshop=:id');
    $statement->bindParam(":id", $id_workshop);
    $statement->execute();
    while ($data = $statement->fetch()) {
        $title = $data['title'];
    }
    return $title;
}

function setActivityStatus(PDO $bdd, $id_activity, $newstatus){
    $statement = $bdd->prepare('UPDATE workshop_activity SET status=:newstatus WHERE id_activity=:id');
    $statement->bindParam(":id", $id_activity);
    $statement->bindParam(":newstatus", $newstatus);
    $statement->execute();
}

function displayWorkshopActivities(PDO $bdd, $id_workshop, $id_group){
    $statement = $bdd->prepare('SELECT * FROM workshop_activity WHERE (id_workshop=:id AND id_group=:id_group)');
    $statement->bindParam(":id", $id_workshop);
    $statement->bindParam(":id_group", $id_group);
    $statement->execute();
    $tab=array();
    while ($data = $statement->fetch()) {
        $tab[] = $data['id_activity'];
        $tab[] = $data['title'];
        $tab[] = $data['duration'];
        $tab[] = $data['com_method'];
        $tab[] = $data['aim'];
        $tab[] = $data['status'];
    }
    return $tab;
}

function getLink(PDO $bdd, $id_workshop) {
    $statement = $bdd->prepare('SELECT link FROM workshop WHERE id_workshop=:id');
    $statement->bindParam(":id", $id_workshop);
    $statement->execute();
    while ($data = $statement->fetch()) {
        $link = $data['link'];
    }
    return $link;
}

function displayWorkshopGroupsID(PDO $bdd, $id_workshop){
    $statement = $bdd->prepare('SELECT * FROM workshop_group WHERE id_workshop=:id');
    $statement->bindParam(":id", $id_workshop);
    $statement->execute();
    $tab=array();
    while ($data = $statement->fetch()) {
        $tab[] = $data['id_group'];
    }
    return $tab;
}
