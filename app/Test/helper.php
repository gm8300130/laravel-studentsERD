<?php
namespace App\Test;

use InvalidArgumentException;

class helper
{
	public function array_until(array $array, $search)
	{
	    $position = array_search($search, $array);
	    if ( $position == false ) {
	        throw new InvalidArgumentException('not find');
	    }

	    return array_slice($array, 0, $position);
	}
}
?>