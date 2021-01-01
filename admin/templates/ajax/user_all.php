<?php 
	require_once "../../../config.php";
	require_once "../../../vendor/autoload.php";

	use Edu\Board\Controller\User;
	$user = new User;

	$data = $user -> allUser();
	
	$all_data = $data -> fetchAll();

	$i = 1;
	foreach ($all_data as $single_data) :
?>
	<tr>
        <td><?php echo $i; $i++; ?></td>
        <td><?php echo $single_data['name']; ?></td>
        <td><?php echo $single_data['email']; ?></td>
        <td><?php echo $single_data['cell']; ?></td>
        <td><?php echo $single_data['role']; ?></td>
        <td>
            <img style="width: 50px; height: 50px; display: block;" src="images/<?php echo $single_data['photo']; ?>" alt="">
        </td>
        <td><?php echo $single_data['status']; ?></td>
        <td>
            <a class="btn btn-sm btn-info" href="">View</a>
            <a class="btn btn-sm btn-warning" href="">Edit</a>
            <a class="btn btn-sm btn-danger" href="">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>