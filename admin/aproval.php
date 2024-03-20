<?php


include('config.php');

$catId =$_POST['catId'];

$sql ="SELECT * FROM `books` where `id`=$catId";
$r = mysqli_query($conn,$sql);
$data = mysqli_fetch_assoc($r);
$status = $data['shows'];

if($status == '1')
{
    $status ='0';
}
else
{
    
    $status ='1';
}

$update = "UPDATE `books` SET `shows`='$status' WHERE id =$catId";
$r1=mysqli_query($conn,$update);
if ($r1) {
echo $status;

}
?>
