<?php //Start the session if it's not already done
if (!isset($_SESSION)) {
    session_start();
}?>

<!DOCTYPE html>
<html>

<head>
    <div class="header"><img src="img\header.png"></div>
    <?php
    include('menu_judge.php');?>

    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/ju_viewoutputs.css"/>
</head>

<body>
</br></br>
<h2>My Design Thinking Workshop : </br> <?php echo $_SESSION['title']; ?></h2>
</br>
<div id="conteneur">
    <div class="group1output">
        <h2>First group's final output</h2>
        <span> <Strong>Name: </Strong> The best product of the world</span> </br></br>
        <span> <Strong>Prototype: </Strong></span> </br></br><div class="output1"><img src="img\prototype.png"></div>  </br></br>
        <input type="button" class="button" onclick=window.location.href="" value="Choose this final output" />
    </div>
    <div class="group2output">
        <h2>Second group's final output</h2>
        <span> <Strong>Name: </Strong> The most innovative product</span> </br></br>
        <span> <Strong>Prototype: </Strong> </span> </br></br><div class="output2"><img src="img\prototype.png"></div> </br></br>
        <input type="button" class="button" onclick=window.location.href="" value="Choose this final output" />
    </div>
    <div class="group3output">
        <h2>Third group's final output</h2>
        <span> <Strong>Name: </Strong> Our innovative product</span> </br></br>
        <span> <Strong>Prototype: </Strong> </span></br> </br><div class="output3"><img src="img\prototype.png"></div> </br></br>
        <input type="button" class="button" onclick=window.location.href="" value="Choose this final output" />
    </div>
</div>
</br> </br>
</body>
</html>