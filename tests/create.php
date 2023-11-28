<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Question</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Create Question</h1>
    <form action="process_create.php" method="post">
        <label for="questionText">Question Text:</label>
        <input type="text" id="questionText" name="questionText" required>

        <label for="answer1">Answer 1:</label>
        <input type="text" id="answer1" name="answer1" required>

        <label for="answer2">Answer 2:</label>
        <input type="text" id="answer2" name="answer2" required>

        <label for="correctAnswer">Correct Answer (1 or 2):</label>
        <input type="number" id="correctAnswer" name="correctAnswer" min="1" max="2" required>

        <button type="submit">Submit</button>
    </form>

    <br>

    <a href="index.php">
        <button>Go to Index</button>
    </a>
</body>
</html>
