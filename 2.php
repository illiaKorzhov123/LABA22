<?php
// Підключення до бази даних MongoDB
require "vendor/autoload.php";
$client = new MongoDB\Client();
$database = $client->selectDatabase('hospital');
$collection = $database->selectCollection('shifts');

// Отримання списку відділень з бази даних
$distinctDepartments = $collection->distinct('department');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Отримання обраного відділення з форми
    $selectedDepartment = $_POST['department'];

    // Запит до бази даних для отримання медсестер обраного відділення
    $nursesQuery = [
        'department' => $selectedDepartment
    ];
    $distinctNurses = $collection->distinct('nurses', $nursesQuery);

    echo "<script>
    let arr = [];   
    if (localStorage.getItem('nurses'))
        arr = JSON.parse(localStorage.getItem('nurses'));
        arr.push(" . json_encode($distinctNurses) . ");
    localStorage.setItem('nurses', JSON.stringify(arr));
    ";
    echo "</script>";
}
?>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
    <h3>Медсестри обраного відділення <?php echo $selectedDepartment; ?>:</h3>
    <ul>
        <?php foreach ($distinctNurses as $nurse) { ?>
            <li><?php echo $nurse; ?></li>
        <?php } ?>
    </ul>
<?php } ?>