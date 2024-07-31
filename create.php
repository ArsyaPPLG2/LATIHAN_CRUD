<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $nama = trim($_POST['nama']);
    $umur = intval(trim($_POST['umur'])); // Ensure umur is treated as an integer
    $kelas = trim($_POST['kelas']);

    // Prepare an SQL statement for execution
    $sql = "INSERT INTO siswa (nama, umur, kelas) VALUES (?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sis", $nama, $umur, $kelas); // s for string, i for integer, s for string

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Siswa</title>
</head>
<body>
    <h2>Create Siswa</h2>
    <form method="POST" action="create.php">
        Nama: <input type="text" name="nama" required><br><br>
        Umur: <input type="number" name="umur" required><br><br>
        Kelas: <input type="text" name="kelas" required><br><br>
        <input type="submit" value="Create">
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
