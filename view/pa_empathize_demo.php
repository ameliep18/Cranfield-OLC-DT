<?php //Start the session if it's not already done
if (!isset($_SESSION)) {
    session_start();
}?>

<!DOCTYPE html>
<html>

<head>
    <div class="header"><img src="img\header.png"></div>
    <?php include('menu_participant.php');?>
    </br> </br>
    <?php
    if (!isset($_SESSION['id_activity1'])){
        $_SESSION['id_activity1'] = $_GET['id'];
    }?>
    <meta charset="utf-8" />

    <link rel="stylesheet" type="text/css" href="css/pa_empathize.css" />
    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.2.6.css" media="screen" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="fancybox/jquery.fancybox-1.2.6.pack.js"></script>

    <script type="text/javascript" src="script.js"></script>
</head>

<body>
<h2>1. Empathize: Empathy map</h2>
</br></br>
<input type="button" class="button" onclick=window.location.href="../controller/pa_attendworkshop.php" value="Go back" />
</br></br>
<input type="button" class="button" onclick=window.location.href="../controller/pa_completeactivity?id=<?php echo $_SESSION['id_activity1']?>" value="Complete" />
<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=cranfield_old_dt;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Error : ' . $e->getMessage());
}
$id_activity=$_SESSION['id_activity1'];
$query = $bdd->prepare("SELECT * FROM notes WHERE id_activity=:id_activity ORDER BY id_note DESC");
$query->bindParam(":id_activity", $id_activity);
$query->execute();
$notes = '';
$left='';
$top='';
$zindex='';
while($row= $query->fetch())
{
    // The xyz column holds the position and z-index in the form 200x100x10:
    list($left,$top,$zindex) = explode('x',$row['xyz']);
    $notes.= '
        <div class="note '.$row['color'].'" style="left:'.$left.'px;top:'.$top.'px;  z-index:'.$zindex.'">
        '.htmlspecialchars($row['text']).'
        <div class="author">'.htmlspecialchars($row['name']).'</div>
        <span class="data">'.$row['id_note'].'</span>
    </div>';
} ?>
</br> </br>
<input type="button" id="addButton" class="green-button" onclick=window.location.href="pa_empathize_add_note.php" value="Add a note" /></br> </br>
<div id="main">
    <div class="map"><img src="img\empathizemap.png"></div>
    <!--<a id="addButton" class="green-button" href="pa_ideate_add_note.php">Add a note</a>-->
    <?php echo $notes?>
</div>


<!--<h3 class="popupTitle">Add a new note</h3>

 The preview:
<div id="previewNote" class="note yellow" style="left:0;top:65px;z-index:1">
    <div class="body"></div>
    <div class="author"></div>
    <span class="data"></span>
</div>-->


</body>

</html>