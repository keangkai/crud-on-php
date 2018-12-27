<!DOCTYPE html>

<?php include 'db.php';

$id = (int) $_GET['id'];

$sql = "SELECT * FROM tasks WHERE id='$id'";

$rows = $db->query($sql);

$row = $rows->fetch_assoc();
$category_arr = array("Hot Deals", "Hotels", "Dining&amp;drinking", "Activities", "Around The Island", "Island Guide");

if (isset($_POST['send'])) {
	$imageName = $_FILES['image']['name'];
	$name = htmlspecialchars($_POST['task']);
	$description = htmlspecialchars($_POST['description']);
	$category = htmlspecialchars($_POST['category']);

	if (!empty($imageName)) {
		$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	}
	if (empty($name) || empty($description)) {
		echo "<script>alert('Title and Description can\'t be empty'); location=location</script>";
	}
	else {
		if (!in_array($category, $category_arr)) {
			echo "<script>alert('Invalid category'); location=location</script>";
		}
		else {
			if (empty($imageName)) {
				$sql2 = "UPDATE tasks SET name='$name',Description='$description',Category='$category' WHERE id='$id'";
			} else {
				$sql2 = "UPDATE tasks SET name='$name',image='$image',Description='$description',Category='$category' WHERE id='$id'";
			}

			$db->query($sql2);

			header('location: index.php');
			exit();
		}
	}
}

?>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Crud App</title>
	</head>
	<body>
		<div class="container">
			<center><h1>Update Todo list</h1></center>

		    	<div class="row" style="margin-top: 70px;">
			    	<div class="col-md-10 col-md-offset-1" >
				    	<table class="table">

					     	<hr><br>
								<form method="post" enctype="multipart/form-data" >
									<div class="form-group">
										<label>Title</label>
										<input type="text" required name="task" value="<?php echo $row['name']; ?>" class="form-control">
                                        <br>
                                        <label>image</label>
                                        <input type="file" name="image">
										<label for="comment">Description:</label>
										<textarea class="form-control" rows="5" name="description" id="comment" ><?php echo $row["Description"]; ?></textarea>
									</div>
									<div class="form-group">
										<label>select Category</label>
										<select class="form-control" name="category">
											<option>Hot Deals</option>
											<option>Hotels</option>
											<option>Dining&drinking</option>
											<option>Activities</option>
											<option>Around The Island</option>
											<option>Island Guide</option>
										</select>
									</div>
									 <input type="submit" name="send" value="Add" class="btn btn-success">&nbsp;
								 <a href="index.php" class="btn btn-warning">Back</a>
							</form>
				    	</div>
			 	  </div>
			 </div>
		 </body>
	</html>