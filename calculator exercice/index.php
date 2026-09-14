<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALCULATEUR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 2rem;
            background: #f4f4f4;
            color: #333;
        }
    </style>
</head>

<body>
    <header>
        <h1>CALCULATEUR</h1>
    </header>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="number" name="num1" placeholder="Premier nombre" required>
        <select name="operation" required>
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">÷</option>
        </select>
        <input type="number" name="num2" placeholder="Deuxième nombre" required>
        <button type="submit">Calculer</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération et vérification des entrées , empecher l'injection de code malveillant
        $num1 = filter_input(INPUT_POST, 'num1', FILTER_SANITIZE_NUMBER_FLOAT);
        $operation = htmlspecialchars($_POST["operation"]);
        $num2 = filter_input(INPUT_POST, 'num2', FILTER_SANITIZE_NUMBER_FLOAT);

        //Gestion des erreurs de saisie
        $errors = false;
        if (empty($num1) || empty($num2) || empty($operation)) {
            echo "<p>Erreur : Veuillez remplir tous les champs !</p>";
            $errors = true;
        }

        if (!is_numeric($num1) || !is_numeric($num2)) {
            echo "<p>Erreur : Veuillez entrer des nombres valides !</p>";
            $errors = true;
        }

        switch ($operation) {
            case "add":
                $result = $num1 + $num2;
                break;
            case "subtract":
                $result = $num1 - $num2;
                break;
            case "multiply":
                $result = $num1 * $num2;
                break;
            case "divide":
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    echo "<p>Erreur : Division par zéro !</p>";
                    $errors = True;
                    $result = null;
                }
                break;
            default:
                echo "<p>Opération non valide !</p>";
                $errors = True;
                $result = null;
        }

        if ($result !== null && !$errors) {
            echo "<p>Le résultat est : " . $result . "</p>";
        }
    }
    ?>
</body>

</html>