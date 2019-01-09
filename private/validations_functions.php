<?php

//is_blank('abcd')
//validates data presence
//uses trim() so empty spaces don't count
//uses === to avoid false positives
//better than empty() which considers "0" to be empty

function is_blank($value){
    return !isset($value) || trim($value) === '';
}

//has_presence('abcd')
//validates data presence
//reverse of is_blank()
//we prefer validations with name 'has_'

function has_presence($value){
    return !is_blank($value);
}

//has_length_greater_than('abcd', 3)
//validates string length
//spaces count towards length
//use trim() if spaces should not count
function has_length_greater_than($value, $min){
    
}
?>