<?php
$dp->registerFilter('odd', function( $data )
{
    $newData = array();
    foreach($data as $key => $row )
    {
        if( $row % 2 == 1 )
        {
            $newData[$key] = $row;
        }
    }
    return $newData;
});
