<?php
class DataProcessing
{
    protected $seed = 123456789;
    protected $data;
    protected $filters;
    
    public function setSeed( $seed )
    {
        $this->seed = $seed;
    }
    
    // http://www.sitepoint.com/php-random-number-generator/
    public function rand( $min = 0, $max = 9999999, $seed = false ) 
    {
		if( $seed != false )
		{
		    $this->setSeed( $seed );
		}
		$this->seed = ( $this->seed * 125 ) % 2796203;
		return $this->seed % ( $max - $min + 1 ) + $min;
	}
	
	public function importDataSet( $data )
	{
	    if( is_file( $data ) )
	    {
	        $data = file_get_contents( $data );
	    }
	    $data = $this->convertDataSet( $data );
	    $this->data = $data;
	}
	
	public function convertDataSet( $data )
	{
	    // Data can be an array, or JSON, or CSV data
	    $json = json_decode( $data, true );
	    if( is_array( $json ) )
	    {
	       return $json;
	    }
	    
	    if( is_array( $data ) )
	    {
	        return $data;
	    }
	    $csv = array_map( 'str_getcsv', $data );
	}
	
	public function registerFilter( $id, $callback )
	{
	    $this->filters[$id] = $callback;
	}
	
	public function filterDataSet( $data, $filters )
	{
	    if( is_string( $filters ) )
	    {
	        $filters = json_decode( $filters, true );
	    }
	    foreach( $filters as $filter => $params )
	    {
	        $filter = $this->filters[$filter];
	        $data = $filter( $data, $params );
	    }
	    return $data;
	}
	
	public function reverseFilterDataSet( $data, $filters )
	{
	    $filteredData = $this->filterDataSet( $data, $filters );
	    return array_diff( $data, $filteredData );
	}
}
