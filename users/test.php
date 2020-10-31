<?php
include("../config.php");
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}
$user = $_SESSION['user'];


// $email = $_SESSION['email'];
?>
<?php
if (isset($_GET['quesno'])) {
    $quesno = $_GET['quesno'] + 1;
} else {
    $quesno = 1;
}
$radioChecked = "";
if (sizeof($_SESSION['answer']) > 0) {

    foreach ($_SESSION['answer'] as $key => $value) {

        if ($value['quesno'] == $quesno) {

            $radioChecked = $_SESSION['answer'][$key]['answer'];
        }
    }
}


if (isset($_GET['submit'])) {


    $email = $_SESSION['email'];
    $code = $_GET['code'];
    $quesn = $_GET['quesno'];
    $answer = $_GET['answer'];

    $ans = array('email' => $email, 'code' => $code, 'quesno' => $quesn, 'answer' => $answer);
    // array_push($_SESSION['answer'], $ans);
    $val = true;
    if (sizeof($_SESSION['answer']) > 0) {

        foreach ($_SESSION['answer'] as $key => $value) {

            if ($value['quesno'] == $ans['quesno']) {

                $_SESSION['answer'][$key]['answer'] = $ans['answer'];

                $val = false;
            }
        }
        if ($val) {
            array_push($_SESSION['answer'], $ans);
        }
    } else {
        array_push($_SESSION['answer'], $ans);
    }

    if ($_GET['submit'] == 'Submit_Test') {

        foreach ($_SESSION['answer'] as $key1 => $value1) {

            $email1 = $value1['email'];
            $code1 = $value1['code'];
            $quesno1 = $value1['quesno'];
            $ans1 = $value1['answer'];

            $sql = "INSERT INTO ans (email, testcode,quesno, ans) VALUES('$email1','$code1',$quesno1,'$ans1')";
            $result1 = $conn->query($sql);
        }
        if (isset($result1)) {
            $_SESSION['code'] = $code1;
            header('Location:viewresult.php');
        }
    }
}
?>
<?php include("header.php"); ?>


<div id="main">

    <div class="testdiv" id="testdiv1">
        <?php
        $testcode = $_GET['code'];
        $sql = "SELECT * FROM test WHERE code='$testcode' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $navigation = $row['navigation'];
            $maxQues = $row['ques_no'];
        ?>
            <span id="spanhead" class="span1">Test Details </span></br>
            <span class="span1"> Test Code :<?php echo $row['code']; ?> </span></br>
            <span class="span1">Test Name :<?php echo $row['name']; ?> </span></br>
            <span class="span1">No of Questions :<?php echo $row['ques_no']; ?> </span></br>
            <span class="span1">Total Marks :<?php echo $row["ques_no"] * $row["marks"]; ?> </span></br>
            <span class="span1">Passing Marks : <?php echo $row["passingmarks"]; ?> </span></br>

        <?php } ?>
    </div>

    <div class="testdiv" id="testdiv2">

        <?php

        $sql = " SELECT * FROM ques WHERE testcode='$testcode' AND quesno=$quesno";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
            <form action="" method="GET">
                <span class="ques">Question <?php echo $row['quesno']; ?></span></br>
                <span class="ques"><?php echo $row['question']; ?></span></br>
                <input type="hidden" name="quesno" value="<?php echo $row['quesno']; ?>" />
                <input type="hidden" name="code" value="<?php echo $row['testcode']; ?>" />



                <input type="radio" id="optionA" name="answer" value="A" required <?php if ($radioChecked == "A") : ?> checked <?php endif; ?>> <label for="A"><?php echo $row['optionA']; ?></label><br>
                <input type="radio" id="optionB" name="answer" value="B" <?php if ($radioChecked == "B") : ?>checked <?php endif; ?>> <label for="B"><?php echo $row['optionB']; ?></label><br>
                <input type="radio" id="optionC" name="answer" value="C" <?php if ($radioChecked == "C") : ?>checked <?php endif; ?>> <label for="C"><?php echo $row['optionC']; ?></label><br>
                <input type="radio" id="optionD" name="answer" value="D" <?php if ($radioChecked == "D") : ?>checked <?php endif; ?>> <label for="D"><?php echo $row['optionD']; ?></label><br>

                <?php if ($navigation == "enable" && $quesno > 1) : ?> <a id="prev" href="test.php?code=<?php echo $row['testcode']; ?>&quesno=<?php echo $row['quesno'] - 2; ?>">Prev</a> <?php endif; ?>
                <?php if ($maxQues > $row['quesno']) : ?> <input type="submit" id="submit1" name="submit" value="Submit_and_Next"> <?php endif; ?>
                <?php if ($maxQues == $row['quesno']) : ?> <input type="submit" id="submit1" name="submit" value="Submit_Test"> <?php endif; ?>
                <?php if ($navigation == "enable" && $maxQues > $quesno) : ?> <a id="next" href="test.php?code=<?php echo $row['testcode']; ?>&quesno=<?php echo $row['quesno']; ?>">Next</a> <?php endif; ?>

            </form>

        <?php } ?>
    </div>

</div>

<?php include("footer.php"); ?>