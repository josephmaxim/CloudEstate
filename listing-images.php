<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : dashboard.php

// Page title
$title = "Cloud Estate | Update Listing";

// Include header
include_once('header.php');

// Check if there's an existing user session
if(SessionCheck() == true)
{
    // Check user account type
    if($_SESSION['userData']['user_type'] != AGENT){
        header("Location: welcome.php");
    }
}
else
{
    header("Location: index.php");
}

$allowUpload = false;
$listingID = '';
$errors = array();
if(isset($_GET['listing_id'])){
    $listingID = $_GET['listing_id'];
}else{
    header("Location: dashboard.php");
}

$listingDirPath = "img/listings/$listingID/";

// Create a folder if not exist
if(!is_dir($listingDirPath)) {
    mkdir($listingDirPath);
}

// check if number of img is less than
if (count(scandir("$listingDirPath")) < MAX_IMAGE_UPLOAD + 2 && count(scandir("$listingDirPath")) >= 2){
    $allowUpload = true;
    $files = array_diff(scandir($listingDirPath), array('.', '..'));
}else{
    $allowUpload = false;
}

// upload button
if (isset($_POST['upload'])){

    if(!empty($_FILES['file']['name'])){
        $currentName = $_FILES['file']['name'];
        if(pathinfo($currentName)['extension'] === 'jpg'){
            if ($_FILES['file']['size'] <= MAX_FILE_SIZE) {
                for($count = 1; $count < MAX_IMAGE_UPLOAD + 1; $count++){
                    if(file_exists($listingDirPath.$listingID.'_'.$count.'.jpg') == false){
                        $newName = $listingID.'_'.$count.'.jpg';
                        move_uploaded_file($_FILES["file"]["tmp_name"], $listingDirPath.$newName);
                    }
                }
                header("Refresh:0");
            }else{
                array_push($errors, "- Maximum image file size is 200kb!");
            }
            for($count = 1; $count > MAX_IMAGE_UPLOAD; $count++){

            }
        }else{
            array_push($errors, "- Only .jpg images can be uploaded.");
        }
    }else{
        array_push($errors, "- Please select an image!");
    }
}

// Delete images
if(isset($_POST['delete'])){
    if(!empty($_POST['file'])){
        foreach ($_POST['file'] as $file){
            unlink($listingDirPath.$file);
        }
        header("Refresh:0");
    }
}

// select main images
if(isset($_POST['mainImage'])){
   if(isset($_POST['main'])){
        if(setMainImage($listingID,$_POST['main']) == false){
            array_push($errors, "- There was a problem setting the main image for this listing.");
        }else{
            header("Refresh:0");
        }
   }
}

    ?>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-sidebar">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="listing-create.php">Create Listing</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 content-left">
                    <h1>Upload images to listing #<?php echo $listingID;?></h1>
                    <p><a href="listing-display.php?listing_id=<?php echo $listingID?>">Click here</a> to view your updated listing.</p>
                    <hr/>
                    <?php
                    if(!empty($errors)){
                        ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Error(s):</strong><br/>
                            <?php
                            foreach ($errors as $error){
                                echo "<span>$error</span><br/>";
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                        // Determine if user can upload images or not
                        if($allowUpload == true){
                        ?>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . "?listing_id=" . $listingID;?>"  enctype="multipart/form-data">
                                <label>Select images to upload</label>
                                <input type="file" id="file" name="file" accept="image/*" />
                                <br/>
                                <input class="btn btn-success btn-sm" type="submit" name="upload" value="Upload Image">
                            </form>
                            <hr/>
                            <?php
                        }else{
                            ?>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <p>You have reached the max upload count.</p>
                            </div>
                            <?php

                        }
                    ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . "?listing_id=" . $listingID;?>">
                        <label>Select Main Image</label><br>
                        <?php
                        $files = array_diff(scandir($listingDirPath), array('.', '..'));
                        $mainImage = 0;
                        foreach ($files as $file){
                            $mainImage +=1;
                            echo '<div class="radio-inline"><label><input type="radio" name="main" value="'.$mainImage.'"><img width="100px" height="100px" src="'.$listingDirPath.$file.'"/></label></div>';
                        }
                        ?>
                        <br>
                        <input class="btn btn-info btn-sm" type="submit" name="mainImage" value="Change main Image">
                    </form>
                    <hr/>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . "?listing_id=" . $listingID;?>">
                        <label>Delete Image(s)</label><br>
                        <?php
                        $files = array_diff(scandir($listingDirPath), array('.', '..'));
                        foreach ($files as $file){
                            echo '<div class="checkbox-inline"><label><input type="checkbox" name="file[]" value="'.$file.'"><img width="100px" height="100px" src="'.$listingDirPath.$file.'"/></label></div>';
                        }
                        ?>
                        <br>
                        <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>