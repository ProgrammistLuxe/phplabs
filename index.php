<?php

$servername = "DESKTOP-1V0MHOV\\TEST";
$database = "AdventureWorksDW2019";

$page = 1;
$pageSize = 100;

$offset = ($page - 1) * $pageSize;

try {

    $dsn = "sqlsrv:Server=$servername;Database=$database";


    $pdo = new PDO($dsn, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);


    $sql = "SELECT * FROM [AdventureWorksDW2019].[dbo].[DimProduct] 
            ORDER BY ProductKey 
            OFFSET :offset ROWS 
            FETCH NEXT :pageSize ROWS ONLY";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':pageSize', $pageSize, PDO::PARAM_INT);


    $stmt->execute();


    $rows = $stmt->fetchAll();

    if (count($rows) > 0) {
        echo '<ul>';
        foreach ($rows as $row) {
            echo '<li>' . $row['EnglishProductName'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo "0 results";
    }

} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}
?>