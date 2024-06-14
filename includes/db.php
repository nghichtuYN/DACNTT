<?php
function ConnectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SalesManagement";
    try {
        $conn = new PDO("mysql: $servername=;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
    return $conn;
}
function getALlProducts($CatID = 0, $begin = 0, $end = 0, $limit = 4, $offset = 0, $tukhoa = "")
{
    $conn = ConnectDB();
    $strSQL = "SELECT P.*, C.CatName FROM tbproduct P 
                INNER JOIN tbcategory C ON P.CatID = C.CatID WHERE 1";
    if ($CatID > 0) {
        $strSQL .= " AND P.CatID=$CatID";
    }
    if ($begin > 0 && $end > 0) {
        $strSQL .= " AND P.Price >= $begin AND P.Price <= $end";
    }
    if ($tukhoa != "")
        $strSQL .= " AND P.ProName LIKE '%$tukhoa%'";
    $strSQL .= " ORDER BY P.ProID";
    if ($limit > 0 && $offset >= 0) {
        $strSQL .= " LIMIT $offset, $limit";
    }


    $pdo_stm = $conn->prepare($strSQL);
    $ketqua = $pdo_stm->execute();
    if ($ketqua == TRUE) {
        $rows = $pdo_stm->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } else {
        return FALSE;
    }
}
function getProductById($id)
{
    $conn = ConnectDB();
    $strSQL = "SELECT * FROM tbproduct WHERE ProID=$id";
    $pdo_stm = $conn->prepare($strSQL);
    $ketqua = $pdo_stm->execute();
    if ($ketqua == TRUE) {
        $row = $pdo_stm->fetch(PDO::FETCH_ASSOC);
        return $row;
    } else
        return FALSE;
}
function createOrder($userID, $custName, $custAddress, $custPhone, $OrdCost)
{
    $conn = ConnectDB();
    $strSQL = "INSERT INTO tborder (UserID,CustName,CustAddress,CustPhone,OrdCost) VALUES (?,?,?,?,?)";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$userID, $custName, $custAddress, $custPhone, $OrdCost]);
    return $conn->lastInsertId();
}
function createOrderDetail($OrdID, $ProID, $Quantity, $Price)
{
    $conn = ConnectDB();
    $strSQL = "INSERT INTO tborderdetail (OrdID,ProID,Quantity,Price) VALUES (?,?,?,?)";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$OrdID, $ProID, $Quantity, $Price]);
    return  $result;
}
function registerUser($CustName, $CustEmail, $CustPassword)
{
    $conn = ConnectDB();
    $strSQL = "INSERT INTO tbuser (UserName,UserEmail,UserPassword) VALUES (?,?,?)";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$CustName, $CustEmail, md5($CustPassword)]);
    return  $result;
}
function checkUser($Email)
{
    $conn = ConnectDB();
    $strSQL = "SELECT COUNT(*) AS userCount FROM tbuser WHERE UserEmail = ?";
    $pdo_stm = $conn->prepare($strSQL);
    $pdo_stm->execute([$Email]);
    $result = $pdo_stm->fetch(PDO::FETCH_ASSOC);
    return $result['userCount'];
}

function loginUser($Email, $Password)
{
    $conn = ConnectDB();
    $strSQL = "SELECT * FROM tbuser WHERE UserEmail = ? AND UserPassword = ?";
    $pdo_stm = $conn->prepare($strSQL);
    $pdo_stm->execute([$Email, md5($Password)]);
    $result = $pdo_stm->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function updateUser($Password, $UserID)
{
    $conn = ConnectDB();
    $strSQL = "UPDATE tbuser SET UserPassword= ? WHERE UserID = ? ";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([md5($Password), $UserID]);
    return $result;
}
function getUserOrderById($id)
{
    $conn = ConnectDB();
    $strSQL = "SELECT * FROM tborder WHERE UserID = ? ";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$id]);
    if ($result == TRUE) {
        $rows = $pdo_stm->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } else
        return FALSE;
}
function getOrderDetailByID($id)
{
    $conn = ConnectDB();
    $strSQL = "SELECT P.ProID,P.ProName,P.ProImage,P.Price,O.Quantity,O.Price AS TotalPrice FROM tborderdetail O INNER JOIN tbproduct P ON O.ProID=P.ProID WHERE O.OrdID= ?";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$id]);
    if ($result == TRUE) {
        $rows = $pdo_stm->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } else
        return FALSE;
}
function getAllCategories($limit = 0, $offset = 0)
{
    $conn = ConnectDB();
    $strSQL = "SELECT * FROM tbcategory";
    if ($limit > 0 && $offset >= 0) {
        $strSQL .= " LIMIT $offset, $limit";
    }
    $pdo_stm = $conn->prepare($strSQL);
    $ketqua = $pdo_stm->execute();
    if ($ketqua == TRUE) {
        $rows = $pdo_stm->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } else
        return FALSE;
}
function getCountProduct($CatID = 0, $begin = 0, $end = 0, $tukhoa = "")
{
    $conn = ConnectDB();
    $strSQL = "SELECT COUNT(*) AS proCount FROM tbproduct WHERE 1";
    if ($CatID > 0) {
        $strSQL .= " AND CatID=$CatID";
    }
    if ($begin > 0 && $end > 0) {
        $strSQL .= " AND Price >= $begin AND Price <= $end";
    }
    if ($tukhoa != "")
        $strSQL .= " AND ProName LIKE '%$tukhoa%'";
    $pdo_stm = $conn->prepare($strSQL);
    $pdo_stm->execute();
    $result = $pdo_stm->fetch(PDO::FETCH_ASSOC);
    return $result['proCount'];
}
function getCountCategory($CatID = 0, $begin = 0, $end = 0)
{
    $conn = ConnectDB();
    $strSQL = "SELECT COUNT(*) AS catCount FROM tbcategory WHERE 1";
    $pdo_stm = $conn->prepare($strSQL);
    $pdo_stm->execute();
    $result = $pdo_stm->fetch(PDO::FETCH_ASSOC);
    return $result['catCount'];
}
function getCountOrder($CatID = 0, $begin = 0, $end = 0)
{
    $conn = ConnectDB();
    $strSQL = "SELECT COUNT(*) AS ordCount FROM tborder WHERE 1";
    if ($CatID > 0) {
        $strSQL .= " AND CatID=$CatID";
    }
    if ($begin > 0 && $end > 0) {
        $strSQL .= " AND P.Price >= $begin AND P.Price <= $end";
    }
    $pdo_stm = $conn->prepare($strSQL);
    $pdo_stm->execute();
    $result = $pdo_stm->fetch(PDO::FETCH_ASSOC);
    return $result['ordCount'];
}
function getAllOrders($limit = 4, $offset = 0)
{
    $conn = ConnectDB();
    $strSQL = "SELECT * FROM tborder WHERE 1 ";
    if ($limit > 0 && $offset >= 0) {
        $strSQL .= " LIMIT $offset, $limit";
    }
    $pdo_stm = $conn->prepare($strSQL);
    $ketqua = $pdo_stm->execute();
    if ($ketqua == TRUE) {
        $rows = $pdo_stm->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } else
        return FALSE;
}
function getOrderDetail($OrdID)
{
    $conn = ConnectDB();
    $strSQL = "SELECT O.*, SUM(OD.PRICE) AS TotalPrice FROM tborder O INNER JOIN tborderdetail OD ON O.OrdID = OD.OrdID WHERE O.OrdID = ? GROUP BY O.OrdID;";
    $strSQLProduct = "SELECT P.ProID,P.ProName,P.ProImage,P.Price,O.Quantity,O.Price AS TotalPrice FROM tborderdetail O INNER JOIN tbproduct P ON O.ProID=P.ProID WHERE O.OrdID= ?";
    $result = array();

    $pdo_stm = $conn->prepare($strSQL);
    $pdo_stm->execute([$OrdID]);
    $result['order'] = $pdo_stm->fetch(PDO::FETCH_ASSOC);

    $pdo_stm = $conn->prepare($strSQLProduct);
    $pdo_stm->execute([$OrdID]);
    $result['orderDetail'] = $pdo_stm->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function updateOrder($id, $status, $receiveDate)
{
    $conn = ConnectDB();
    $strSQL = "UPDATE tborder SET Status= ? ,ReceiveDate= ? WHERE OrdID=?";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$status, $receiveDate, $id,]);
    return $result;
}
function updateProductByID($id, $ProName, $Price, $Description, $status, $catID)
{
    $conn = ConnectDB();
    $strSQL = "UPDATE tbproduct SET ProName  = ?,Price=?,Description=?, Status= ?,CatID=? WHERE ProID=?";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$ProName, $Price, $Description, $status, $catID, $id]);
    return $result;
}
function createProduct($ProName, $ProImage = "", $ProImage1 = "", $ProImage2 = "", $ProImage3 = "", $ProImage4 = "", $Price, $Descriptions, $Status, $CatID)
{
    $conn = ConnectDB();
    $strSQL = "INSERT INTO tbproduct (ProName,ProImage,ProImage1,ProImage2,ProImage3,ProImage4,Price,Description,Status,CatID) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$ProName, $ProImage, $ProImage1, $ProImage2, $ProImage3, $ProImage4, $Price, $Descriptions, $Status, $CatID]);
    return $result;
}
function deleteProductByID($id)
{
    $conn = ConnectDB();
    $strSQL = "DELETE FROM tbproduct WHERE ProID=?";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$id]);
    return $result;
}
function createCategory($catName, $status)
{
    $conn = ConnectDB();
    $strSQL = "INSERT INTO tbcategory (CatName,Status) VALUES (?,?)";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$catName, $status]);
    return $result;
}
function getCategoryByID($id)
{
    $conn = ConnectDB();
    $strSQL = "SELECT * FROM tbcategory WHERE CatID=$id";
    $pdo_stm = $conn->prepare($strSQL);
    $ketqua = $pdo_stm->execute();
    if ($ketqua == TRUE) {
        $row = $pdo_stm->fetch(PDO::FETCH_ASSOC);
        return $row;
    } else
        return FALSE;
}
function updateCategoryByID($id, $catName, $status)
{
    $conn = ConnectDB();
    $strSQL = "UPDATE tbcategory SET CatName= ? , Status= ? WHERE CatID=?";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$catName, $status, $id]);
    return $result;
}
function deleteCategoryByID($id)
{
    $conn = ConnectDB();
    $strSQL = "DELETE FROM tbcategory WHERE CatID=?";
    $pdo_stm = $conn->prepare($strSQL);
    $result = $pdo_stm->execute([$id]);
    return $result;
}
