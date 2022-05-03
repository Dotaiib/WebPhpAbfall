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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<title>Überlagerte Ware</title>
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
if(isset($_POST['submit']))
{    
     $produkt = $_POST['produkt'];
     $charge = $_POST['charge'];
     $grund = $_POST['grund'];
     $gebindeinhalt = $_POST['gebindeinhalt'];
     $anzahlgebinde = $_POST['anzahlgebinde'];
     $menge = $_POST['menge'];
     $abfallart=$_POST['abfallart'];

     $sql = "INSERT INTO Ueberlagerte_Ware (UW_Produkt,UW_Charge,UW_Grund,UW_Gebindeinhalt,UW_AnzahlGebinde,UW_Menge,UW_Abfallart)
     VALUES ('$produkt','$charge','$grund','$gebindeinhalt','$anzahlgebinde','$menge','$abfallart')";

     if (mysqli_query($conn, $sql)) {
        //echo "New record has been added successfully !";
        echo"<script> swal('Good job!', 'The product was added', 'success'); </script>";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>

<form method="post">

    <h2 class="display-2">Überlagerte Ware</h2> <br/>

    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Produkt</span>
    <input type="text" id="produkt" name="produkt" class="form-control" placeholder="Produkt" aria-label="Produkt" aria-describedby="basic-addon1" required/>
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Charge</span>
    <input type="text" id="charge" name="charge" class="form-control" placeholder="Charge" aria-label="Charge" aria-describedby="basic-addon1" required/>
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Grund</span>
    <textarea id="grund" name="grund" class="form-control" placeholder="Grund" aria-label="Grund" aria-describedby="basic-addon1" rows="3" cols="83" required></textarea>
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Gebindeinhalt [kg]</span>
    <input type="text" id="gebindeinhalt" name="gebindeinhalt" class="form-control" placeholder="Gebindeinhalt" aria-label="Gebindeinhalt" aria-describedby="basic-addon1" required/>
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Anzahl Gebinde</span>
    <input type="text" id="anzahlgebinde" name="anzahlgebinde" class="form-control" placeholder="Anzahl Gebinde" aria-label="Anzahl Gebinde" aria-describedby="basic-addon1" required/>
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Menge [kg]</span>
    <input type="text" id="menge" name="menge" class="form-control" placeholder="Menge" aria-label="Menge" aria-describedby="basic-addon1" required/>
    </div>

    <div class="input-group mb-3">
    <label class="input-group-text" for="inputGroupSelect01">Abfallart</label>
    <select class="form-select" id="abfallart" name="abfallart" required>
        <option value="">Wählen...</option>
        <option value="Lackabfall lösemittelhaltig">Lackabfall lösemittelhaltig</option>
        <option value="Lackabfall wässrig">Lackabfall wässrig</option>
        <option value="Rohstoffe">Rohstoffe</option>
        <option value="Isocyanate">Isocyanate</option>
    </select>
    </div>

    <button type="submit" name="submit" class="btn btn-outline-dark btn-lg">Submit</button><br/>

    <?php
include 'Connection.php';
$sql = "select UW_Produkt,UW_Charge,UW_Grund,UW_Gebindeinhalt,UW_AnzahlGebinde,UW_Menge,UW_Abfallart from Ueberlagerte_Ware order by UW_Save_Time desc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<br/> <br/> <br/>";
    echo"<div class='mydivtable'>";
    echo "<table class='table table-hover mytable'>";
        echo "<tr>";
            echo "<th>Produkt</th>";
            echo "<th>Charge</th>";
            echo "<th>Grund</th>";
            echo "<th>Gebindeinhalt [kg]</th>";
            echo "<th>Anzahl Gebinde</th>";
            echo "<th>Menge [kg]</th>";
            echo "<th>Abfallart</th>";
            echo "<tr>";            
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
                echo "<td>" . $row['UW_Produkt'] . "</td>";
                echo "<td>" . $row['UW_Charge'] . "</td>";
                echo "<td>" . $row['UW_Grund'] . "</td>";
                echo "<td>" . $row['UW_Gebindeinhalt'] . "</td>";
                echo "<td>" . $row['UW_AnzahlGebinde'] . "</td>";
                echo "<td>" . $row['UW_Menge'] . "</td>";
                echo "<td>" . $row['UW_Abfallart'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo"</div>";
    echo "<br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>";
}

else {
  echo "<br/> <br/> <br/>";
  echo "<table class='table table-hover mytable'>";
      echo "<tr>";
          echo "<th>Produkt</th>";
          echo "<th>Charge</th>";
          echo "<th>Grund</th>";
          echo "<th>Gebindeinhalt [kg]</th>";
          echo "<th>Anzahl Gebinde</th>";
          echo "<th>Menge</th>";
          echo "<th>Abfallart</th>";
          echo "<tr>";
  echo "</table>";
  echo "<br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>";
}

$conn->close();
?>

</form>

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


<script>
    $(function () {
    $("#gebindeinhalt, #anzahlgebinde").keyup(function () {
    //$("#menge").val(+$("#gebindeinhalt").val() * +$("#anzahlgebinde").val());
    totalAmount = Number($("#gebindeinhalt").val()) * Number($("#anzahlgebinde").val());
    totalAmount = totalAmount.toFixed(2);
    $('#menge').val(totalAmount);
  });
});


//Function for allowing only numbers with decimal
function setInputFilter(textbox, inputFilter, errMsg) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(event) {
    textbox.addEventListener(event, function(e) {
      if (inputFilter(this.value)) {
        // Accepted value
        if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
          this.classList.remove("input-error");
          this.setCustomValidity("");
        }
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        // Rejected value - restore the previous one
        this.classList.add("input-error");
        this.setCustomValidity(errMsg);
        this.reportValidity();
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        // Rejected value - nothing to restore
        this.value = "";
      }
    });
  });
}
//input to set the function above
setInputFilter(document.getElementById("gebindeinhalt"), function(value) {
  return /^-?\d*[.,]?\d*$/.test(value); }, "Must be a floating (real) number");
setInputFilter(document.getElementById("anzahlgebinde"), function(value) {
  return /^-?\d*[.,]?\d*$/.test(value); }, "Must be a floating (real) number");
setInputFilter(document.getElementById("menge"), function(value) {
  return /^-?\d*[.,]?\d*$/.test(value); }, "Must be a floating (real) number");

//Block browser backwards  
history.pushState(null, null, location.href);
window.onpopstate = function () {
  history.go(1);
};
  
</script>

</body>
</html>