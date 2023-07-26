<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Задания 2");
\Bitrix\Main\Loader::includeModule('iblock');
?>

<div align="center">
    <form method="post" action="">
        <input name="iblock_id" placeholder="Введите ID инфоблока"></input>
        <input name="selection_id" placeholder="Введите ID раздела"></input>
        <p>
            <button>Поиск</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["iblock_id"]) && isset($_POST["selection_id"])) {
    $iblock_id = ucfirst($_POST['iblock_id']);
    $selection_id = ucfirst($_POST['selection_id']);
    getSelection($iblock_id, $selection_id);
}

function getSelection($iblock_id, $selection_id)
{
    $rsIblock = CIBlock::GetByID($iblock_id);
    if ($rsIblock->Fetch()) {
        $arFilter = array(
            'IBLOCK_ID' => $iblock_id,
            'ID' => $selection_id,
            'ACTIVE' => 'Y',
        );
        $res = CIBlockSection::GetList(array(), $arFilter, false, array());
            while ($select = $res->GetNext()) {
                // Выводим информацию о разделе
                echo "Описание " . $select['DESCRIPTION'] . "<br>";
                echo "Дата создания " . $select['DATE_CREATE'] . "<br>";
                $img = CFile::GetFileArray($select['PICTURE']);
                if ($img) {
                    echo '<img src="' . $img['SRC'] . '"> <p>';
                }
                getElement($iblock_id, $selection_id);
                break;
            }
    } else {
        echo "Инфоблок не найден";
    }
}

function getElement($iblock_id, $selection_id)
{
    $arFilter = array(
        'IBLOCK_ID' => $iblock_id,
        'IBLOCK_SECTION_ID' => $selection_id,
        'ACTIVE' => 'Y',
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, array());
    while ($element = $res->GetNext()) {
        // Выводим информацию об элементе
        echo "ID " . $element['ID'] . "<br>";
        echo "Название " . $element['NAME'] . "<br>";
        echo "Описание " . $element['PREVIEW_TEXT'] . "<br>";
        echo "_______________________________________<p>";
    }
}
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>