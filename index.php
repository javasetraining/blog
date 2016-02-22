<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My First Made Blog</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">

</head>
<body>
<div class="topline">
	<div class="topline-block" id="topline-block-1"></div>
	<div class="topline-block" id="topline-block-3"></div>
	<div class="topline-block" id="topline-block-5"></div>
	<div class="topline-block" id="topline-block-2"></div>
	<div class="topline-block" id="topline-block-4"></div>
</div>
	<div id="wrapper">

		<h1>Блог Великого теоретика с Баннером</h1>

		<hr />

		<?php
			try {

				$stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
				while($row = $stmt->fetch()){

					echo '<div>';
						echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
						echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
						echo '<p>'.$row['postDesc'].'</p>';				
						echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';				
					echo '</div>';

				}

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		?>

	</div>


</body>
</html>