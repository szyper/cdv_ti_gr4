<?php
  session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/table.css">
  <title>Użytkownicy</title>
</head>
<body>
	<h4>Użytkownicy</h4>
  <?php
    if (isset($_GET["infoDeleteUser"])){
	    if ($_GET["infoDeleteUser"] == 0){
		    echo "<h4>Nie udało się usunąć użytkownika!</h4>";
	    }else{
		    echo "<h4>Prawidłowo usunięto użytkownika!</h4>";
	    }
    }

    if (isset($_SESSION["error"])){
      echo "<h4>$_SESSION[error]</h4>";
      unset($_SESSION["error"]);
    }
  ?>
  <table>
    <tr>
      <th>Imię</th>
      <th>Nazwisko</th>
      <th>Data urodzenia</th>
      <th>Miasto</th>
      <th>Województwo</th>
      <th>Państwo</th>
    </tr>

  <?php
    require_once "../scripts/connect.php";
    $sql = "select u.id userId, u.firstName, u.lastName, u.birthday, c.city, s.state, c2.country from users u JOIN cities c on c.id = u.city_id JOIN states s on s.id = c.state_id JOIN countries c2 on s.country_id = c2.id;";
    $result = $conn->query($sql);
    //echo $result->num_rows;

  //tr, td, colspan
    if ($result->num_rows == 0){
      echo "<tr><td colspan='6'>Brak rekordów do wyświetlenia</td></tr>";
    }else{
	    while($user = $result->fetch_assoc()){
		    echo <<< TABLEUSERS
        <tr>
          <td>$user[firstName]</td>
          <td>$user[lastName]</td>
          <td>$user[birthday]</td>
          <td>$user[city]</td>
          <td>$user[state]</td>
          <td>$user[country]</td>
          <td><a href="../scripts/delete_user.php?userDeleteId=$user[userId]">Usuń</a></td>
          <td><a href="./4_db_delete_add_update.php?userUpdateId=$user[userId]">Aktualizuj</a></td>
        </tr>
TABLEUSERS;
	    }
    }
    echo "</table>";

    if (isset($_GET["addUserForm"])){
      echo <<<ADDUSERFORM
        <h4>Dodawanie użytkownika</h4>
        <form action="../scripts/add_user.php" method="post">
          <input type="text" name="firstName" placeholder="Podaj imię"><br><br>
          <input type="text" name="lastName" placeholder="Podaj nazwisko"><br><br>
          <input type="date" name="birthday"> Data urodzenia<br><br>
          <select name="city_id">
      ADDUSERFORM;
          $sql = "SELECT * FROM cities";
          $result = $conn->query($sql);
          while($city = $result->fetch_assoc()){
            echo "<option value='$city[id]'>$city[city]</option>";
          }
	    echo <<<ADDUSERFORM
          </select><br><br>
          <input type="submit" value="Dodaj użytkownika">
        </form>
ADDUSERFORM;
    }else{
      echo "<a href=\"./4_db_delete_add_update.php?addUserForm=1\">Dodaj użytkownika</a>";
    }

// aktualizacja użytkownika
  if (isset($_GET["userUpdateId"])){
	  $_SESSION["userUpdateId"] = $_GET["userUpdateId"];
    $sql = "SELECT u.firstName, u.lastName, u.birthday, u.city_id FROM users u WHERE u.id=$_GET[userUpdateId]";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
	  echo <<<UPDATEUSERFORM
        <h4>Aktualiacja użytkownika</h4>
        <form action="../scripts/update_user.php" method="post">
          <input type="text" name="firstName" value="$user[firstName]"><br><br>
          <input type="text" name="lastName" value="$user[lastName]"><br><br>
          <input type="date" name="birthday" value="$user[birthday]"> Data urodzenia<br><br>
          <select name="city_id">
      UPDATEUSERFORM;
	  $sql = "SELECT * FROM cities";
	  $result = $conn->query($sql);
	  while($city = $result->fetch_assoc()){
      if ($city["id"] == $user["city_id"]){
	      echo "<option value='$city[id]' selected>$city[city]</option>";
      }else{
	      echo "<option value='$city[id]'>$city[city]</option>";
      }
	  }
	  echo <<<UPDATEUSERFORM
          </select><br><br>
          <input type="submit" value="Aktualizuj użytkownika">
        </form>
UPDATEUSERFORM;
  }
  ?>

</body>
</html>