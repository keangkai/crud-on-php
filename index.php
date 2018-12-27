<!DOCTYPE html>
<?php include 'db.php';

$page = (isset($_GET['page']) ? $_GET['page'] : 1);
$perPage = (isset($_GET['per-page']) && ($_GET['per-page']) <= 50 ? $_GET['per-page'] : 5);
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

$sql = "select * from tasks limit " . $start . " , " . $perPage . " ";
$total = $db->query("select * from tasks")->num_rows;
$pages = ceil($total / $perPage);

$rows = $db->query($sql);

?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<title>Crud App</title>
</head>
<body>
<!--header-->
<div class="container">
<center><h1>Todo list</h1></center>


<!--end header-->

<!-- nav -->
<!-- <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Promotion</a></li>
    <li><a data-toggle="tab" href="#menu2">Contact</a></li>
</ul> -->
<!--end nav -->
<!-- slide -->

<!-- end slide -->
<div class="row" style="margin-top: 70px;">
	<div class="col-md-10 col-md-offset-1" >
		<table class="table">
			<button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-success ">Add </button>
			<!-- <a href="read.php">Read </a> -->

			<!-- <button type="button" class="btn btn-default pull-right" onclick="print()">Print</button> -->
			<hr><br>
			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add</h4>

						</div>
						<div class="modal-body">
							<form method="post" action="add.php" enctype="multipart/form-data">
								<div class="form-group">
									<label>Title</label>
									<input type="text" required name="task" class="form-control">
									<label>Image</label>
									<input type="file" name="image">
									<label for="comment">Description:</label>
									<textarea class="form-control" rows="5" name="description" id="comment" required></textarea>
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
								<input type="submit" name="send" value="Add" class="btn btn-success">
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		<div class="col-md-12 text-center">
			<p>Search</p>
			<form action="search.php" method="post" class="form-group">

				<input type="text" placeholder="Search" name="search" class="form-control">
			</form>
		</div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID.</th>
						<th>Title</th>
						<th>Description</th>
						<th>Category</th>
						<th>Image</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php while ($row = $rows->fetch_assoc()): ?>
						<td><?php echo $row['id'] ?></td>
						<td><?php echo $row['name']; ?></td>
						<td class="col-md-2"><?php echo $row['Description'] ?> </td>
						<td><?php echo $row['Category']; ?></td>
						<td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="200px"/>'; ?></td>
						<td><a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a> </td>
						<td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a> </td>
					</tr>
						<?php endwhile;?>

				</tbody>
			</table>
			<center>
				<ul class="pagination">
				<?php for ($i = 1; $i <= $pages; $i++): ?>
				<li><a href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage; ?>"><?php echo $i; ?></a></li>

			<?php endfor;?>
				</ul>
			</center>

		<center>

		</div>
	</div>
</div>
</body>
</html>