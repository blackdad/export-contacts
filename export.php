<?php

use Bitrix\Main\Application;

if($_POST['download_csv'])
{

    require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


    $records = Application::getConnection()
        ->query("SELECT NAME, LAST_NAME FROM `b_crm_contact`")
        ->fetchAll();

    foreach($records as $contact)
    {
        $result.= $contact['NAME'].';'.$contact['LAST_NAME']."\r\n";
    }

    header("Content-type: text/plain");
    header("Content-Disposition: attachment; filename=contacts.csv");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
    echo $result;
    die;
}


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


?>

    <form method="post">
        <input type="hidden" name="download_csv" value="1" />
        <input type="submit" value="Export" />
    </form>

<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");