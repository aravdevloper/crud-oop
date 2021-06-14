<?php 
include 'header.php';
include 'database.php';
$obj = new database();


if (isset($_POST['deletebtn'])){
	$id = $_POST['sid'];
	$obj->delete('students',$where = "id='$id'");
	echo "delete data is : ";
    print_r($obj->getresult());
    header("Location: index.php");






}








 ?>


<div id="main-content">
    <h2>Delete Record</h2>
    <form class="post-form" action="<?php $_SERVER['PHP_SELF'];  ?>" method="post">
        <div class="form-group">
            <label>Id</label>
            <input type="text" name="sid" />
        </div>
        <input class="submit" type="submit" name="deletebtn" value="Delete" />
    </form>
</div>
</div>
</body>
</html>
