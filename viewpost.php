<?php require('includes/config.php'); 

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">

	<div class="topline">
		<div class="topline-block" id="topline-block-1"></div>
		<div class="topline-block" id="topline-block-2"></div>
		<div class="topline-block" id="topline-block-3"></div>
		<div class="topline-block" id="topline-block-4"></div>
		<div class="topline-block" id="topline-block-5"></div>
	</div>
</head>
<body>

	<div id="wrapper">

		<h1>Блог великого теоретика</h1>
		<hr />
		<p><a href="./">Home Page</a></p>


		<?php	
			echo '<div>';
				echo '<h1>'.$row['postTitle'].'</h1>';
				echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
				echo '<p>'.$row['postCont'].'</p>';				
			echo '</div>';
		?>

	</div>

</body>
</html>