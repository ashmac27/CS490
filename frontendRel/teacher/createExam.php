<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<style type="text/css">
	body{
		background-image:url('images/redwhite.png');
		background-repeat: no-repeat;
		background-size: cover;
	}
	table, th, td {
  		border: 1px solid black;
  		font-size: 14pt;
	}
</style>

<head>
	<title>Create Exam</title>
</head>
<?php
	$Curl=curl_init('https://web.njit.edu/~as2745/CS490Project/getQuestions.php');
	curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
	$apiresponse=curl_exec($Curl);
	curl_close($Curl);
	$apiresponse=trim($apiresponse);
	$apiresponse=trim($apiresponse,"1");
	$apiresponse=utf8_encode($apiresponse);
	$json_response=json_decode($apiresponse,true);
	$questions=$json_response;
	//var_dump($json_response);
	$topics =[];
	foreach($questions as $getTopic){
		array_push($topics, $getTopic["topic"]);
	}
	$topics = array_unique($topics);
	//var_dump($topics);
	
?>
<body>
	<h1>Create an Exam.</h1><br>
	<label for="quesFilter">Filter By Keywords:</label>
	<input type="text" id="quesFilter" onkeyup="quesFilter()" placeholder="Search for question..."><br>
	<label for="difFilter">Filter By Difficulty:</label>
	<select id="difFilter" onchange="difFilter()" class="form-control">
		<option>Easy</option>
		<option>Medium</option>
		<option>Hard</option>
	</select><br>
	<label for="topicFilter">Filter By Topic:</label>
	<select id="topicFilter" onchange="topicFilter()" class="form-control">
		<?php
			foreach($topics as $topic){
				echo 
			'
			<option>'.$topic.'</option>
			';
			}
		?>
	</select><br><br>
	<form style="text-aligns:left;" action="https://web.njit.edu/~rna25/teacher/createExBuffer.php" method="post">
			<label for="examName">Exam Name</label><br>
			<input type="text" id="examName" name="examName" required>*<br><br>
		<fieldset>				
			<legend>Question Bank:</legend><br>
			<table id="questionTable">
			<?php
				$count=1;
				echo 
					'
					<tr>
							<th>Check</th>
							<th>QID</th>
							<th>Topic</th>
							<th>Difficulty</th>
							<th>Question</th>
							<th>Points</th>
					</tr>

					';
				foreach($questions as $question){
					
					echo '
						<tr>
							<td><input type="checkbox" name="questionBank[]" id="'.$count.'" value="'.$question["question"].'"></td>
							<td><input type="checkbox" name="qid[]" value="'.$question["qid"].'"></td>
							<td>'.$question["topic"].'</td>
							<td>'.$question["difficulty"].'</td>
							<td>'.$question["question"].'</td>
							<td><input type="number" name="points[]"> points</td>
						</tr>
									
						 ';
					//echo $question["question"];
					$count=$count+1;
					
				}
			?>
			
		</table>
			<input type="submit" value="Create Exam.">
		</fieldset>	
	</form><br>
	<button onclick="goBack()">Back to Teacher Homepage.</button>
	<script>
		function goBack(){
			window.history.back();
		}
		function quesFilter() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("quesFilter");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("questionTable");
		  tr = table.getElementsByTagName("tr");
		  for (i = 1; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[3];
		    if (td) {
		      txtValue = td.textContent || td.innerText;
		      if (txtValue.toUpperCase().indexOf(filter) > -1) {
		        tr[i].style.display = "";
		      } else {
		        tr[i].style.display = "none";
		      }
		    }       
		  }
		}
		function difFilter() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("difFilter");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("questionTable");
		  tr = table.getElementsByTagName("tr");
		  for (i = 1; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[2];
		    if (td) {
		      txtValue = td.textContent || td.innerText;
		      if (txtValue.toUpperCase().indexOf(filter) > -1) {
		        tr[i].style.display = "";
		      } else {
		        tr[i].style.display = "none";
		      }
		    }       
		  }
		}
		function topicFilter() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("topicFilter");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("questionTable");
		  tr = table.getElementsByTagName("tr");
		  for (i = 1; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[1];
		    if (td) {
		      txtValue = td.textContent || td.innerText;
		      if (txtValue.toUpperCase().indexOf(filter) > -1) {
		        tr[i].style.display = "";
		      } else {
		        tr[i].style.display = "none";
		      }
		    }       
		  }
		}
	</script>
</body>
</html>