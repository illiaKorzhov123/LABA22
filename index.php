<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма з базою даних MongoDB</title>
</head>
<body>
<?php
// Підключення до бази даних MongoDB
require "vendor/autoload.php";
$client = new MongoDB\Client();
$database = $client->selectDatabase('hospital');
$collection = $database->selectCollection('shifts');

// Отримання списку медсестер з бази даних
$distinctNurses = $collection->distinct('nurses');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Отримання обраної медсестри з форми
    $selectedNurse = $_POST['nurse'];

    // Запит до бази даних для отримання переліку палат для обраної медсестри
    $roomsQuery = [
        'nurses' => $selectedNurse
    ];
    $distinctRooms = $collection->distinct('rooms', $roomsQuery);
}
?>


<form method="POST" action = '1.php'>
    <label for="nurse">Оберіть медсестру:</label>
    <select name="nurse" id="nurse">
        <?php 
        
        require "vendor/autoload.php";
$client = new MongoDB\Client();
$database = $client->selectDatabase('hospital');
$collection = $database->selectCollection('shifts');

// Отримання списку медсестер з бази даних
$distinctNurses = $collection->distinct('nurses');
        foreach ($distinctNurses as $nurse) { ?>
            <option value="<?php echo $nurse; ?>"><?php echo $nurse; ?></option>
        <?php } ?>
    </select>
    <br>
    <input type="submit" value="Відправити">
</form>














<form method="POST" action = '2.php'>
    <label for="department">Оберіть відділення:</label>
    <select name="department" id="department">
        <?php 
        require "vendor/autoload.php";
        $client = new MongoDB\Client();
        $database = $client->selectDatabase('hospital');
        $collection = $database->selectCollection('shifts');
        
        // Отримання списку відділень з бази даних
        $distinctDepartments = $collection->distinct('department');
        foreach ($distinctDepartments as $department) { ?>
            <option value="<?php echo $department; ?>"><?php echo $department; ?></option>
        <?php } ?>
    </select>
    <br>
    <input type="submit" value="Відправити">
</form>







<form method="POST" action = '3.php'>


    <label for="shift">Оберіть зміну:</label>
    <select name="shift" id="shift">
        <?php 
        
        // Підключення до бази даних MongoDB
require "vendor/autoload.php";
$client = new MongoDB\Client();
$database = $client->selectDatabase('hospital');
$collection = $database->selectCollection('shifts');

// Отримання списку змін та відділень з бази даних
$distinctShifts = $collection->distinct('shift');
$distinctDepartments = $collection->distinct('department');

        foreach ($distinctShifts as $shift) { ?>
            <option value="<?php echo $shift; ?>"><?php echo $shift; ?></option>
        <?php } ?>
    </select>
    <br>

    <label for="department">Оберіть відділення:</label>
    <select name="department" id="department">
        <?php foreach ($distinctDepartments as $department) { ?>
            <option value="<?php echo $department; ?>"><?php echo $department; ?></option>
        <?php } ?>
    </select>
    <br>

    <input type="submit" value="Відправити">
</form>


<form action="localStorage.php">
    local storage: <input type="submit" value="local">
</form>

</body>
</html>