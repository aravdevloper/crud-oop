
<?php include 'header.php';
if (isset($_POST['submit'])) {
include 'database.php';
$obj = new database();

$name = $_POST['sname'];
$address = $_POST['saddress'];
$class = $_POST['sclass'];
$phone = $_POST['sphone'];

$value = ["name"=>$name,"address"=>$address,"class"=>$class,"phone"=>$phone];

if($obj->insert('students',$value)){
      header("Location: index.php");
    //echo"data insert into database";
 
}else{
    echo "<h3>Data can't insert</h3>";
}
}













 ?>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="<?php $_SERVER['PHP_SELF'];   ?>" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="sname" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="saddress" />
        </div>
        <div class="form-group">
            <label>Class</label>
            <select name="sclass">
                <option value="" selected disabled>Select Class</option>
                <?php
             include 'database.php';   
            $obj = new database();
            $obj->sql("SELECT * FROM class");
            $data = $obj->getresult();
            

            foreach($data as list("cid"=>$cid,"cname"=>$cname)){
            
            
              echo "<option value='$cid'>$cname</option>";
            }

            ?>
            </select>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sphone" />
        </div>
        <input class="submit" type="submit" value="Save" name="submit"  />
    </form>
</div>
</div>
</body>
</html>
