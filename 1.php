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

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
    <h3>Перелік палат, у яких чергує медсестра <?php echo $selectedNurse; ?>:</h3>
    <ul>
        <?php foreach ($distinctRooms as $room) { ?>
            <li><?php echo $room; ?></li>
        <?php } ?>
    </ul>
<?php } 
?>