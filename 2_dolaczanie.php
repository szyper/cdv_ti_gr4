<!doctype html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Lista</title>
</head>
<body>
  <ul type="square">
    <li>Wielkopolska
      <ol type="1">
        <li>Poznań</li>
        <li>Gniezno</li>
      </ol>
    </li>
    <li>Dolnośląskie</li>
    <li>Zachodniopomorskie
      <ol>
        <li>Stargard</li>
      </ol>
    </li>
  </ul>

  <?php
    //require, require_once, include, include_once
    //@include "./scripts/list111.php";
    include_once "./scripts/list.php";
    //@require "./scripts/list1.php";

  ?>
<h4>Kod po skrypcie</h4>

</body>
</html>