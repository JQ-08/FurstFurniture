<?php
//******************   DASHBOARD FUNCTIONS START  *********************//
// Query to count products by type
$sql = "
    SELECT type, COUNT(*) as count 
    FROM products 
    WHERE type IN ('chair', 'table', 'wardrobe')
    GROUP BY type
";

$result = $conn->query($sql);

// Initialize counts
$chairCount = 0;
$tableCount = 0;
$wardrobeCount = 0;

// Fetch results and assign counts
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        switch ($row['type']) {
            case 'chair':
                $chairCount = $row['count'];
                break;
            case 'table':
                $tableCount = $row['count'];
                break;
            case 'wardrobe':
                $wardrobeCount = $row['count'];
                break;
        }
    }
}

echo "<script>
        var chairCount = {$chairCount};
        var tableCount = {$tableCount};
        var wardrobeCount = {$wardrobeCount};
      </script>";
//******************   DASHBOARD FUNCTIONS END  *********************//
?>