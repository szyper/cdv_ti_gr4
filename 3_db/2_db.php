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
    $sql = "select * from users u JOIN cities c on c.id = u.city_id JOIN states s on s.id = c.state_id JOIN countries c2 on s.country_id = c2.id;";
    $result = $conn->query($sql);
    while($user = $result->fetch_assoc()){
      echo <<< TABLEUSERS
        <tr>
          <td>$user[firstName]</td>
          <td>$user[lastName]</td>
          <td>$user[birthday]</td>
          <td>$user[city]</td>
          <td>$user[state]</td>
          <td>$user[country]</td>
        </tr>
TABLEUSERS;
    }
    echo "</table>";
  ?>
</body>
</html>