<?php
$host = "localhost"; 
$username = "root";  
$password = "root";  
$database = "mgmt_webapp_msc"; 

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT package_name, duration_days, cost, package_details FROM holiday_packages";
$result = $mysqli->query($query);

if (!$result) {
    die("Error fetching packages: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Packages</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="navbar">
        <div class="logo">
            <img src="images/logo.png" alt="EcoQuest Logo" class="logo-img">
            EcoQuest <span>Adventures</span>
        </div>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="packages.html" class="active">Packages</a></li>
            <li><a href="booking.php">Booking</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </header>

    <main class="package-main">
        <?php
        if ($result->num_rows > 0) {
            $delay = 1;
            while ($row = $result->fetch_assoc()) {
                $packageClass = '';
                if ($row['package_name'] == 'Diamond') {
                    $packageClass = 'diamond-package';
                } elseif ($row['package_name'] == 'Silver') {
                    $packageClass = 'silver-package';
                } else {
                    $packageClass = 'gold-package';
                }

                echo '<section class="package-card package-fade-in delay-' . $delay . ' ' . $packageClass . '">';
                echo '    <div class="package-icon">';
                if ($row['package_name'] == 'Diamond Adventure Package') {
                    echo '        <i class="fa fa-gem"></i>';
                } elseif ($row['package_name'] == 'Silver Adventure Package') {
                    echo '        <i class="fa fa-snowflake"></i>';
                } else {
                    echo '        <i class="fa fa-trophy"></i>';
                }
                echo '    </div>';
                echo '    <h2>' . htmlspecialchars($row['package_name']) . '</h2>';
                echo '    <p><strong>Duration:</strong> ' . htmlspecialchars($row['duration_days']) . ' days</p>';
                echo '    <p><strong>Price:</strong> £' . htmlspecialchars($row['cost']) . ' per adult</p>';
                echo '    <p><strong>Included Experiences:</strong> ' . htmlspecialchars($row['package_details']) . '</p>';
                echo '    <p><strong>Family Discount:</strong> 30% off for children</p>';
                echo '    <a href="booking.php" class="btn">Book Now</a>';
                echo '</section>';
                $delay++;
            }
        } else {
            echo '<p>No packages available.</p>';
        }
        ?>
    </main>

    <footer>
        <p>Note: This is a fictitious website developed by a student as part of a programming assignment. None of the content on this page is meant to be genuine nor should it be taken as such.</p>
    </footer>

</body>
</html>

<?php
$mysqli->close();
?>
