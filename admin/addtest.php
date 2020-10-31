<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}
$user = $_SESSION['user'];
?>

<?php include("header.php"); ?>

<div id="main">

    <div id="addtest">
        <h3>Add Test</h3>
        <form action="addques.php" method="POST">
            <p>
                <label for="testcode">Test Code: <input type="text" name="testcode" required></label>
            </p>
            <p>
                <label for="testname">Test Name: <input type="text" name="testname" required></label>
            </p>
            <p>
                <label for="quesno">Number of Question: <input type="number" name="quesno" required></label>
            </p>
            <p>
                <label for="marks">Marks of each question: <input type="number" name="marks" required></label>
            </p>
            <p>
                <label for="passingmarks">Passing Marks: <input type="number" name="passingmarks" required></label>
            </p>
            <p>
                <label for="gender">Navigate to Next and Prev question:

                    <input type="radio" id="enable" name="navigate" value="enable" required> <label for="enable">Enable</label>

                    <input type="radio" id="disable" name="navigate" value="disable"> <label for="disable">Disable</label>

                </label>
            </p>
            <p>
                <input type="submit" id="submit" name="submit" value="Add_Questions" required>
            </p>
        </form>

    </div>

</div>

<?php include("footer.php"); ?>