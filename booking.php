<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Adventure</title>
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
            <li><a href="packages.html">Packages</a></li>
            <li><a href="booking.html" class="active">Booking</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </header>

    <main class="booking-main">
        <section class="booking-form">
            <h2>Book Your Adventure</h2>
            <form id="booking-form">
                <label for="package">Choose Your Package:</label>
                <select id="package" name="package">
                    <?php
                    $host = "localhost";
                    $username = "root";
                    $password = "root";
                    $database = "mgmt_webapp_msc";

                    $mysqli = new mysqli($host, $username, $password, $database);

                    if ($mysqli->connect_error) {
                        die("Connection failed: " . $mysqli->connect_error);
                    }

                    $get_products_sql = "SELECT package_name, cost FROM holiday_packages";
                    $result = $mysqli->query($get_products_sql);

                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['package_name']) . "'>" . htmlspecialchars($row['package_name']) . " - £" . htmlspecialchars($row['cost']) . "</option>";
                        }
                        $result->free();
                    } else {
                        echo "<option value=''>Error loading packages</option>";
                    }
                    $mysqli->close();
                    ?>
                </select>

                <label for="adults">Number of Adults:</label>
                <input type="number" id="adults" name="adults" min="1" value="1">

                <label for="children">Number of Children:</label>
                <input type="number" id="children" name="children" min="0" value="0">
                <span class="discount-note">(Children's tickets are 30% off)</span>
            </form>
        </section>

        <section class="quote-info">
            <h2>Booking Summary</h2>
            <p><strong>Package:</strong> <span id="selected-package">Diamond Adventure Package</span></p>
            <p><strong>Adults:</strong> <span id="adults-count">1</span></p>
            <p><strong>Children:</strong> <span id="children-count">0</span></p>
            <p><strong>Details:</strong> <span id="cost-details">1 Adult (£1200) + 0 Child (£0) + 15% VAT</span></p>
            <p><strong>Total Cost:</strong> £<span id="total-cost">1,200</span></p>
        </section>

    </main>

    <footer>
        <p>Note: This is a fictitious website developed by a student as part of a programming assignment. None of the content on this page is meant to be genuine nor should it be taken as such.</p>
    </footer>

    <script src="script.js"></script>
</body>

</html>