<?php
$servername = "DESKTOP-1V0MHOV\\TEST";
$database = "AdventureWorksDW2019";

try {
    $dsn = "sqlsrv:Server=$servername;Database=$database";
    $pdo = new PDO($dsn, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $pdo->exec("DROP INDEX idx_customer_key ON [dbo].[DimCustomer]");
    echo "Index dropped successfully.<br>";
    function executeQuery($pdo, $query)
    {
        $startTime = microtime(true);
        $stmt = $pdo->query($query);
        $endTime = microtime(true);
        return [
            'data' => $stmt->fetchAll(),
            'time' => $endTime - $startTime
        ];
    }

    $sql = "SELECT * FROM [dbo].[DimCustomer] WHERE [CustomerKey] = 12993";
    $resultWithoutIndex = executeQuery($pdo, $sql);
    echo "Time without index: " . $resultWithoutIndex['time'] . " seconds<br>";

    $pdo->exec("CREATE INDEX idx_customer_key ON [dbo].[DimCustomer] (CustomerKey)");
    echo "Index created successfully.<br>";

    $resultWithIndex = executeQuery($pdo, $sql);
    echo "Time with index: " . $resultWithIndex['time'] . " seconds<br>";


} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>