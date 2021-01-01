<?php
	require_once "../../../config.php";
	require_once "../../../vendor/autoload.php";

	use Edu\Board\Controller\Student;

	$stu = new Student;

	$data = $stu -> allStudents();

	$i = 1;
	foreach ($data as $single_stu) :
?>
	<tr>
	    <td><?php echo $i; $i++; ?></td>
	    <td><?php echo $single_stu['name']; ?></td>
	    <td><?php echo $single_stu['roll']; ?></td>
	    <td><?php echo $single_stu['reg']; ?></td>
	    <td><?php echo $single_stu['board']; ?></td>
	    <td><?php echo $single_stu['inst']; ?></td>
	    <td><?php echo $single_stu['exam']; ?></td>
	    <td><?php echo $single_stu['year']; ?></td>
	    <td>
	        <img style="width: 50px; height: 50px; display: block;" src="students/<?php echo $single_stu['photo']; ?>" alt="">
	    </td>
	    <td><?php echo $single_stu['status']; ?></td>
	    <td>
	        <a class="btn btn-sm btn-info" href="">View</a>
	        <a class="btn btn-sm btn-warning" href="">Edit</a>
	        <a class="btn btn-sm btn-danger" href="">Delete</a>
	    </td>
	</tr>
<?php endforeach; ?>