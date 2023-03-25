<?php
// Execute the SQL query and store the results in an array
$questions = $conn->query("SELECT * FROM question_list where criteria_id = {$crow['id']} and academic_id = {$_SESSION['academic']['id']} order by abs(order_by) asc ");
$q_arr = array();
while ($row = $questions->fetch_assoc()) {
  $q_arr[] = $row;
}

// Extract the question titles and order_by values from the result set
$titles = array_column($q_arr, 'question_title');
$order_by = array_column($q_arr, 'order_by');

// Set up the data and options for the chart
$data = array(
  'labels' => $titles,
  'datasets' => array(
    array(
      'label' => 'Order By',
      'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
      'borderColor' => 'rgba(54, 162, 235, 1)',
      'borderWidth' => 1,
      'data' => $order_by
    )
  )
);
$options = array(
  'scales' => array(
    'yAxes' => array(
      array(
        'ticks' => array(
          'beginAtZero' => true
        )
      )
    )
  )
);

// Convert the data and options to JSON for use in the JavaScript code
$data_json = json_encode($data);
$options_json = json_encode($options);

?>

<!-- Add a canvas element for the chart -->
<canvas id="myChart"></canvas>

<!-- Include the Chart.js library and write JavaScript code to create the chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: <?php echo $data_json; ?>,
    options: <?php echo $options_json; ?>
});
</script>
