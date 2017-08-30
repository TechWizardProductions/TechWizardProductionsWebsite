<?php

    function connectDatabase(){
        $database = mysql_connect("localhost", "id1770594_techwizardproductions", "Sam241299");
        if($database){
            mysql_select_db("id1770594_techwizardproductionsdatabase");
            return true;
        } else {
            $database = mysql_connect("localhost", "root", "");
            mysql_select_db("test");
            return true;
        }
    }

    function parseQuery($query){
        $process = mysql_query($query);
        if ($process){
            $result = mysql_fetch_array($process);
            return $result;
            //TODO: Insert $result error handling
        } else {
            echo "Error! " . mysql_error();
            return false;
        }
    }

    function parseQueryOnly($query){
        if(mysql_query($query)){
            return mysql_query($query);
        } else {
            echo "Error! " . mysql_error();
            return false;
        }
    }

?>         