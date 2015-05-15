<?php
$dp->registerFilter( 'rand', function( $data, $params ) 
{
  global $dp;
  $count = $params['count'];
  $newData = array();
  $dp->setSeed( $params['seed'] );
  while( count($newData) < $count )
  {
      $key = $dp->rand(0, count($data) );
      if(isset($data[$key]))
      {
          $newData[$key] = $data[$key];
          unset($data[$key]);
      }
  }
  return $newData;
});
