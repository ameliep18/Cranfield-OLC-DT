<?php //Start the session if it's not already done
if (!isset($_SESSION)) {
    session_start();
}?>

<!DOCTYPE html>
<html>

<head>
    <div class="header"><img src="img\header.png"></div>
    <?php include('menu_technician.php');?>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/co_ingoingworkshop.css"/>
</head>

<body>
</br></br>
<h2>My in-going workshops</h2>
</br>

<table>
    <thead> <!-- Head of the table -->
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Goals</th>
        <th>Coordinator</th>
        <th>Judges</th>
        <th>Number of group(s)</th>
    </tr>
    <?php
    $imax = sizeof($_SESSION['tabWorkshops']);

    for ($i=0; $i<$imax; $i=$i+10) {
    ?>

    <tbody> <!-- Content of the table -->
    <tr>
        <td><?php echo $id = $_SESSION['tabWorkshops'][$i];?></td>
        <td><?php echo $_SESSION['tabWorkshops'][$i+1]; ?></td>
        <td><?php echo $_SESSION['tabWorkshops'][$i+2]; ?></td>
        <td><?php echo $_SESSION['tabWorkshops'][$i+3]; ?></td>
        <td><?php echo $_SESSION['tabWorkshops'][$i+4]; ?></td>
        <td><?php echo $_SESSION['tabWorkshops'][$i+6]; ?></td>
        <td><?php echo $_SESSION['tabWorkshops'][$i+7]; ?></td>
        <td><?php echo $_SESSION['tabWorkshops'][$i+9]; ?></td>
        <td class="button">
            <input type="button" onclick=window.location.href="../controller/tech_viewtheworkshop?id=<?php echo $id?>" value="Help prototyping" />
        </td>
    </tr>
    <?php } ?>

    </tbody>
</table>

</body>
</html>
