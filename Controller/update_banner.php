

<?php

session_start();

include("../database/env.php");

$id = $_REQUEST['id'];



if(isset($_POST['submit'])){

    $_title = $_REQUEST['title'];
    $_link = $_REQUEST['link'];
    $_description = trim($_REQUEST['description']);
    


        $file = $_FILES['file'];

     
         
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];

                $file_nameParts = explode('.', $file_name);
                $file_exten = end($file_nameParts);

                $exceptec_extention = ['jpg','png','webp','svg'];
                $ex_accet = in_array($file_exten,$exceptec_extention);

                    $nuw_file_Name = "_banner..." . uniqid(). '.' . $file_exten;

                            
                if("../upload/banner,$data->image"){
                    unlink("../upload/banner" . $data->image);
                }

                    $destination = "../upload/banner/";

                    move_uploaded_file($file_tmp,$destination.$nuw_file_Name);


    $file_size = $file['size'];

        if($file_size > 0){
                    
            $query = "UPDATE banner SET banner_image='$nuw_file_Name',title='$_title',link='$_link',description='$_description' WHERE id='$id'";

                $store =   mysqli_query($conn,$query);


                    if($store){
                        $_SESSION['succes'] = "Banner update succesfully done!";
                        header("location: ../backend/all_banner.php");
                    }
                        }else{
                           

                    $query = "UPDATE banner SET title='$_title',link='$_link',description='$_description' WHERE id='$id'";

                 $store =   mysqli_query($conn,$query);


            if($store){
            $_SESSION['success'] = "Banner update succesfully done!";
        header("location: ../backend/all_banner.php");
        }
     }
 
}


?>