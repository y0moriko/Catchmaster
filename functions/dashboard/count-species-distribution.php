<?php
include __DIR__ . '/../conn.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "
    SELECT 
        f.fish_name,
        SUM(fc.quantity_kg) AS total_kg
    FROM 
        fishcatch fc
    JOIN 
        fish f ON fc.fish_id = f.fish_id
    GROUP BY 
        f.fish_name
    ORDER BY 
        total_kg DESC
";

$result = mysqli_query($conn, $sql);

$speciesData = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $speciesData[] = [
            "species" => $row['fish_name'],
            "total" => (float)$row['total_kg']
        ];
    }
}

mysqli_close($conn);
?>
