<?php
include("../config.php");
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}
$user = $_SESSION['user'];
if (isset($_SESSION['code'])) {
    $testcode = $_SESSION['code'];
} else if (isset($_GET['code'])) {
    $testcode = $_GET['code'];
}
$email = $_SESSION['email'];
?>

<?php include("header.php"); ?>

<div id="main">

    <div id="test1">
        <?php
        $sql = "SELECT * FROM test WHERE code='$testcode' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $navigation = $row['navigation'];
            $maxQues = $row['ques_no'];
            $eachmarks = $row["marks"];
            $passingmarks = $row["passingmarks"];
        ?>
            <span id="spanhead" class="span1">Test Details </span></br>
            <span class="span1">Test Code :<?php echo $row['code']; ?> </span></br>
            <span class="span1">Test Name :<?php echo $row['name']; ?> </span></br>
            <span class="span1">No of Questions :<?php echo $row['ques_no']; ?> </span></br>
            <span class="span1">Total Marks :<?php echo $row["ques_no"] * $row["marks"]; ?> </span></br>
            <span class="span1" Passing Marks : <?php echo $row["passingmarks"]; ?> </span> </br> <?php } ?> </div> <div id="test2">
                <?php

                $sql1 = "SELECT * FROM ans WHERE testcode='$testcode' AND email='$email' ";
                $result1 = $conn->query($sql1);
                $correctQues = 0;
                if ($result1->num_rows > 0) {
                    $attemptQues = $result1->num_rows;
                    while ($row1 = $result1->fetch_assoc()) {
                        $qs = $row1['quesno'];
                        $ans1 = $row1['ans'];
                        $sql2 = "SELECT * FROM ques WHERE testcode='$testcode' AND quesno=$qs ";
                        $result2 = $conn->query($sql2);
                        $row2 = $result2->fetch_assoc();
                        $ans2 = $row2['answer'];

                        if ($ans1 == $ans2) {

                            $correctQues = $correctQues + 1;
                        }
                    }
                }
                ?>
                <span id="spanhead">Your Result</span></br>
                <span class="spanq">Attempt Ques: </span><span><?php echo $attemptQues; ?></span></br>
                <span class="spanq">Correct Question: </span><span><?php echo $correctQues; ?></span></br>
                <span class="spanq">Obtain Marks: </span><span><?php $obtainmarks = $correctQues * $eachmarks;
                                                                echo $obtainmarks; ?></span></br>
                <span class="spanq">Result: </span><span><?php if ($obtainmarks >= $passingmarks) {
                                                                echo "PASS";
                                                            } else {
                                                                echo "FAIL";
                                                            } ?></span></br>
    </div>


</div>

<?php include("footer.php"); ?>