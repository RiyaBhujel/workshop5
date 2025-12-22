<?php
include '../includes/header.php';

function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    return array_map('trim', explode(',', $string));
}

function saveStudent($name, $email, $skillsArray) {
    $file = "../data/students.txt";
    $data = $name . "|" . $email . "|" . implode(",", $skillsArray) . PHP_EOL;
    file_put_contents($file, $data, FILE_APPEND);
}

$message = "";

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name   = formatName($_POST['name']);
        $email  = $_POST['email'];
        $skills = cleanSkills($_POST['skills']);

        if (empty($name) || !validateEmail($email)) {
            throw new Exception("Invalid name or email");
        }

        saveStudent($name, $email, $skills);
        $message = "Student added successfully!";
    }
} catch (Exception $e) {
    $message = $e->getMessage();
}
?>

    <?php if (!empty($message)) { ?>
        <p class="success"><?php echo $message; ?></p>
    <?php } ?>

    <form method="post">
        Name:
        <input type="text" name="name" required>

        Email:
        <input type="email" name="email" required>

        Skills:
        <input type="text" name="skills" required>

        <button type="submit">Save</button>
    </form>

<?php include '../includes/footer.php'; ?>
