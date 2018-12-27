<?php
include 'db.php';

$category_arr = array("Hot Deals", "Hotels", "Dining&amp;drinking", "Activities", "Around The Island", "Island Guide");

if (isset($_POST['send'])) {
	$name = htmlspecialchars($_POST['task']);
	$description = htmlspecialchars($_POST['description']);
	$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$category = htmlspecialchars($_POST['category']);

	if (empty($name) || empty($description)) {
		echo "<script>alert('Title and Description can\'t be empty'); location=location</script>";
	}
	else {
		if (!in_array($category, $category_arr)) {
			echo "<script>alert('Invalid category'); location=location</script>";
		}
		else {
			$sql = "INSERT INTO tasks (image,name,Description,Category) VALUES ('$image','$name','$description','$category')";

			$statement = $db->query($sql);

			if ($statement) {
				header('location: index.php');
			} else {
				echo "error";
			}
		}
		
	}
}

?>