<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_unique_slug'))
{
    function getUniqueSlug($initial_slug_attempt, $table, $field) 
    {
        $CI =& get_instance();

        // MAKE SURE THEY ARE ESCAPED/NOT OPEN TO INJECTION ATTACKS!! ^^
        // DO NOT HAVE $table/$field variables from $_POST/$_GET/$CI->input. HARD CODE THEM IN TO SOMETHING SAFE. 
        // Read up about sql injection if you do not know about it.
        $max_counter = 100; // after this number it will start to add random numbers.
                            // handy if you are importing 1,000,000 records and just want a
                            // unique slug, don't care if it has random letters
        $length_of_random_suffix = 5; // how long the random suffix should be
        $i=1;
        while(true) {
            $attempt = trim($initial_slug_attempt);
            if ($i==1 && $attempt != '') {
                // just try attempt, if it is first iteration and it isn't blank
            }
            else {
                // we don't want it trying this 1000s of times, so after $max_counter
                // we will just add a random string, of $length_of_random_suffix length.
                if ($i>$max_counter) {
                    $attempt .= substr(md5(rand().time()),0,$length_of_random_suffix);
                }
                else {
                    // but if its under $max_counter, just add the counter ($i) number
                    $attempt = $attempt . $i;
                }
            }
            // 'slug' it - make "A Test Title" into 'a-test-title'
            // url_title is a CI function
            // https://github.com/EllisLab/CodeIgniter/blob/develop/system/helpers/url_helper.php line 453.
            // also make sure it is lowercase 
            $attempt = url_title($attempt,'-',TRUE);
            // uses CI's DB methods, but easy to change to whatever system you use
            // MAKE SURE THE $table and $field ARE SAFE TO USE!!
            $sql = "select count(*) as c from `$table` where `$field` = " . $CI->db->escape($attempt);
            $query = $CI->db->query($sql);
            $row = $query->row_array();
            if ($row['c'] == 0) {
                // no results found! so we can use it
                return $attempt;
            }
            else {
                // there was at least 1 result with that slug...
            }
            $i++;
            // could lower these numbers, TODO: work out precise nums here
            if ($i>10000) {$max_counter = 10;} 
        }
    }
}
?>