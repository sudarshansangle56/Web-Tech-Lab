<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript">
        function valid() {
            var rollNumber = document.f1.t1.value;
            var name = document.f1.t2.value;
            var email = document.f1.t3.value;
            var mobile = document.f1.t4.value;

            if (rollNumber === "") {
                alert("Please enter the roll number");
                document.f1.t1.focus();
                return false;
            }
            if (name === "") {
                alert("Please enter the name");
                document.f1.t2.focus();
                return false;
            }
            if (email === "") {
                alert("Please enter the email");
                document.f1.t3.focus();
                return false;
            }
            if (mobile === "") {
                alert("Please enter the mobile number");
                document.f1.t4.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <form name="f1" method="post">
        <table>
            <tr>
                <td>Enter the Roll Number:</td>
                <td><input type="text" name="t1"></td>
            </tr>
            <tr>
                <td>Enter the Name:</td>
                <td><input type="text" name="t2"></td>
            </tr>
            <tr>
                <td>Enter the Email:</td>
                <td><input type="email" name="t3"></td>
            </tr>
            <tr>
                <td>Enter the No:</td>
                <td><input type="number" name="t4"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="b1" onclick="return valid();" value="Add"></td>
                <td colspan="2"><input type="submit" name="b2" value="Update"></td>
                <td colspan="2"><input type="submit" name="b3" value="Delete"></td>
                <td colspan="2"><input type="submit" name="b4" value="Display"></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['b1'])) {
        echo "Record added successfully";
    }
    if (isset($_POST['b2'])) {
        echo "Record updated successfully";
    }
    if (isset($_POST['b3'])) {
        echo "Record deleted successfully";
    }
    if (isset($_POST['b4'])) {
        echo "Records displayed successfully";
    }
    ?>
</body>
</html>
