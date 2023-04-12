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
        </tr>
TABLEUSERS;
	    }
    }
    echo "</table>";
  ?>

</body>
</html>