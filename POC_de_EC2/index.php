
<?php
// Déclaration du tableau $types
$types = [
    ["id" => 1, "name" => "Science-fiction"],
    ["id" => 2, "name" => "Policier"],
    ["id" => 3, "name" => "Aventure"],
    ["id" => 4, "name" => "Fantastique"],
    ["id" => 5, "name" => "Géo-politique"],
];

// Déclaration du tableau $blake_mortimer
$blake_mortimer = [
    "T1"  => ["Album" => "Le secret de l'espadon T1", "Année" => 1984, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 3],
    "T2"  => ["Album" => "Le secret de l'espadon T2", "Année" => 1985, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 3],
    "T3"  => ["Album" => "Le secret de l'espadon T3", "Année" => 1986, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 3],
    "T4"  => ["Album" => "Le mystère de la grande pyramide", "Année" => 1954, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 1],
    "T5"  => ["Album" => "Le mystère de la grande pyramide", "Année" => 1955, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 1],
    "T6"  => ["Album" => "La marque jaune", "Année" => 1956, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 2],
    "T7"  => ["Album" => "L'enigme de l'Atlantide", "Année" => 1957, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 4],
    "T8"  => ["Album" => "SOS météores", "Année" => 1959, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 3],
    "T9"  => ["Album" => "Le piège diabolique", "Année" => 1962, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 2],
    "T10" => ["Album" => "L'affaire du collier", "Année" => 1967, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 2],
    "T11" => ["Album" => "Les 3 formules du professeur Sato", "Année" => 1977, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Edgar P. Jacobs", "type_id" => 2],
    "T12" => ["Album" => "Les 3 formules du professeur Sato", "Année" => 1990, "Scénariste" => "Edgar P. Jacobs", "Dessinateur" => "Bob de Moor", "type_id" => 2],
    "T13" => ["Album" => "L'affaire Francis Blake", "Année" => 1996, "Scénariste" => "Jean Van Hamme", "Dessinateur" => "Ted Benoit", "type_id" => 2],
    "T14" => ["Album" => "La machination Voronov", "Année" => 2001, "Scénariste" => "Yves Sente", "Dessinateur" => "André Juillard", "type_id" => 2],
    "T15" => ["Album" => "L'étrange rendez-vous", "Année" => 2001, "Scénariste" => "Jean Van Hamme", "Dessinateur" => "Ted Benoit", "type_id" => 3],
    "T16" => ["Album" => "Les sarcophages du 6 ieme continent", "Année" => 2003, "Scénariste" => "Yves Sente", "Dessinateur" => "André Juillard", "type_id" => 4],
    "T17" => ["Album" => "Les sarcophages du 6 ieme continent", "Année" => 2004, "Scénariste" => "Yves Sente", "Dessinateur" => "André Juillard", "type_id" => 4],
    "T18" => ["Album" => "Le sanctuaire du Gondwana", "Année" => 2008, "Scénariste" => "Yves Sente", "Dessinateur" => "André Juillard", "type_id" => 3],
    "T19" => ["Album" => "La malédiction des trente deniers", "Année" => 2009, "Scénariste" => "Jean Van Hamme", "Dessinateur" => "René et Chantal Sterne", "type_id" => 4],
    "T20" => ["Album" => "La malédiction des trente deniers", "Année" => 2010, "Scénariste" => "Jean Van Hamme", "Dessinateur" => "Antoine Aubin", "type_id" => 4],
    "T21" => ["Album" => "Le serment des cinq Lords", "Année" => 2012, "Scénariste" => "Yves Sente", "Dessinateur" => "André Juillard", "type_id" => 2],
    "T22" => ["Album" => "L'Onde Septimus", "Année" => 2013, "Scénariste" => "Jean Dufaux",

 "Dessinateur" => "Antoine Aubin et Etienne Schréder", "type_id" => null],
    "T23" => ["Album" => "Le bâton de Plutarque", "Année" => 2014, "Scénariste" => "Yves Sente", "Dessinateur" => "André Juillard", "type_id" => 4],
    "T24" => ["Album" => "Le Testament de William S", "Année" => 2016, "Scénariste" => "Yves Sente", "Dessinateur" => "André Juillard", "type_id" => 2],
];

// Fonction pour vérifier si les détails correspondent à la recherche
function searchMatches($search, $details) {
    $search = strtolower($search);
    return strpos(strtolower($details['Album']), $search) !== false ||
           strpos(strtolower($details['Scénariste']), $search) !== false ||
           strpos(strtolower($details['Dessinateur']), $search) !== false ||
           strpos(strtolower($details['Année']), $search) !== false;
}

// Fonction pour obtenir le nom du type à partir de son ID
function getTypeName($type_id) {
    global $types;
    foreach ($types as $type) {
        if ($type['id'] == $type_id) {
            return $type['name'];
        }
    }
    return "Inconnu";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Blake et Mortimer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> 
<h1 class="mb-4">Blake and Mortimer Collection</h1>
    <div class="container mt-5">
        <form method="post" class="mb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher par nom, scénariste, dessinateur ou année">
                </div>
                <div class="col-md-4 mb-3">
                    <select name="type" class="form-select">
                        <option value="">Tous les types</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>
        
        <div class="row">
            <?php
            // Assurez-vous que le tableau $blake_mortimer est défini
            if (isset($blake_mortimer)) {
                foreach ($blake_mortimer as $tome => $details) {
                    // Vérifiez si un type est sélectionné
                    if (isset($_POST['type']) && $_POST['type'] != '') {
                        // Vérifiez si le type de l'album correspond au type sélectionné
                        if ($details['type_id'] != $_POST['type']) {
                            // Si les types ne correspondent pas, passez à l'itération suivante
                            continue;
                        }
                    }
                    
                    // Vérifiez si une recherche est effectuée
                    $matchesSearch = true;
                    
                    // Vérifiez si une recherche est effectuée et que le critère de recherche ne correspond pas
                    if (isset($_POST['search']) && !searchMatches($_POST['search'], $details)) {
                        $matchesSearch = false;
                    }
                    
                    // Si les détails correspondent aux critères de recherche, affichez-les
                    if ($matchesSearch) {
            ?>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $details['Album']; ?></h5>
                                    <p class="card-text">Année: <?php echo $details['Année']; ?></p>
                                    <p class="card-text">Scénariste: <?php echo $details['Scénariste']; ?></p>
                                    <p class="card-text">Dessinateur: <?php echo $details['Dessinateur']; ?></p>
                                    <p class="card-text">Type: <?php echo getTypeName($details['type_id']); ?></p>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
