<!DOCTYPE htmL>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <?php
            global $db;
            include("../connect.php");

            if(isset($_GET['idTL'])){
            $sql="select * from theloai where idTL=".filter_input(INPUT_GET, 'idTL');}
            //$kq=mysql_query($sl);
            //$d=mysql_fetch_array($kq);
            //mysqli
            // $results = mysqli_query($connect,$sl);
            // $d = mysqli_fetch_array($results);
            $statement = $db -> prepare($sql);
            $statement -> execute();
            $result = $statement -> fetch();
            $statement -> closeCursor();
        ?>
        <form action="" method="post" enctype="multipart/form-data" name="form1">
            <table align="left" width="400">
                <tr>
                    <td align="right">
                        Ten The Loai
                    </td>
                    <td>
                        <input type="text" name="TenTL" value="<?php echo $result['TenTL'];?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        Thu Tu
                    </td>
                    <td>
                        <input type="text" name="ThuTu" value="<?php echo $result['ThuTu'];?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        An Hien
                    </td>
                    <td>
                        <select name="AnHien">
                            <option value="0" <?php if($result['AnHien']==0) echo "selected";?>>An</option>
                            <option value="1" <?php if($result['AnHien']==1) echo "selected";?>>Hien</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">icon</td>
                    <td> <img src="image/<?php echo $result['icon'] ?>" width="40" height="40" /></td>

                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td>  <input type="file" name="image" id="image"  /> </td>
                </tr>
                <tr>
                    <td align="right">
                        <input type="hidden" name="idTL" value="<?php echo filter_input(INPUT_GET, 'idTL');?>" />
                        <input type="submit" name="Sua" value="Sua" />
                    </td>
                    <td>
                        <input type="reset" name="Huy" value="Huy" />
                    </td>
                </tr>
            </table>
        </form>
        <?php
            global $db;
            include_once("../connect.php");
            // upload hinh anh
            if(isset($_FILES["image"]["name"])) 	$icon=$_FILES["image"]["name"];
            if(isset($_FILES['image']['tmp_name'])) {
                $anhminhhoa_tmp=$_FILES['image']['tmp_name'];
                if(isset($_GET['idTL']))
                {
                    $sql="select icon from theloai where idTL=".filter_input(INPUT_GET, 'idTL');
                }
                // $results = mysqli_query($connect,$sl);
                // $d = mysqli_fetch_array($results);
                $statement = $db -> prepare($sql);
                $statement -> execute();
                $result = $statement -> fetch();
                $statement -> closeCursor();
                if($result['icon']!=$icon)
                {
                    unlink('../image/'.$result['icon']);
                    move_uploaded_file($anhminhhoa_tmp,"../image/".$icon);
                }
            }
            $tam="";
            if(isset($_POST["TenTL"]))	$theloai = filter_input(INPUT_POST, 'TenTL');
            if(isset($_POST["ThuTu"]))	$thutu =  filter_input(INPUT_POST, 'ThuTu');
            if(isset($_POST["AnHien"]))	$an=  filter_input(INPUT_POST, 'AnHien');
            if (isset($_POST['Sua']))
            {
                if(isset($_GET["idTL"]))
                {
                    $key =  filter_input(INPUT_POST, "idTL");
                }

                if($icon=="")
                {
                    $sl="update theloai set TenTL='$theloai',ThuTu='$thutu',AnHien='$an' where idTL='$key'";
                }
                else
                {
                    $sl="update theloai set TenTL='$theloai',ThuTu='$thutu',AnHien='$an',icon='$icon' where idTL ='$key'";
                }

                $error_message = "Sua that bai!!!";
                $statement1 = $db -> prepare($sl);
                $statement1 -> execute();
                $rs = $statement1;
                $statement1 -> closeCursor();

                if($rs == true)
                {
                    echo "<script language='javascript'>alert('sua thanh cong');";
                    echo "location.href='theloai.php';</script>";
                }
                else {
                    echo 'Lỗi: ',display_db_error($error_message);
                }
            }
        ?>
    </body>
</html>
