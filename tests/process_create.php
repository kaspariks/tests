<?php

$servername = 'fdb34.awardspace.net';
$username = '3931222_jhonny';
$password = '120704-22486Aa';
$database = '3931222_jhonny';


$your_db_connection = mysqli_connect($servername, $username, $password, $database);


if (!$your_db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questionText = mysqli_real_escape_string($your_db_connection, $_POST['questionText']);
    $answer1 = mysqli_real_escape_string($your_db_connection, $_POST['answer1']);
    $answer2 = mysqli_real_escape_string($your_db_connection, $_POST['answer2']);
    $correctAnswer = $_POST['correctAnswer'];


    $insertQuestionQuery = "INSERT INTO questions (text) VALUES (?)";
    $stmt = mysqli_prepare($your_db_connection, $insertQuestionQuery);
    mysqli_stmt_bind_param($stmt, "s", $questionText);

    if (mysqli_stmt_execute($stmt)) {
        $questionId = mysqli_insert_id($your_db_connection);

        $insertAnswer1Query = "INSERT INTO answers (text, question_id, is_correct) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($your_db_connection, $insertAnswer1Query);
        $correctAnswer1 = ($correctAnswer == 1 ? 1 : 0);
        mysqli_stmt_bind_param($stmt, "sii", $answer1, $questionId, $correctAnswer1);
        mysqli_stmt_execute($stmt);

        $insertAnswer2Query = "INSERT INTO answers (text, question_id, is_correct) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($your_db_connection, $insertAnswer2Query);
        $correctAnswer2 = ($correctAnswer == 2 ? 1 : 0);
        mysqli_stmt_bind_param($stmt, "sii", $answer2, $questionId, $correctAnswer2);
        mysqli_stmt_execute($stmt);

        echo "Question and answers saved successfully!";
    } else {
        echo "Error saving question: " . mysqli_error($your_db_connection);
    }
}

mysqli_close($your_db_connection);
?>
