<?php
//if upload form is submitted
if(isset($_POST["upload"])){
    //get the file information
    $fileName = basename($_FILES["image"]["name"]);
    $fileTmp = $_FILES["image"]["tmp_name"];
    $fileType = $_FILES["image"]["type"];
    $fileSize = $_FILES["image"]["size"];
    $fileExt = substr($fileName, strrpos($fileName, ".") + 1);
    
    //specify image upload directory
    $largeImageLoc = 'upload'.$fileName;
    $thumbImageLoc = 'upload/hasil/'.$fileName;
 
    //check file extension
    if((!empty($_FILES["image"])) && ($_FILES["image"]["error"] == 0)){
        if($fileExt != "jpg" && $fileExt != "jpeg" && $fileExt != "png"){
            $error = "Sorry, only JPG, JPEG & PNG files are allowed.";
        }
    }else{
        $error = "Select a JPG, JPEG & PNG image to upload";
    }
    
    //if everything is ok, try to upload file
   
        if(move_uploaded_file($fileTmp, $largeImageLoc)){
            //file permission
            chmod ($largeImageLoc, 0777);
            
            //get dimensions of the original image
            list($width_org, $height_org) = getimagesize($largeImageLoc);
            
            //get image coords
            $x = (int) $_POST['x'];
            $y = (int) $_POST['y'];
            $width = (int) $_POST['w'];
            $height = (int) $_POST['h'];

            //define the final size of the cropped image
            $width_new = $width;
            $height_new = $height;
            
            //crop and resize image
            $newImage = imagecreatetruecolor($width_new,$height_new);
            
            switch($fileType) {
                case "image/gif":
                    $source = imagecreatefromgif($largeImageLoc); 
                    break;
                case "image/pjpeg":
                case "image/jpeg":
                case "image/jpg":
                    $source = imagecreatefromjpeg($largeImageLoc); 
                    break;
                case "image/png":
                case "image/x-png":
                    $source = imagecreatefrompng($largeImageLoc); 
                    break;
            }
            
            imagecopyresampled($newImage,$source,0,0,$x,$y,$width_new,$height_new,$width,$height);
            
            switch($fileType) {
                case "image/gif":
                    imagegif($newImage,$thumbImageLoc); 
                    break;
                case "image/pjpeg":
                case "image/jpeg":
                case "image/jpg":
                    imagejpeg($newImage,$thumbImageLoc,90); 
                    break;
                case "image/png":
                case "image/x-png":
                    imagepng($newImage,$thumbImageLoc);  
                    break;
            }
            imagedestroy($newImage);
            
            //remove large image
            //unlink($imageUploadLoc);

            //display cropped image
            echo 'CROP IMAGE:<br/><img src="'.$thumbImageLoc.'"/>';
        }else{
            $error = "Sorry, there was an error uploading your file.";
        }
    }else{
        //display error
        echo $error;
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
	<style>
	.button {
		background-color: #4CAF50;
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
        margin-top: 10px;
	}
    body {
    background-color: #CCCCCC;
    border-radius: 10px 10px 0 0;
    padding: 10px 0;
    text-align: center;
    margin-top: 20px;
    }
    h3{
        color: green;
        margin-bottom: 2px;
    }
</style>
</head>
<body>
<h3>Tekan tombol OCR</h3>
<a href="index.php" class="button">OCeR</a>


</body>
</html>