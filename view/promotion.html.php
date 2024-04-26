<div class="promotions">
    <h2>promotions</h2>
    <span>Promos * Liste</span>
</div>

<div class="containe">

    <div class="dev">
        <div class="promo">
            <span>Liste Des Promotions 
                <!-- <span class="un">(1) -->
        </div>

        <form action="" class="input">
            <input type="text" placeholder="Recherche ici ..." class="text" name="search">
            <!-- <img src="public/images/equipement.png" alt="" class="equipement"  width="5%" height="100%"> -->
            <button> <a href="/promo_ajout"><i class="fa-solid fa-plus"></i>nouvel</button></a>

        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Libelle</th>
                <th>DateDebut</th>
                <th>DateFin</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php
        //  var_dump($_GET["promo"]);
            $promos = findPromotion();
            if (isset($_POST["search"])) {
                $promos = recherche($_POST["search"]);
            }

            $Promotion = findPromotion();
            foreach ($promos as $promo) :  ?>
                <tr>
                    <td><?= $promo['libelle'] ?> </td>
                    <td><?= date("d/m/Y", strtotime($promo["dateDebut"])); ?></td>
                    <td><?= date("d/m/Y", strtotime($promo["dateFin"])); ?></td>
                    <td>
            <form id="promoForm" action="http://serigne.fallou.seck:8284/promotion" method="get">
                <input style="accent-color: #008f89;" 
                <?PHP if( $_SESSION["SESSION"] == $promo["id_promotion"] ) 
                echo "checked";
                ?>
                type="checkbox" name="promo" value="<?= $promo["id_promotion"] ?>" onchange="this.form.submit()">
            </form>
        </td>
        </tr>
            <?php endforeach;   
            // var_dump($_SESSION["SESSION"]);
            ?>
        </tbody>
    </table>
</div>