<!DOCTYPE html>
<head>
    <div class="header"><img src="img\header.png"></div>
    <?php
    ///Start the session if it's not already done
    if (!isset($_SESSION)) {
        session_start();
    }
    include('../controller/import_models.php');
    include('menu_coordinator.php');?>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/co_ingoingworkshop.css"/>
</head>

<body>
</br></br>
<h2>In-going Workshops</h2>
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
        <th>Technicians</th>
        <th>Number of group(s)</th>
    </tr>
    <?php
    $imax = sizeof($_SESSION['tabIGWorkshop']);

    for ($i=0; $i<$imax; $i=$i+17) {
    ?>

    <tbody> <!-- Content of the table -->
    <tr>
        <td><?php echo $id = $_SESSION['tabIGWorkshop'][$i];?></td>
        <td><?php echo $_SESSION['tabIGWorkshop'][$i+1]; ?></td>
        <td><?php echo $_SESSION['tabIGWorkshop'][$i+2]; ?></td>
        <td><?php echo $_SESSION['tabIGWorkshop'][$i+3]; ?></td>
        <td><?php echo $_SESSION['tabIGWorkshop'][$i+4]; ?></td>
        <td><?php echo $_SESSION['tabIGWorkshop'][$i+5]; ?></td>
        <td><?php echo $_SESSION['tabIGWorkshop'][$i+6]; ?></td>
        <td><?php echo $_SESSION['tabIGWorkshop'][$i+7]; ?></td>
        <td><?php echo $_SESSION['tabIGWorkshop'][$i+8]; ?></td>
        <td class="button">
            <input type="button" onclick=window.location.href="../controller/co_viewigworkshop?id=<?php echo $id?>" value="View/Edit" />
        </td>
    </tr>
    <?php } ?>

    </tbody>
</table>

</body>

<footer>

</footer>