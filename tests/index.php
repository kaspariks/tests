<?php
$servername = 'fdb34.awardspace.net';
$username = '3931222_jhonny';
$password = '120704-22486Aa';
$database = '3931222_jhonny';




$your_db_connection = mysqli_connect($servername, $username, $password, $database);

if (!$your_db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}




$query = "SELECT id, text FROM questions";
$result = mysqli_query($your_db_connection, $query);


if ($result) {

    $questions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $questionId = $row['id'];
        $questionText = $row['text'];

        $answersQuery = "SELECT text, is_correct FROM answers WHERE question_id = $questionId";
        $answersResult = mysqli_query($your_db_connection, $answersQuery);


        if ($answersResult) {
            $answers = [];
            while ($answerRow = mysqli_fetch_assoc($answersResult)) {
                $answers[] = [
                    'text' => $answerRow['text'],
                    'is_correct' => $answerRow['is_correct']
                ];
            }

            $questions[] = [
                'text' => $questionText,
                'answers' => $answers
            ];
        }
    }
} else {
    echo "Error fetching questions: " . mysqli_error($your_db_connection);
}

mysqli_close($your_db_connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Question List</title>
</head>
<body>
    <h1>Question List</h1>
    <?php
        // Check if there are questions to display
        if (!empty($questions)) {
            foreach ($questions as $question) {
                echo "<p>{$question['text']}</p>";
                echo "<ul>";
                foreach ($question['answers'] as $answer) {
                    $isCorrect = $answer['is_correct'] ? '(Correct)' : '';
                    echo "<li>{$answer['text']} $isCorrect</li>";
                }
                echo "</ul>";
            }
        } else {
            echo "<p>No questions found.</p>";
        }
    ?>
        <a href="create.php">
        <button>Go to create a question</button>
    </a>
</body>
</html>
