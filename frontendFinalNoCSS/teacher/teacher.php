<?php
	session_start();
?>
<html>
<style type="text/css">
	html,body{
		background-image:url('images/redwhite.png');
		background-repeat: no-repeat;
		background-size: cover;
		margin:0px;
		height: 100%;
	}

	.grandLogin {
		display:table;
		height:100%;
		margin:0 auto;
	}
	div.square {
		display: table-cell;  	
	  	vertical-align: middle;
	}
	div.square {
		width:400px;
	  	
	  	text-align: center;
	}	
	a{
		color: white;
		background-color: #D22630;
		border:1px solid black;
		border-radius: 25px;
		font-weight: bold;

		


	}
	li{
		list-style-type: none;
	}
	li a{
		display: block;
		height:30px;
		padding: 25px;
	}
	button{
		color: white;
		background-color: #D22630;
		width:200px;
		border:1px solid black;
		border-radius: 25px;
	}
	
	div.Teacher p{
		color: #071D49;
		font-weight: bold;
		font-size:20pt;

	}
</style>
	<body>
	<div class="Teacher">
		<p>Hello Teacher User:<?php echo $_SESSION['username'];?></p>
	</div>
	<div class="grandLogin">
		<div class="square">
			<li>
			<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/teacher/CreatQuestV2.php">Create a Question</a></p><br><br>
			<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/teacher/CreateExamV2.php">Create an Exam</a></p><br><br>
			<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/teacher/reviewGradeT.php">Review an Exam Grade</a></p><br><br>
			<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/teacher/something.php">Table</a></p><br><br>



	
			<button style="font-size:20pt;" onclick="goBack()">Return to login</button>
			</li>
			<script>
				function goBack(){
					window.location.replace('https://web.njit.edu/~rna25/');
				}
			</script>
		</div>
	</div>
	</body>
</html>
