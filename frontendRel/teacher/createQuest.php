<?php
	session_start();
?>


<html>
<style type="text/css">
	body{
		background-image:url('images/redwhite.png');
		background-repeat: no-repeat;
		background-size: cover;
	}
	textarea{
		font-size:12pt;
	}
</style>
	<title>CreateQuestion</title>
	<h1>Create a question</h1><br><br>
	<h2>Fill out form to create a question</h2>

	<body>
		
		<form style="text-align:left;" action="https://web.njit.edu/~rna25/teacher/backQuestion.php" method="post">
		<fieldset>
			<legend>Question Form:</legend>
			<label for="topic">Topic</label><br>
			<input type="text" id="topic" name="topic" required>*<br>
			<label for="difficulty">Difficulty</label><br>
			<select id="difficulty" name="difficulty" required>*
				<option value="Easy">Easy</option>
				<option value="Medium">Medium</option>
				<option value="Hard">Hard</option>
			</select><br>
			<label for="question">Question</label><br>
			<textarea rows="20" cols="85" name="question" required></textarea>*<br><br>
			<label for="testCase1">Test Case 1:</label>
			<input type="text" id="testCase1" name="testCase1" required>*<br>
			<label for="answer1">Answer for Test Case 1:</label>
			<input type="text" id="answer1" name="answer1" required>*<br>

			<label for="testCase2">Test Case 2:</label>
			<input type="text" id="testCase2" name="testCase2" required>*<br>
			<label for="answer2">Answer for Test Case 2:</label>
			<input type="text" id="answer2" name="answer2" required>*<br>
			<label for="testCase3">Test Case 3:</label>
			<input type="text" id="testCase3" name="testCase3"><br>
			<label for="answer3">Answer for Test Case 3:</label>
			<input type="text" id="answer3" name="answer3"><br>
			<label for="testCase4">Test Case 4:</label>
			<input type="text" id="testCase4" name="testCase4"><br>
			<label for="answer4">Answer for Test Case 4:</label>
			<input type="text" id="answer4" name="answer4"><br>
			<p>Constraints:</p>
			Must Use A For Loop:
			<input type="radio" id="forYes" name="forloop" value="True">
			<label for="forYes">Yes</label>
			<input type="radio" id="forNo" name="forloop" value="False" checked>
			<label for="forNo">No</label>
			<br>
			Must Print Rather Than Return The Result:
			<input type="radio" id="printYes" name="print" value="True">
			<label for="forYes">Yes</label>
			<input type="radio" id="printNo" name="print" value="False" checked>
			<label for="printNo">No</label><br>

			<input type="submit" value="Submit Question">
		</fieldset>
		</form>
		<button onclick="goBack()">Return to Teacher Homepage</button>
		<script>
			function goBack(){
				window.history.back();
			}
		</script>
	</body>
</html>