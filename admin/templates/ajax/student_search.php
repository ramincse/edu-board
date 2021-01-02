<?php
	require_once "../../../config.php";
	require_once "../../../vendor/autoload.php";

	use Edu\Board\Controller\Student;

	$stu = new Student;

	$data = $stu -> studentSearch($_POST['stu_val']);

	echo "<ul>";

	foreach ($data as $student) :
?>
	<li id="student_select" student_id="<?php echo $student['id']; ?>" style="list-style: none;">
		<img style="width: 50px; height: 50px; border-radius: 50%; list-style: none;" src="students/<?php echo $student['photo']; ?>" alt="">		
		<span><?php echo $student['name']; ?> - </span>
		<span>Roll : <?php echo $student['roll']; ?></span>
		<span>Reg : <?php echo $student['reg']; ?></span>
	</li>
<?php endforeach; ?>
</ul>