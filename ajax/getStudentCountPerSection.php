<?php

$conn = require '../config/config.php';

// Store the strand names and enrollment counts
$SectionNames = [];
$SlotCounts = [];
$colors = [];
$borderColors = [];

$fetchQuery = "SELECT * FROM sections";
$fetchedData = mysqli_query($conn, $fetchQuery);
while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
    $sectionname = $DataArray['gradelevel']. ' ' . $DataArray['sectionname'];
    $currentavailableslot = $DataArray['currentavailableslot'];

        // Store the strand names and enrollment counts
        $SectionNames[] = $sectionname;
        $SlotCounts[] = $currentavailableslot;

        if ($currentavailableslot < 40) {
            $colors[] = 'rgba(255,0,0, 0.6)';
            $borderColors[] = 'rgba(255,0,0, 1)';
        }
        else {
            $colors[] = 'rgba(0,255,0, 0.6)';
            $borderColors[] = 'rgba(0,255,0, 1)';
        }

}

$slotCountArray = [
    'labels' => $SectionNames,
    'data' => $SlotCounts,
    'backgroundColor' => $colors,
    'borderColor' => $borderColors
];

header('Content-Type: application/json');
echo json_encode($slotCountArray);
?>