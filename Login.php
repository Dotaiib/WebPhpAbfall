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


<title>Login</title>
</head>
<body>

<?php

include 'Connection.php';

    if (!empty($_POST["submit"]))
        {
        $_username = mysql_real_escape_string($_POST["user"]);
        $_passwort = mysql_real_escape_string($_POST["password"]);

        # Befehl für die MySQL Datenbank
        # Wichtig ist, die Variablen von $_username und $_passwort
        # zu umklammern. Da wir mit Anführungszeichen den SQL String
        # angeben, nehmen wir dafür die einfachen Anführungszeichen
        # die man neben der Enter Taste auf der # findet !
        $_sql = "SELECT * FROM WBAbfallLogin WHERE WBAL_User='$_username' AND WBAL_Password='$_passwort' LIMIT 1";

        # Prüfen, ob der User in der Datenbank existiert !
        $_res = mysql_query($_sql, $conn);
        $_anzahl = @mysql_num_rows($_res);

        # Die Anzahl der gefundenen Einträge überprüfen. Maximal
        # wird 1 Eintrag rausgefiltert (LIMIT 1). Wenn 0 Einträge
        # gefunden wurden, dann gibt es keinen Usereintrag, der
        # gültig ist. Keinen wo der Username und das Passwort stimmt
        # und user_geloescht auch gleich 0 ist !
        if ($_anzahl > 0)
            {
            echo "Der Login war erfolgreich.<br>";

            # In der Session merken, dass der User eingeloggt ist !
            $_SESSION["login"] = 1;

            # Den Eintrag vom User in der Session speichern !
            $_SESSION["user"] = mysql_fetch_array($_res, MYSQL_ASSOC);

            # Das Einlogdatum in der Tabelle setzen !
            /*$_sql = "UPDATE login_usernamen SET letzter_login=NOW()
                     WHERE id=".$_SESSION["user"]["id"];
            mysql_query($_sql);*/
            }
        else
            {
            echo "Die Logindaten sind nicht korrekt.<br>";
            }
        }

    # Ist der User eingeloggt ???
    /*if ($_SESSION["login"] == 0)
        {
        # ist nicht eingeloggt, also Formular anzeigen, die Datenbank
        # schliessen und das Programm beenden
        include("login-formular.html");
        mysql_close($link);
        exit;
        }*/

    # Hier wäre der User jetzt gültig angemeldet ! Hier kann
    # Programmcode stehen, den nur eingeloggte User sehen sollen !!
?>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="text" id="user" placeholder="User" class="form-control form-control-lg" required/>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="password" placeholder="Password" class="form-control form-control-lg" required/>
              </div>

              <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>



