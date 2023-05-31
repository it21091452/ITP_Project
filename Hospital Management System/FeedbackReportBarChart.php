<?php

	/* -- Session -- */
   
	require 'fconfig.php';
	session_start();
	$user_id = $_SESSION['user_id'];

	if(!isset($user_id))
		header('location:feedbackmlogin.php');                                                                                                                                                                                                                                                       	                   /* SUDA */

	if(isset($_GET['logout'])){
		unset($user_id);
		session_destroy();
		header('location:feedbackmlogin.php');
	}

	try{
		$conn = new PDO("mysql:host=localhost;dbname=hospital_management_system","root","");
	} catch (PDOException $ex) {
		echo $ex->getMessage();
		exit();
	}

	$complain_ans_query = "SELECT * FROM complaint WHERE Feedback_ManagerID != 0 ";
	$complain_ans_result = $conn->query($complain_ans_query);
	$complain_ans_count = $complain_ans_result->rowCount();

	$complain_not_ans_query = "SELECT * FROM complaint WHERE Feedback_ManagerID = 0 ";
	$complain_not_ans_result = $conn->query($complain_not_ans_query);
	$complain_not_ans_count = $complain_not_ans_result->rowCount();

	$faq_ans_query = "SELECT * FROM faq WHERE Feedback_ManagerID != 0 ";
	$faq_ans_result = $conn->query($faq_ans_query);
	$faq_ans_count = $faq_ans_result->rowCount();

	$faq_not_ans_query = "SELECT * FROM faq WHERE Feedback_ManagerID = 0 ";
	$faq_not_ans_result = $conn->query($faq_not_ans_query);
	$faq_not_ans_count = $faq_not_ans_result->rowCount();

	$int_val_01 = 0;

	$complain_ans_value = -1;
	$complain_not_ans_value = -1;
	$faq_ans_value = -1;
	$faq_not_ans_value = -1;


	if(@$_POST['generate_report'])
        $int_val_01 = 1;

	if($int_val_01 == 1){

		$complain_ans_value = floatval($complain_ans_count);
		$complain_not_ans_value = floatval($complain_not_ans_count );
		$faq_ans_value = floatval($faq_ans_count);
		$faq_not_ans_value = floatval($faq_not_ans_count);


	}

?>


<html>

	<head>

		<!-- add a title (a)-->
		<title>Generated Feedback Report - Bar Chart</title>

		<!--<add Javascript-->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    	<script type="text/javascript">

		
	  google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Number Of Entries'],
          ['Answered Complains',<?php echo $complain_ans_value ?>],
          ['Not Answered Complains',<?php echo $complain_not_ans_value ?>],
          ['Answered FAQs',<?php echo $faq_ans_value ?>],
          ['Not Answered FAQs',<?php echo $faq_not_ans_value ?>],
		  ['Total Number Of Feedbacks',<?php echo ($complain_ans_value+$complain_not_ans_value+$faq_ans_value+$faq_not_ans_value) ?>]
        ]);

        var options = {
          chart: {
            title: 'Feedback Information',
            subtitle: 'Following bar chart represent feedback infromation of e-Service',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

    </script>
	
	</head>

	<body>
		

		<!-- Implementation started here-->

		<form method = "POST" action="FeedbackReportBarChart.php" >
			<?php if($int_val_01 == 0) { ?> <td><input type="submit" value="DISPLAY REPORT" name="generate_report"></td> <?php } ?>
		</form>

		<?php if($int_val_01 == 1) { ?>
			
			<div id="barchart_material" style="width: 900px; height: 500px;"></div>

			<?php 
			$total_complains = $complain_ans_value + $complain_not_ans_value; 
			$total_faqs = $faq_ans_value + $faq_not_ans_value;
			$total_feedbacks = $total_complains + $total_faqs;
			?>

			<br><br><br>
			<h3 style="margin-left:200px"> Percentage Of Complains : <?php echo round(floatval($total_complains/$total_feedbacks*100),2)."%" ?> </h3>
			<br>
			<h3 style="margin-left:200px"> Percentage Of FAQs : <?php echo round(floatval($total_complains/$total_feedbacks*100),2)."%" ?> </h3>

		<?php } ?>

		<br><br><br>

		<!-- Implementation ended here-->

		<!----------------------footer-------------------------------------------->

			</footer>

	</body>

</html>