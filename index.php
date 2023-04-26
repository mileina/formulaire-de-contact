<?php
require_once 'contact.class.php';

$contact = new Contact();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if ($contact->verifier_doublon($nom, $prenom, $email, $message) == 0) {
        $contact->insertContact($nom, $prenom, $email, $message);
        $contact->sendEmail($email, $message);
        echo "Votre message a été envoyé avec succès!";
    } else {
        echo "Un message similaire a déjà été envoyé. Veuillez réessayer avec un message différent.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea><br>

        <input type="submit" value="Envoyer">
    </form>
</body>
</html>
