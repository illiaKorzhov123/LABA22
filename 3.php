
<?php
// Підключення до бази даних MongoDB
require "vendor/autoload.php";
$client = new MongoDB\Client();
$database = $client->selectDatabase('hospital');
$collection = $database->selectCollection('shifts');

// Отримання списку змін та відділень з бази даних
$distinctShifts = $collection->distinct('shift');
$distinctDepartments = $collection->distinct('department');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Отримання обраної зміни та відділення з форми
    $selectedShift = $_POST['shift'];
    $selectedDepartment = $_POST['department'];

    // Запит до бази даних для отримання усіх чергувань у зазначеній зміні та відділенні
    $shiftsQuery = [
        'shift' => $selectedShift,
        'department' => $selectedDepartment
    ];
    $shifts = $collection->find($shiftsQuery);
}
?>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
    <h3>Усі чергування у зміні <?php echo $selectedShift; ?> відділенні <?php echo $selectedDepartment; ?>:</h3>
    <ul>
        <?php foreach ($shifts as $shift) { ?>
            <li>
                <strong>Зміна:</strong> <?php echo $shift['shift']; ?><br>
                <strong>Дата:</strong> <?php echo $shift['date']->toDateTime()->format('Y-m-d'); ?><br>
                
                <strong>Відділення:</strong> <?php echo $shift['department']; ?><br>
                
            </li>
        <?php } ?>
    </ul>
<?php } ?>