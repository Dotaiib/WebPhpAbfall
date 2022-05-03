<!DOCTYPE html>
<html>
<head>

<link rel="icon" type="image/png" href="img/abfall.png" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!--Mobile Version Meta-->
<meta name="viewport" content="width=device-width" />

<link rel="stylesheet" href="css/bootstrap.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/mycss.css"/>

<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>


<title>Uebersicht</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="Uebersicht.php">Übersicht</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="UeberlagerteWare.php">Überlagerte Ware</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Reklamationen.php">Reklamationen</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Laborabfaelle.php">Laborabfälle</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Sonstiges.php">Sonstiges</a>
      </li>
    </ul>
  </div>
</nav>


<?php
include 'Connection.php';

$sql1 = "SELECT (select ROUND(IFNULL(SUM(UW_Menge), 0),2) from Ueberlagerte_Ware where UW_Abfallart='Lackabfall lösemittelhaltig') + (select ROUND(IFNULL(SUM(R_Menge), 0),2) from Reklamationen where R_Abfallart='Lackabfall lösemittelhaltig') + (select ROUND(IFNULL(SUM(L_Menge), 0),2) from Laborabfaelle where L_Abfallart='Lackabfall lösemittelhaltig') + (select ROUND(IFNULL(SUM(S_Menge), 0),2) from Sonstiges where S_Abfallart='Lackabfall lösemittelhaltig') as Lacklsmtl";
$result1 = $conn->query($sql1);

$sql2 = "SELECT (select ROUND(IFNULL(SUM(UW_Menge), 0),2) from Ueberlagerte_Ware where UW_Abfallart='Lackabfall wässrig') + (select ROUND(IFNULL(SUM(R_Menge), 0),2) from Reklamationen where R_Abfallart='Lackabfall wässrig') + (select ROUND(IFNULL(SUM(L_Menge), 0),2) from Laborabfaelle where L_Abfallart='Lackabfall wässrig') + (select ROUND(IFNULL(SUM(S_Menge), 0),2) from Sonstiges where S_Abfallart='Lackabfall wässrig') as Lackwssrig";
$result2 = $conn->query($sql2);

$sql3 = "SELECT (select ROUND(IFNULL(SUM(UW_Menge), 0),2) from Ueberlagerte_Ware where UW_Abfallart='Rohstoffe') + (select ROUND(IFNULL(SUM(R_Menge), 0),2) from Reklamationen where R_Abfallart='Rohstoffe') + (select ROUND(IFNULL(SUM(L_Menge), 0),2) from Laborabfaelle where L_Abfallart='Rohstoffe') + (select ROUND(IFNULL(SUM(S_Menge), 0),2) from Sonstiges where S_Abfallart='Rohstoffe') as Rohstoffe";
$result3 = $conn->query($sql3);

$sql4 = "SELECT (select ROUND(IFNULL(SUM(UW_Menge), 0),2) from Ueberlagerte_Ware where UW_Abfallart='Isocyanate') + (select ROUND(IFNULL(SUM(R_Menge), 0),2) from Reklamationen where R_Abfallart='Isocyanate') + (select ROUND(IFNULL(SUM(L_Menge), 0),2) from Laborabfaelle where L_Abfallart='Isocyanate') + (select ROUND(IFNULL(SUM(S_Menge), 0),2) from Sonstiges where S_Abfallart='Isocyanate') as Isocyanate";
$result4 = $conn->query($sql4);

$zahl= 1000;

echo"<br/> <br/> <br/> <br/>";
echo"<form>";
echo"<h2 class='display-2'>Übersicht Abfallmengen</h2> <br/><br/>";
    echo"<table class='table table-striped'>";
    echo"<thead class='mytable'>";
    echo"<tr>";
        echo"<th></th>";
        echo"<th>Menge gesamt [kg]</th>";
        echo"<th>Menge gesamt [t]</th>";
        echo"</tr>";
        echo"</thead>";
    echo"<tbody>";
    echo"<tr>";
        echo"<td>Lackabfall lösemittelhaltig</td>";
        while($row1 = $result1->fetch_assoc()) {
        echo"<td class='tdmenge'> ". $row1['Lacklsmtl'] ." </td>";

        $division = $row1['Lacklsmtl'] / $zahl;
        echo"<td class='tdmenge'>$division</td>";
        }
        echo"</tr>";
        echo"<tr>";
        echo"<td>Lackabfall wässrig</td>";
        while($row2 = $result2->fetch_assoc()) {
        echo"<td class='tdmenge'> ". $row2['Lackwssrig'] ." </td>";

        $division = $row2['Lackwssrig'] / $zahl;
        echo"<td class='tdmenge'>$division</td>";
        }
        echo"</tr>";
        echo"<tr>";
        echo"<td>Rohstoffe</td>";
        while($row3 = $result3->fetch_assoc()) {
        echo"<td class='tdmenge'> ". $row3['Rohstoffe'] ." </td>";

        $division = $row3['Rohstoffe'] / $zahl;
        echo"<td class='tdmenge'>$division</td>";
        }
        echo"</tr>";
        echo"<tr>";
        echo"<td>Isocyanate</td>";
        while($row4 = $result4->fetch_assoc()) {
        echo"<td class='tdmenge'> ". $row4['Isocyanate'] ." </td>";

        $division = $row4['Isocyanate'] / $zahl;
        echo"<td class='tdmenge'>$division</td>";
        }
        echo"</tr>";
        echo"</tbody>";
    echo"</table>";
    echo"</form>";
?>




<footer class="text-center text-white fixed-bottom" style="background-color: #21081a;">
  <!-- Grid container -->
  <div class="container p-4"></div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022
    <!--<a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>-->
  </div>
  <!-- Copyright -->
</footer>
</body>
</html>