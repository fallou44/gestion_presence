
    <div class="title">
        <div class="left">Presence</div>
        <div class="right">Presence - Liste</div>
    </div>  

            <form id="container-presence" action="" method="post">
                <div class="presence">
    
                <?php
                        $selectedStatus = isset($_POST['status']) ? $_POST['status'] : '';
                        $selectedRef = isset($_POST['referenciel']) ? $_POST['referenciel'] : '';
                ?>

                    <div class="boite status flex-cc">
                        <select name="status" id="select-status">
                            <option value="">Status</option>
                            <option value="present" <?= $selectedStatus == 'present' ? 'selected' : '' ?>><span>present</span></option>
                            <option value="absent" <?= $selectedStatus == 'absent' ? 'selected' : '' ?>>absent</option>
                        </select>
                    </div>
                    <div class="boite reference flex-cc">
                        <select  name="referenciel" id="select-ref">
                            <option value="">Reférenciel</option>
                            <option value="Dev Web" <?= $selectedRef == 'Dev Web' ? 'selected' : '' ?>>Developpement Web</option>
                            <option value="Dev-data" <?= $selectedRef == 'Dev-data' ? 'selected' : '' ?>>	Developpement Data</option>
                            <option value="REF-DIG"  <?= $selectedRef == 'REF-DIG' ? 'selected' : '' ?>>Referent Digital</option>
                            <option value="AWS" <?= $selectedRef == 'AWS' ? 'selected' : '' ?>>AWS</option>
                            <option value="Hackeuse" <?= $selectedRef == 'Hackeuse' ? 'selected' : '' ?>>Hackeuse</option>
                        </select>
                    </div>
                    <!--  -->
                    <div class="boite clandrier flex-cc">
                    <input style="padding: 10px;" type="date" name="date" id="date" value="<?= date('Y-m-d');?>">
                    </div>
                    <div class="boite boutton flex-cc" style="background: #029386;">
                        <button type="submit">rafraichir</button>
                    </div>
                    <div class="boite boutton flex-cc" style="background: #029386; ">
                    <a style=" color:#FFFFFF " href="http://serigne.fallou.seck:8284/presence" class="reset-link">Reset</a>
                        </div>
                </div>
                <style>
                    .present {
                        background-color: aquamarine;
                        /* opacity: 0.4; */
                        width: 20px;
                        border: 10px solid  white;
                        font-size: 20px;
                        font-weight: bold;
                        color: black;
                    }
                    .absent {
                        background-color: salmon;
                        /* opacity: 0.4; */
                        width: 20px;
                        border: 10px solid  white;
                        font-size: 20px;
                        font-weight: bold;
                        color: white;

                    }
                </style>
                        <table class="table">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Téléphone</th>
                            <th>Référentiel</th>
                            <th>Date d'arrivee</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
// Vérifier le rôle de l'utilisateur
if ($role === 'Apprenant') {
    // Récupérer l'identifiant de l'apprenant connecté
    $apprenant_id = $_SESSION['user'][3]; // Vous devez remplacer cet index par celui qui correspond à l'identifiant de l'apprenant dans votre tableau de session

    // Afficher uniquement la liste de présence de l'apprenant connecté
    foreach ($presence as $student) {
        if ($student['id'] == $apprenant_id) {
            // Afficher les données de présence de l'apprenant connecté
            echo '<tr>';
            echo '<td>' . $student["matricule"] . '</td>';
            echo '<td>' . $student["nom"] . '</td>';
            echo '<td>' . $student["prenom"] . '</td>';
            echo '<td>' . $student["telephone"] . '</td>';
            echo '<td>' . $student["referenciel"] . '</td>';
            echo '<td>' . $student["duree"] . '</td>';
            echo '<td>' . date("d/m/Y") . '</td>';
            echo '<td class="' . ($student["status"] == 'present' ? 'present' : 'absent') . '">' . $student["status"] . '</td>';
            echo '</tr>';
        }
    }
} elseif ($role === 'Administrateur') {
    // Afficher la liste de présence complète pour l'administrateur
    foreach ($presence as $student) {
        // Afficher toutes les données de présence
        echo '<tr>';
        echo '<td>' . $student["matricule"] . '</td>';
        echo '<td>' . $student["nom"] . '</td>';
        echo '<td>' . $student["prenom"] . '</td>';
        echo '<td>' . $student["telephone"] . '</td>';
        echo '<td>' . $student["referenciel"] . '</td>';
        echo '<td>' . $student["duree"] . '</td>';
        echo '<td>' . date("d/m/Y") . '</td>';
        echo '<td class="' . ($student["status"] == 'present' ? 'present' : 'absent') . '">' . $student["status"] . '</td>';
        echo '</tr>';
    }
}
?>

                </table>

                <div class="pagination" style="padding: 29px; font-size: 20px">

                        <a href="#" class="page-link prev"><i class="fas fa-angle-left"></i></a>
                                    <?php 
                                        for($i = 1; $i <= $totalPage; $i++){

                                            if($i == $pageEtu){
                                                echo "<a href='?pageAff=$i' class='page-link active'>$i</a>";
                                            }else{
                                                echo "<a href='?pageAff=$i' class='page-link'>$i</a>";
                                            }
                                        }
                                    ?>
                            <a href="#" class="page-link next"><i class="fas fa-angle-right"></i></a>
                            <!-- Ajoutez plus de liens pour plus de pages -->
                        </div>
            </form>
