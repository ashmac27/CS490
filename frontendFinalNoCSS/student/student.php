<?php
	session_start();
?>
<html>
	<style type="text/css">
		body,html{
			background-color: #F2F6F8;
			margin:0px;
			height: 100%;
			background-size: cover;
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
		
		div.Student p{
			color: #071D49;
			font-weight: bold;
			font-size:20pt;

		}
	</style>
	<body>
		<div class="Student">
			<p>Hello Student User:<?php echo $_SESSION['username'];?></p>		
		</div>
		<div class="grandLogin">
			<div class="square">
				<li>
					<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/student/takeExam.php">Take Exam</a></p><br><br>
					<p style="text-align:center; font-size:20pt;";><a href="https://web.njit.edu/~rna25/student/reviewGradeS.php">Review an Exam</a></p><br><br>

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
