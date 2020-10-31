<?php
include("../config.php");
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}
$user = $_SESSION['user'];
?>
<?php include("header.php"); ?>

<div id="main">
    <div id="testdetail">

        <?php
        $code = isset($_GET['code']) ? $_GET['code'] : '';
        $sql = "SELECT * FROM test WHERE code='$code'  ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        ?>
        <span>Test Name : <?php echo $row['name']; ?></span></br>
        <span>Test Code : <?php echo $row['code']; ?></span>
    </div>
    <div id="questable">

        <table>
            <?php
            $code = isset($_GET['code']) ? $_GET['code'] : '';
            $sql = "SELECT * FROM ques WHERE testcode='$code'  ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { ?>

                <thead>
                    <tr>
                        <th>Question No</th>
                        <th>Question</th>
                        <th>Option A</th>
                        <th>Option B</th>
                        <th>Option C</th>
                        <th>Option D</th>
                        <th>Answer</th>
                        <!-- <th>Action</th> -->
                    </tr>

                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $row["quesno"]; ?></td>
                            <td><?php echo $row["question"]; ?></td>
                            <td><?php echo $row["optionA"]; ?></td>
                            <td><?php echo $row["optionB"]; ?></td>
                            <td><?php echo $row["optionC"]; ?></td>
                            <td><?php echo $row["optionD"]; ?></td>
                            <td><?php echo $row["answer"]; ?></td>

                        </tr>

                    <?php } ?>
                </tbody>
            <?php } ?>

        </table>

        <a id="backbutton" href="admin.php">Back</a>
    </div>


</div>

<?php include("footer.php"); ?>