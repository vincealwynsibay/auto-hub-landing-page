    
<?php

function get_all()
{
    include('connect_to_database.php');
    $sql = "SELECT * FROM tblcars ORDER BY ID ASC";
    $result = mysqli_query($conCD, $sql);
    return $result;
}

function searchCars($sortBy = "", $make, $transmission, $fuel_type, $min = "", $max = "")
{

    $whereClause = "1=1 ";



    if (!empty($_GET['make'])) {
        $make = $_GET['make'];
        $whereClause .= "AND make = '$make'";
    }
    if (!empty($_GET['transmission'])) {
        $transmission = $_GET['transmission'];
        $whereClause .= " AND transmission = '$transmission'";
    }
    if (!empty($_GET['fuel_type'])) {
        $fuel_type = $_GET['fuel_type'];
        $whereClause .= "AND fuel_type = '$fuel_type'";
    }

    if (isset($_GET['min']) && $_GET['min'] != "" && !empty($_GET['max'])) {
        $min = $_GET['min'];
        $max = $_GET['max'];
        $whereClause .= " AND price BETWEEN $min AND $max";
    }


    if (!empty($sortBy)) {
        $sortSelected = $_GET["sortBy"];
        if ($sortSelected == 'asc') {
            $whereClause .= " ORDER BY model_name ASC";
        } elseif ($sortSelected == 'desc') {
            $whereClause .= " ORDER BY model_name DESC";
        } elseif ($sortSelected == 'asce') {
            $whereClause .= " ORDER BY price ASC";
        } elseif ($sortSelected == 'desce') {
            $whereClause .= " ORDER BY price DESC";
        }
    }


    return getByQuery($whereClause);
}

function getAll($limit = 0)
{
    include('connect_to_database.php');
    $sql = "SELECT * FROM TBLCARS ORDER BY ID ASC";
    if ($limit > 0) {
        $sql =  "SELECT * FROM TBLCARS LIMIT $limit ORDER BY ID ASC";
    }
    $result = mysqli_query($conCD, $sql);
    return $result;
}

function getByQuery($whereClause)
{
    include('connect_to_database.php');
    $sql =  "SELECT * FROM TBLCARS WHERE $whereClause";
    $result = mysqli_query($conCD, $sql);
    return $result;
}


// function getByQuery($whereClause, $sortBy)
// {
//     if ($sortBy == 'asc') {
//         return "SELECT * FROM TBLCARS WHERE $whereClause ORDER BY model_name ASC";
//     } elseif ($sortBy == 'desc') {
//         return "SELECT * FROM TBLCARS WHERE $whereClause ORDER BY model_name DESC";
//     } elseif ($sortBy == 'asce') {
//         return "SELECT * FROM TBLCARS WHERE $whereClause ORDER BY price ASC";
//     } elseif ($sortBy == 'desce') {
//         return "SELECT * FROM TBLCARS WHERE $whereClause ORDER BY price DESC";
//     } else {
//         return "SELECT * FROM TBLCARS WHERE $whereClause";
//     }
// }
