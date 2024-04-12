
<div class="promotions">
				<h2>Référentiels</h2>
				<span>Référentiels * Création</span>
			</div>
			
		
			<div class="main">

				
			<?php 


					$refDig = findAllReferentiels();
					if (isset($_POST["search"])){
						$refDig= recherche($_POST["search"]);
					}


			$referentiel = findAllReferentiels();
			
					foreach($refDig as $referent) :  ?>

					<div class="img">
					<span class="points">
						<ul>
							<li></li>
							<li></li>
							<li></li>
						</ul>
					</span>
					<img src="<?= $referent['image'] ?>" alt="">
					<div class="ref">
						<span><?= $referent['nom'] ?></span> <br>
						<span class="active"><?= $referent['statut'] ?></span>
						<a href="referentiel/<?= $referent['nom'] ?>"><?= $referent['action'] ?></a>
					</div>
				</div>
		
				<?php endforeach; ?>
				<!-- <div class="img">
					<span class="points">
						<ul>
							<li></li>
							<li></li>
							<li></li>
						</ul>
					</span>
					<img src="public/images/images.png" alt="">
					<div class="ref">
						<span>Référence Digital</span> <br>
						<span class="active">Active</span>
					</div>
				</div>
		
				<div class="img">
					<span class="points">
						<ul>
							<li></li>
							<li></li>
							<li></li>
						</ul>
					</span>
					<img src="../img/room.png" alt="">
					<div class="ref">
						<span style="margin-left: 2.5em;">AWS</span> <br>
						<span class="active">Active</span>
					</div>
		
				</div> -->
				
				<!-- <div class="img">
					<span class="points">
						<ul>
							<li></li>
							<li></li>
							<li></li>
						</ul>
					</span>
					<img src="../img/room.png" alt="" >
		
					<div class="ref">
						<span style="margin-left: 2.5em;">Hackeuse</span> <br>
						<span class="active">Active</span>
					</div>
				</div> -->
		
				<div class="formRef">
					<h4>Noueau Référentiel</h4>
					<span>Libelle</span> <br>
		
					<i class="fa-regular fa-user"></i>
					<input type="text" placeholder=" entrer le Libelle" class="libelle"> <br>
					<i class="fa-regular fa-user"></i>
					<textarea name="text" id="desc" cols="30" rows="10" placeholder="entrer la  descrition"></textarea>
					<button class="btn">Enregistrer</button>
				</div>
		
				<!-- <div class="img last">
					<span class="points">
						<ul>
							<li></li>
							<li></li>
							<li></li>
						</ul>
					</span>
					<img src="../img/room.png" alt="">
					<div class="ref">
						<span>Développement Data</span> <br>
						<span class="active">Active</span>
					</div>
					
				</div> -->
					
			</div>