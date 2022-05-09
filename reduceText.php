<?php

if(isset($_FILES['photo']) && $_FILES['photo']['error'] ==0){ 

	if ($_FILES['photo']['size']<= 3000000){ 

		$informationsImage = pathinfo($_FILES['photo']['name']);
		$extensionImage = $informationsImage['extension'];
		$extensionsArray = array('png', 'gif', 'jpg', 'jpeg', 'webp'); 

		if(in_array($extensionImage, $extensionsArray)){  

			move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/images/'.time().basename($_FILES['photo']['name'])); 

        echo 'Envoi bien réussi !' ;

        }
	}
}

echo'<form method="post" action="index.php" enctype="multipart/form-data">
	<p>
		<h1>Formulaire</h1>
		<input type="file" name="photo" /><br />
		<button type="submit">Envoyer</button>
	</p>
	</form>';
    ?>