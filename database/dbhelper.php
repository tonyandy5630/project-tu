<?php

function connectDB()
{
    return mysqli_connect(HOST, USERNAME, PASSWORD);
}

function createDatabase()
{
    //save data into table
    // open connection to database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD);
    //insert, update, delete
    $sql = 'CREATE DATABASE IF NOT EXISTS ' . DATABASE;
    mysqli_query($con, $sql);

    //close connection
    mysqli_close($con);
}

function execute($sql)
{
    //save data into table
    // open connection to database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    //insert, update, delete
    $res = mysqli_query($con, $sql);

    //close connection
    mysqli_close($con);
    return $res;
}

function executeTransaction($sql)
{
    $con = connectDB();
    mysqli_begin_transaction($con);
    try {
        // Execute the query
        $res = mysqli_query($con, $sql);

        if ($res) {
            mysqli_commit($con);
        } else {
            mysqli_rollback($con);
            echo "Transaction failed: " . mysqli_error($con);
        }
    } catch (Exception $e) {
        mysqli_rollback($con);
        echo "Transaction failed with exception: " . $e->getMessage();
    } finally {
        mysqli_close($con);
    }
}

function executeResult($sql)
{
    //save data into table
    // open connection to database
    try {
        $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        //insert, update, delete
        $result = mysqli_query($con, $sql);
        $data   = [];
        while ($row = mysqli_fetch_array($result)) {
            $data[] = $row;
        }
        mysqli_free_result($result);

        //close connection
        // mysqli_close($con);
        return $data;
    } catch (Exception $e) {
        echo $e;
    }
}
