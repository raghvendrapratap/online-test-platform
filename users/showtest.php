<?php
include("../config.php");
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}
$user = $_SESSION['user'];
$email = $_SESSION['email'];
?>

<?php include("header.php"); ?>

<div id="main">
    <div id="testtable">

        <table>
            <?php
            $sql = "SELECT * FROM test ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { ?>

                <thead>
                    <tr>
                        <th>Test Code</th>
                        <th>Test Name</th>
                        <th>No of Questions</th>
                        <th>Marks of Each Question</th>
                        <th>Total Marks</th>
                        <th>Passing Marks</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $row["code"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["ques_no"]; ?></td>
                            <td><?php echo $row["marks"]; ?></td>
                            <td><?php echo $row["ques_no"] * $row["marks"]; ?></td>
                            <td><?php echo $row["passingmarks"]; ?></td>
                            <td>
                                <a id="viewbutton" href="test.php?code=<?php echo $row["code"]; ?>&email=<?php echo $email; ?>&action=start" title="view">Start Test</a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            <?php } ?>

        </table>


    </div>

</div>


<?php include("footer.php"); ?>