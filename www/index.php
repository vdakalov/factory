<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/main.css">
    <title>Материалы</title>
</head>
<body>
  <?php

  $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME, DB_PORT);

  if (isset($_POST["name_materials"])) {
      $name_materials = $_POST['name_materials'];
      $description = $_POST['description'];

      $sql = mysqli_query($link, "INSERT INTO `materials` (`name`,	`description`) VALUES ('{$_POST['name_materials']}', '{$_POST['description']}')");
      if (is_array($_POST['value'])) {
          $query = "INSERT INTO `units` (`material_id`,`value`,	`conditional_value`, `name`) VALUES ";
          foreach ($_POST['value'] as $key => $value) {
              if ($key != '0') {
                  $query .= ",";
              }
              $query .= "($link->insert_id, $value, '{$_POST['conditional_value'][$key]}', '{$_POST['name_units'][$key]}')";
          }
          echo $query;
          $sql = mysqli_query($link, $query);
      }
  }
  ?>
  <main>
      <form action="" method="post">
          <h3>Создание материала</h3>
          <p>Название материала</p>
          <input type="text" name="name_materials" required value="Название материала">
          <p>Описание материала</p>
          <textarea rows="6" name="description"></textarea><br>
          <table id="units">
              <caption>Еденицы измерения материала</caption>
              <tr>
                  <th>Доля</th>
                  <th>Усл. обозн. доли</th>
                  <th>Описание доли</th>
              </tr>
              <tr>
                  <td><input type="text" name="value[0]" readonly="readonly" value="1"></td>
                  <td><input type="text" name="conditional_value[0]"></td>
                  <td><input type="text" name="name_units[0]" value="pack"></td>
              </tr>
          </table>
          <a id="add-new-unit" href="javascript:void 0">Добавить ед.измерения материала</a><br><br>
          <input type="submit" value="Создать материал">
          <input type="reset" value="Отмена">
      </form>
  </main>
  <article>
      <a href="materials.php">Посмотреть все материалы</a>
  </article>
</body>

<script>
    const $table = window.document.querySelector('#units');
    const $rows = $table.querySelector('tbody:last-child');
    const $addNewUnit = window.document.querySelector('#add-new-unit');
    $addNewUnit.addEventListener('click', function () {
        addRow();
    })


    /**   *
     * @param {number} value   * @param {number} conditional_value
     * @param {string} name   * @return {HTMLTableRowElement}
     */  function addRow() {
        const index = $rows.children.length - 1;
        const $row = $rows.appendChild(window.document.createElement('tr'));
        /**
         *     * @type {HTMLTableRowElement}
         */
        const $td1 = $row.appendChild(window.document.createElement('td'));
        const $td1Input = $td1.appendChild(window.document.createElement('input'));
        $td1Input.type = 'number';
        $td1Input.min = '0';
        $td1Input.name = 'value[' + index + ']';

        /**
         *     * @type {HTMLTableRowElement}
         */
        const $td2 = $row.appendChild(window.document.createElement('td'));
        const $td2Input = $td2.appendChild(window.document.createElement('input'));
        $td2Input.type = 'number';
        $td2Input.name = 'conditional_value[' + index + ']';


        /**
         *     * @type {HTMLTableRowElement}
         */
        const $td3 = $row.appendChild(window.document.createElement('td'));
        const $td3Input = $td3.appendChild(window.document.createElement('input'));
        $td3Input.type = 'text';
        $td3Input.name = 'name_units[' + index + ']';

        const $td4 = $row.appendChild(window.document.createElement('td'));
        const $td4Input = $td4.appendChild(window.document.createElement('button'));
        $td4Input.textContent = 'X';
        $td4Input.addEventListener('click', function () {
            $row.parentElement.removeChild($row);
        })
        return $row;
    }</script>
</html>