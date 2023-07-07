<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles/materials.css">
  <title>Материалы</title>
</head>
<body>
<main>
  <h3>Материалы</h3>
  <a href="index.php">Добавить материал</a>
  <table>
    <tr>
      <th>Дата и время последнего изменения</th>
      <th>Название материала</th>
      <th>Описание материала</th>
      <th>Кнопки действия</th>
    </tr>
     <?php
    
    			$host = 'localhost';
				$user = 'xcpmbjoa_newBD';
				$pass = '7PuhJV7pC';
				$db_name = 'xcpmbjoa_newBD';
				$link = mysqli_connect($host, $user, $pass, $db_name);
    			if (isset($_GET['del'])) {
    				$sql = mysqli_query($link, "DELETE FROM `materials` WHERE `id` = {$_GET['del']}");
			}
    
            $sql = mysqli_query($link, 'SELECT `id`, `update_at`, `name`, `description` FROM `materials`');
            while ($result = mysqli_fetch_array($sql)) {
                echo "<tr><td>{$result['update_at']}</td> 
                          <td>{$result['name']}</td>
                          <td>{$result['description']}</td>
                          <td><a href='?del={$result['id']}'>Удалить</a><br></td></tr>";
            }
            ?>
  </table>
</main>

</body>
</html>