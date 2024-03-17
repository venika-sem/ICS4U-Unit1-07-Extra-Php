<?php
// This program calculates the median and mean of a set of numbers
// By Venika Sem
// @version 1.0
// @since Feb-2024

// Function to generate a Gaussian random number
function generateGaussian($mean, $std) {
    // Using Box-Muller transform
    $u1 = mt_rand() / mt_getrandmax();
    $u2 = mt_rand() / mt_getrandmax();

    $z0 = sqrt(-2.0 * log($u1)) * cos(2 * M_PI * $u2);

    return $z0 * $std + $mean;
}

// Initialize array with header
$array = 'Name,';
for ($counter = 1; $counter < 9; $counter++) {
    $array .= 'Assignment' . $counter . ',';
}
$array .= "\n";

// Generate marks
$sum = 0;
$listCount = 0;
$studentCount = 1;
for ($counter = 0; $counter < 24; $counter++) {
    $normalNumber = generateGaussian(75, 10);
    $sum += $normalNumber;

    if ($listCount == 0) {
        $array .= 'Student' . $studentCount . ',';
        $studentCount++;
    }

    $array .= floor($normalNumber) . ',';

    if ($listCount == 7) {
        $array .= "\n";
        $listCount = 0;
    } else {
        $listCount++;
    }
}

// Calculate average
$average = $sum / $counter;

echo "\nMark Average: " . number_format($average, 2) . "\n";
echo $array;

file_put_contents("Marks.csv", $array);

echo "\nDone.";
?>
