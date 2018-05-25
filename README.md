### Multisorter throw merge ####
#### to sort flat arrays, array of objects and arrays of arays ####

##### usage: #####
`$sort = new Multisort($field, $type);`
`$sorted = $sort->mergeSort($array);`

where 
* $field = false for flat arrays;
* $field = name_of_property for arrays of objects
* $field = array_key for arrays of associative arrays

* $sort = 'asc' or 'desc'