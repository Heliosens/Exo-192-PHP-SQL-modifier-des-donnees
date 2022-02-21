<?php
/**
 * 1. Le dossier SQL contient l'export de ma table user.
 * 2. Trouvez comment importer cette table dans une des bases de données que vous avez créées, si vous le souhaitez vous pouvez en créer une nouvelle pour cet exercice.
 * 3. Assurez vous que les données soient bien présentes dans la table.
 * 4. Créez votre objet de connexion à la base de données comme nous l'avons vu
 * 5. Insérez un nouvel utilisateur dans la base de données user
 * 6. Modifiez cet utilisateur directement après avoir envoyé les données ( on imagine que vous vous êtes trompé )
 */

// TODO Votre code ici.
require 'connPDO.php';

try {

    $pdo = new connPDO();
    $db = $pdo->conn();

    $nom = 'Wick';
    $prenom = 'John';
    $rue = 'la rue';
    $numero = 12;
    $cp = 59610;
    $ville = 'Fourmies';
    $pays = 'France';
    $mail = 'john-wick@gmail.com';

    $stm = $db->prepare("
        INSERT INTO user (nom, prenom, rue, numero, code_postal, ville, pays, mail)
        VALUES (:nom, :prenom, :rue, :numero, :code_postal, :ville, :pays, :mail)
    ");

    $stm->bindparam(':nom', $nom);
    $stm->bindparam(':prenom', $prenom);
    $stm->bindparam(':rue', $rue);
    $stm->bindparam(':numero', $numero);
    $stm->bindparam(':code_postal', $cp);
    $stm->bindparam(':ville', $ville);
    $stm->bindparam(':pays', $pays);
    $stm->bindparam(':mail', $mail);

    $stm->execute();
    echo "Utilisateur ajouté";

    $nom = 'Ryan';
    $prenom = 'Jack';
    $id = $db->lastInsertId();

    $stm = $db->prepare("
        UPDATE user SET nom = :nom, prenom = :prenom WHERE id=:id;
    ");

    $stm->bindparam(':nom', $nom);
    $stm->bindparam(':prenom', $prenom);
    $stm->bindparam(':id', $id);

    $stm->execute();

}
catch (PDOException $e){
    echo "Error : " . $e->getMessage();
}


/**
 * Théorie
 * --------
 * Pour obtenir l'ID du dernier élément inséré en base de données, vous pouvez utiliser la méthode: $bdd->lastInsertId()
 *
 * $result = $bdd->execute();
 * if($result) {
 *     $id = $bdd->lastInsertId();
 * }
 */