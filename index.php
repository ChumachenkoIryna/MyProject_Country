<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Countries</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }
        .container {
            background-color: #00bfff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        h1 {
            margin-top: 0;
        }
        form {
            margin-bottom: 20px;
        }
        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Countries</h1>
    <form method="POST" action="">
        <input type="text" name="country" required>
        <button type="submit">Добавить</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $country = trim($_POST["country"]);
        $message = "";

        if (!empty($country)) {
            $dictionary = file('dictionary.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if (in_array($country, $dictionary)) {
                $countries = file('countries.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                if (!in_array($country, $countries)) {
                    file_put_contents('countries.txt', $country . PHP_EOL, FILE_APPEND);
                    $message = "Страна добавлена.";
                } else {
                    $message = "Страна уже существует в списке.";
                }
            } else {
                $message = "Такой страны не существует.";
            }
        } else {
            $message = "Введите название страны.";
        }
        echo "<p>$message</p>";
    }
    ?>
    <select>
        <?php
        if (file_exists('countries.txt')) {
            $countries = file('countries.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($countries as $country) {
                echo "<option>$country</option>";
            }
        }
        ?>
    </select>
</div>
</body>
</html>
