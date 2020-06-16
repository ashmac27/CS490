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
	}
</style>

<head>
	<title>Show Filtered Question List</title>
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
?>
<body>
	<h2>Question Bank:</h2>
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
	</select><br>
	<table id="questionTable">
		<?php
			
			echo 
				'
				<tr>
					<th>Topic</th>
					<th>Difficulty</th>
					<th>Question</th>
				</tr>
				';
			foreach($questions as $question){
				echo 
					'
					<tr>
						<td>'.urldecode($question["topic"]).'</td>
						<td>'.$question["difficulty"].'</td>
						<td>'.urldecode($question["question"]).'</td>
					</tr>					
					';
					//echo $question["question"];
					
			}
		?>
			
	</table><br>
	<script>
		function quesFilter() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("quesFilter");
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
		function difFilter() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("difFilter");
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
		function topicFilter() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("topicFilter");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("questionTable");
		  tr = table.getElementsByTagName("tr");
		  for (i = 1; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[0];
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