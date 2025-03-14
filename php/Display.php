<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        .button-group input {
            width: 48%;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .button-group input:hover {
            background-color: #218838;
        }
        .message {
            margin: 10px 0;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <?php 
    include 'config.php'; // Database connection
    $message = ""; // Message variable for feedback

    // INSERT RECORD
    if (isset($_POST['add'])) {
        $roll = $_POST['roll_number'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        $stmt = $conn->prepare("INSERT INTO students (roll_number, name, email, mobile) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $roll, $name, $email, $mobile);

        if ($stmt->execute()) {
            $message = "<p class='message' style='color:green;'>Record added successfully</p>";
        } else {
            $message = "<p class='message' style='color:red;'>Error: " . $conn->error . "</p>";
        }
        $stmt->close();
    }

    // UPDATE RECORD
    if (isset($_POST['update'])) {
        $roll = $_POST['roll_number'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        $stmt = $conn->prepare("UPDATE students SET name=?, email=?, mobile=? WHERE roll_number=?");
        $stmt->bind_param("ssss", $name, $email, $mobile, $roll);

        if ($stmt->execute()) {
            $message = "<p class='message' style='color:blue;'>Record updated successfully</p>";
        } else {
            $message = "<p class='message' style='color:red;'>Error: " . $conn->error . "</p>";
        }
        $stmt->close();
    }

    // DELETE RECORD
    if (isset($_POST['delete'])) {
        $roll = $_POST['roll_number'];

        $stmt = $conn->prepare("DELETE FROM students WHERE roll_number=?");
        $stmt->bind_param("s", $roll);

        if ($stmt->execute()) {
            $message = "<p class='message' style='color:red;'>Record deleted successfully</p>";
        } else {
            $message = "<p class='message' style='color:red;'>Error: " . $conn->error . "</p>";
        }
        $stmt->close();
    }
    ?>

    <!-- Student Form -->
    <form method="post">
        <table>
            <tr>
                <td>Roll Number:</td>
                <td><input type="text" name="roll_number" required></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td>Mobile No:</td>
                <td><input type="number" name="mobile" required></td>
            </tr>
        </table>
        <div class="button-group">
            <input type="submit" name="add" value="Add">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="delete" value="Delete">
        </div>
    </form>


    <?php echo $message; ?>

    <?php
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' style='margin-top:20px; width:80%; text-align:center;'>";
        echo "<tr><th>ID</th><th>Roll Number</th><th>Name</th><th>Email</th><th>Mobile</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["roll_number"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["mobile"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='message' style='color:gray;'>No records found</p>";
    }

    $conn->close();
    ?>

</body>
</html>
