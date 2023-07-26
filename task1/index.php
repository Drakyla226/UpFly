<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Задания 1");
?>

<div align="center">
    <form method="post" action="">
        <input name="last_name" placeholder="Введите фамилию"></input><p>
        <button>Проверить</button>
    </form>
</div>

<?php
$array = [
    [
        'id' => 1,
        'name' => 'Ivan',
        'last_name' => 'Ivanov',
        'age' => 25,
    ],
    [
        'id' => 2,
        'name' => 'Andrey',
        'last_name' => 'Petrov',
        'age' => 42,
    ],
    [
        'id' => 3,
        'name' => 'Vladimir',
        'last_name' => 'Kolosov',
        'age' => 35,
    ],
];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["last_name"])) {
    $last_name = ucfirst($_POST['last_name']);
    echo getAgeByLastName($array, $last_name);
}

function getAgeByLastName($array, $last_name){
    foreach ($array as $people) {
        if ($people['last_name'] == $last_name) {
            $result = '<b>' . $people['last_name'] . '</b> возраст = <b>' . $people['age'] . '</b>';
            break;
        }
        $result = 'Фамилия ' . $last_name . ' отсутствует';
    }
    return $result;
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>