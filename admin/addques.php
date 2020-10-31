<?php
include("../config.php");
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}
$user = $_SESSION['user'];
?>

<?php

if (isset($_POST['submit'])) {

    if ($_POST['submit'] == "Add_Questions") {

        $testcode = $_POST['testcode'];
        $testname = $_POST['testname'];
        $quesno = $_POST['quesno'];
        $marks = $_POST['marks'];
        $passingmarks = $_POST['passingmarks'];
        $navigate = $_POST['navigate'];

        $sql = "INSERT INTO `test`(`code`, `name`, `ques_no`, `marks`, `passingmarks`, `navigation`) VALUES ('$testcode','$testname',$quesno, $marks, $passingmarks,'$navigate') ";
        // $result = $conn->query($sql);
        if ($conn->query($sql) === true) {
        } else {
            echo $conn->error;
        }
    }

    if ($_POST['submit'] == "submit") {

        $checkbox = isset($_POST['ques']) ? $_POST['ques'] : '';
        $test_code = isset($_POST['test_code']) ? $_POST['test_code'] : '';
        foreach ($checkbox as $chk1 => $key) {
            $quesno = $key[0];
            $question = $key[1];
            $optionA = $key[2];
            $optionB = $key[3];
            $optionC = $key[4];
            $optionD = $key[5];
            $answer = $key[6];


            echo "break";

            $sql = " INSERT INTO `ques`(`testcode`, `quesno`, `question`, `optionA`, `optionB`, `optionC`, `optionD`, `answer`) VALUES ('$test_code', $quesno,'$question','$optionA','$optionB','$optionC','$optionD','$answer') ";
            // $result = $conn->query($sql);
            if ($conn->query($sql) === true) {
                header('Location: admin.php');
            } else {
                echo $conn->error;
            }
        }
    }
}
?>
<?php include("header.php"); ?>

<div id="main">

    <div id="testdetail">
        <span>Test Name : <?php echo $testname; ?></span>
    </div>
    <div id="addques">
        <h3>Add Questions</h3>
        <form action="addques.php" method="POST">
            <?php for ($i = 1; $i <=  $quesno; $i++) { ?>

                <p>
                    <input type="hidden" name="test_code" value="<?php echo $testcode; ?>">
                    <input type="hidden" name="ques[<?php echo $i; ?>][]" value="<?php echo $i; ?>">
                    <label for="question">Question <?php echo $i; ?> <input type="text" id="ques" name="ques[<?php echo $i; ?>][]" required></label>
                </p>
                <p>
                    <label for="optionA">Option A: <input type="text" name="ques[<?php echo $i; ?>][]"></label>
                    <label for="optionB">Option B: <input type="text" name="ques[<?php echo $i; ?>][]"></label>
                </p>
                <p>
                    <label for="optionC">Option C: <input type="text" name="ques[<?php echo $i; ?>][]"></label>
                    <label for="optionD">Option D: <input type="text" name="ques[<?php echo $i; ?>][]"></label>
                </p>
                <p>
                    <label for="answer">Answer:

                        <select name="ques[<?php echo $i; ?>][]" id="answer">
                            <option value="">Choose Answer</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>

                    </label>
                </p>

            <?php } ?>

            <p>
                <input type="submit" id="submit" name="submit" value="submit">
            </p>
        </form>

    </div>

</div>

<?php include("footer.php"); ?>