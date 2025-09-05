<?php
include __DIR__ . '/../conn.php';
// Function to fetch fish species
function fetchFishSpecies($conn) {
    $species = [];
    $sql = "SELECT DISTINCT fish_name FROM fish"; // Adjust the table name and column as needed
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $species[] = $row['fish_name']; // Assuming 'fish_name' is the column for species
        }
    } else {
        $_SESSION['error'] = "Error fetching species: " . mysqli_error($conn);
    }
    return $species;
}
// Fetch species for the select input
$fishSpecies = fetchFishSpecies($conn);
mysqli_close($conn);
?>