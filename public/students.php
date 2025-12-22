<?php
include '../includes/header.php';

$file = "../data/students.txt";
$students = file_exists($file) ? file($file) : [];
?>

<h2>Student List</h2>

<?php
foreach ($students as $student) {

    $parts = explode("|", trim($student));

    $name  = $parts[0] ?? "";
    $email = $parts[1] ?? "";
    $skills = $parts[2] ?? "";

    $skillsArray = !empty($skills) ? explode(",", $skills) : [];

    echo "<strong>Name:</strong> $name<br>";
    echo "<strong>Email:</strong> $email<br>";
    echo "<strong>Skills:</strong> ";

    if (!empty($skillsArray)) {
        echo "<ul>";
        foreach ($skillsArray as $skill) {
            echo "<li>" . htmlspecialchars($skill) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "None";
    }

    echo "<hr>";
}
?>

<?php include '../includes/footer.php'; ?>
