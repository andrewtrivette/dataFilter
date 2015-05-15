<?php
include 'dataProcessing.php';
$dp = new DataProcessing();

// Let's build a sample data set based on the Fibonacci series
$data = array(0,1);
for($i=2;$i<1000;$i++)
{
    $data[$i] = bcadd( $data[$i-1], $data[$i-2] );
}

// Load up our externally defined filters
foreach( glob( 'filters/*.php' ) as $filename )
{
    include $filename;
}

// Alright, let's define which filters we'd like to use, and what parameters each filter need
$filters = array(
  'rand' => array( 'seed' => 27, 'count' => 500 ),
  'odd' => true
);
// You could define them with a JSON string as well!
//$filters = '{"rand":{"seed":"27","count":"500"},"odd":"true"}';

echo '<pre>';

// Let's get our filtered data set!
$filteredData = $dp->filterDataSet( $data, $filters );
print_r( $filteredData );

// But wait, what if I want to get the data points of the results? You're in luck!
$everythingElse = $dp->reverseFilterDataSet( $data, $filters );
print_r( $everythingElse );

echo '</pre>';
