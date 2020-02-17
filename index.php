<?php
function connectDB(){
    require_once  'param.php';
   
    $dsn = 'mysql:dbname='. DB. ';host='. HOST. ';';
    try{
        $db = new PDO($dsn, USER, PASS);
        return $db;
    } catch (Exception $ex) {
        var_dump($ex);
        die('La connexion à la bdd a échoué !!');
    }
}
$db = connectDB();
$db->exec("SET CHARACTER SET utf8");
$query = 'SELECT * FROM `clients`';
$usersQueryState = $db->query($query);
$usersList = $usersQueryState->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <h1>Exercice 1 :</h1>
    <h2>Afficher tous les clients :</h2>
<?php
foreach ($usersList as $user): ?>
    <p><?= $user['id']. ' '. $user['lastName']. ' '. $user['firstName']. ' '. $user['birthDate']. ' '. $user['card']. ' '. $user['cardNumber'] ?></p>
    <?php
    endforeach;
    $usersQueryState->closeCursor();
    ?>
</div>
<div>
    <h1>Exercice 2 :</h1>
    <h2>Afficher tous les types de spectacles possibles :</h2>
</div>
<?php
$query2 = 'SELECT `type` FROM `showTypes`';
$usersQueryState2 = $db->query($query2);
$allGenre = $usersQueryState2->fetchAll(PDO::FETCH_ASSOC);
foreach($allGenre as $value): ?>
<p><?= $value['type'] ?></p>
<?php
endforeach;
$usersQueryState2->closeCursor();
?>
<div>
    <h1>Exercice 3 :</h1>
    <h2>Afficher les 20 premiers clients :</h2>
    <?php
    $query3 = 'SELECT * FROM `clients` LIMIT 0,20';
    $usersQueryState3 = $db->query($query3);
    $usersList3 = $usersQueryState3->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usersList3 as $user3): ?>
        <p><?= $user3['id']. ' '. $user3['lastName']. ' '. $user3['firstName']. ' '. $user3['birthDate']. ' '. $user3['card']. ' '. $user3['cardNumber'] ?></p>
        <?php
     endforeach;
        $usersQueryState3->closeCursor();
    ?>
</div>
<div>
    <h1>Exercice 4 :</h1>
    <h2>N'afficher que les clients possédant une carte de fidélité :</h2>
    <?php
    $query4 = 'SELECT * FROM `clients` WHERE `card` = 1';
    $usersQueryState4 = $db->query($query4);
    $usersList4 = $usersQueryState4->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usersList4 as $user4): ?>
        <p><?= $user4['id']. ' '. $user4['lastName']. ' '. $user4['firstName']. ' '. $user4['birthDate']. ' '. $user4['card']. ' '. $user4['cardNumber'] ?></p>
        <?php
     endforeach;
        $usersQueryState4->closeCursor();
    ?>
</div>
<div>
    <h1>Exercice 5 :</h1>
    <h2>Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M". Les afficher comme ceci :</h2>
    Nom : Nom du client<br>
    Prénom : Prénom du client<br>
    Trier les noms par ordre alphabétique.
    <?php
    $query5 = 'SELECT * FROM `clients` WHERE `lastName` like "M%" ORDER BY `lastName`';
    $usersQueryState5 = $db->query($query5);
    $usersList5 = $usersQueryState5->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usersList5 as $user5): ?>
        <p>Nom = <?= $user5['lastName']. '<br>Prénom = '. $user5['firstName'] ?></p>
        <?php
     endforeach;
        $usersQueryState5->closeCursor();
    ?>
</div>
<div>
    <h1>Exercice 6 :</h1>
    <h2>Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. 
        Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : 
        Spectacle par artiste, le date à heure.
    </h2>
    <?php
    $query6 = 'SELECT `title`, `performer`, DATE_FORMAT(`date`, \'%d/%m/%Y\') `date`, `startTime` FROM `shows` ORDER BY `title` ASC';
    $usersQueryState6 = $db->query($query6);
    $usersList6 = $usersQueryState6->fetchAll(PDO::FETCH_OBJ);
    foreach ($usersList6 as $user6): ?>
        <p>Spectacle = <?= $user6->title. '<br>Artiste = '. $user6->performer. ' Date = '. $user6->date. ' horaire = '. $user6->startTime  ?></p>
        <?php
     endforeach;
        $usersQueryState6->closeCursor();
    ?>
</div>
<div>
    <h1>Exercice 7 :</h1>
    <h2>Afficher tous les clients comme ceci :
    </h2>
    <p> Nom : Nom de famille du client<br>
            Prénom : Prénom du client<br>
            Date de naissance : Date de naissance du client<br>
            Carte de fidélité : Oui (Si le client en possède une) ou Non (s'il n'en possède pas)<br>
            Numéro de carte : Numéro de la carte fidélité du client s'il en possède une.<br>
    </p>
    <?php
    $query7 = 'SELECT  * FROM `clients`';
    $usersQueryState7 = $db->query($query7);
    $usersList7 = $usersQueryState7->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usersList7 as $user7): ?>
        <p>Nom : <?= $user7['lastName'] ?> <br>Prénom : <?= $user7['firstName'] ?><br>Date de naissance : <?= $user7['birthDate'] ?><br>
        <?php
            if($user7['card'] == 1){ ?>
            Carte de fidélité : oui<br>Numéro de carte : <?= $user7['cardNumber'] ?>
         <?php       
            } 
        ?>
        </p>
        <?php
     endforeach;
        
    ?>
</div>


