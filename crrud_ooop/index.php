<?php
include 'header.php';
include "database.php";
$obj = new database();

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $obj->delete('students',$where = "id='$id'");
  echo "delete data is : ";
  print_r($obj->getresult());
   header("Location: index.php");
}

?>
<div id="main-content">
    <h2>All Records</h2>
    <table cellpadding="7px">
        <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Class</th>
        <th>Phone</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            
            $obj->sql("SELECT id,name,address,cname,phone FROM students JOIN class WHERE students.class = class.cid");
            $data = $obj->getresult();
            foreach($data as list("id"=>$id,"name"=>$name,"address"=>$address,"cname"=>$class,"phone"=>$phone)){
            ?>
            <tr>
                <td><?php echo  $id ?></td>
                <td><?php echo  $name ?></td>
                <td><?php echo $address ?></td>
                <td><?php echo $class ?></td>
                <td><?php echo $phone ?></td>
                <td>
                    <a href='edit.php?id=<?php echo $id ?>'>Edit</a>
                    <a href='<?php $_SERVER['PHP_SELF']; ?>?id=<?php echo $id ?>'>Delete</a>
                </td>
            </tr>
            <?php
           }


            ?>
            
        </tbody>
    </table>
</div>
</div>
</body>
</html>
