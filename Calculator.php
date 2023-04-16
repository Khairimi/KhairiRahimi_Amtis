<html>
<head>
	<style>
/* Center the form */
form {
margin: 0 auto;
      width: 50%;
    }

/* Apply margin for spacing and display */
input[type="number"] {
	  border: 2px solid #C0C0C0;
    }
	
/* Apply elements for label */	
label {
	display: block;
    margin-bottom: 10px;
	}

/* header style */
h1 {
margin: 0 auto;
      width: 50%;
    }

/* button style  */
button {
	display: block;
	margin: 0 auto;
	background-color: white; 
	color: gray; 
	border: 2px solid #008CBA;
	padding: 10px;

}

/* Box of result */
div {
	display: block;
	margin: 0 auto;
	border: 2px solid #C0C0C0;
	width: 50%;
	padding: 20px;
	margin-top: 20px;
	color: blue;
	font-weight: bold;

}

/* table style */
table{
	margin: 0 auto;
	width: 50%;
}

/* table data and table head style*/
td, th {
	border-bottom: 1px solid #C0C0C0;
    padding: 10px;
	text-align: center
}

/* table head style */
th {
	font-weight: bold;
	border-bottom: 2px solid black;
}

	</style>
</head>
<body>
	<h1> Calculate </h1><br>
	
	<form method="post" action="Calculator.php">
		
		<label for ="voltage">Voltage:</label>
		<input type ="number" id="voltage" name="voltage" required style= "width:100%;" value="<?php echo isset($_POST['voltage']) ? $_POST['voltage'] : ''; ?>">
		<label for="voltage">Voltage (V)</label><br>

		<label for ="current">Current:</label>
		<input type ="number" id="current" name="current" required style="width:100%;" value="<?php echo isset($_POST['current']) ? $_POST['current'] : ''; ?>">
		<label for ="amphere">Ampere(A)</label><br><br>

		<label for ="rate">CURRENT RATE:</label>
		<input type ="number" id="rate" name="rate" required style="width:100%;" value="<?php echo isset($_POST['rate']) ? $_POST['rate'] : ''; ?>">
		<label for ="sen">sen/kWh</label><br>

		<button class="button" type="submit" value="calculate">calculate</button>

	</form>
	
	<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $voltage = $_POST['voltage'];
    $current = $_POST['current'];
    $rate = $_POST['rate'];
    $hours = 1; // assume the device was used for 1 hour

    $power = $voltage * $current;
    $energy = $power * $hours / 1000; // convert Wh to kWh
    $total = $energy * ($rate/100);

    echo "<div>";
    if (isset($power)) {
        echo "<p>POWER: " . number_format($power / 1000, 5, '.', '') . " kW</p>";
    }
    if (isset($total)) {
        echo "<p>RATE: " . number_format($total, 3, '.', '') . " RM</p>";
    }
    echo "</div>";
    echo "<br><br>";
}
?>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Hour</th>
      <th>Energy (kWh)</th>
      <th>TOTAL (RM)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    for ($i = 1; $i <= 9; $i++) { // loop through 9 hours
      $voltage = 220; // assume constant voltage of 220V
      $current = $i; // assume current varies from 1A to 9A
      $rate = 0.165; // assume current rate of 0.165 sen/kWh
      $hours = 1; // assume the device was used for 1 hour

      $power = $voltage * $current;
      $energy = $power * $hours / 1000; // convert Wh to kWh
      $total = $energy * $rate;

      echo "<tr>";
      echo "<td>{$i}</td>";
      echo "<td>{$i}</td>";
      echo "<td>" . number_format($energy, 5, '.', '') . "</td>";
      echo "<td>" . number_format($total, 2, '.', '') . "</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

</body>
</html>