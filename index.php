<html>  
<head>  
<Title>Azure SQL Database - PHP Website</Title>  
</head>  
<body>  
<form method="post" action="?action=add" enctype="multipart/form-data" >  
Nama_Kota <input type="text" name="t_emp_id" id="t_emp_id"/></br>  
Kode_Kota <input type="text" name="t_name" id="t_name"/></br>  
  
<input type="submit" name="submit" value="Submit" />  
</form>  
<?php  
/*Connect using SQL Server authentication.*/  
$serverName = "tcp:submission1borneo.database.windows.net,1433";  
$connectionOptions = array(  
    "Database" => "dicodingbpn",  
    "UID" => "dicodingbpn",  
    "PWD" => "B4l!kp4p4n"  
);  
$conn = sqlsrv_connect($serverName, $connectionOptions);  
  
if ($conn === false)  
    {  
    die(print_r(sqlsrv_errors() , true));  
    }  
  
if (isset($_GET['action']))  
    {  
    if ($_GET['action'] == 'add')  
        {  
        /*Insert data.*/  
        $insertSql = "INSERT INTO KOTA (Nama_Kota,Kode_Kota)   
VALUES (?,?)";  
        $params = array(&$_POST['t_Nama_Kota'], &$_POST['t_Kode_Kota']  );  
        $stmt = sqlsrv_query($conn, $insertSql, $params);  
        if ($stmt === false)  
            {  
            /*Handle the case of a duplicate City.*/  
            $errors = sqlsrv_errors();  
            if ($errors[0]['code'] == 2601)  
                {  
                echo "City you entered has already been used.</br>";  
                }  
  
            /*Die if other errors occurred.*/  
              else  
                {  
                die(print_r($errors, true));  
                }  
            }  
          else  
            {  
            echo "Registration complete.</br>";  
            }  
        }  
    }  
  
/*Display registered KOTA.*/  
/*$sql = "SELECT * FROM KOTA ORDER BY Kode_Kota"; 
$stmt = sqlsrv_query($conn, $sql); 
if($stmt === false) 
{ 
die(print_r(sqlsrv_errors(), true)); 
} 
 
if(sqlsrv_has_rows($stmt)) 
{ 
print("<table border='1px'>"); 
print("<tr><td>Nama_Kota</td>"); 
print("<td>Kode_Kota</td></tr>"); 
 
while($row = sqlsrv_fetch_array($stmt)) 
{ 
 
print("<tr><td>".$row['Nama_Kota']."</td>"); 
print("<td>".$row['Kode_Kota']."</td></tr>"); 
} 
 
print("</table>"); 
}*/  
?>  
</body>  
</html>