<?php require_once("session.php"); ?>
<?php require("func.php"); ?>
<?php $links=check_logged_in_student(); ?>
<?php
	$message = "";
    // form is submitted
    if(isset($_POST['submit'])){
        $category = $_POST["category"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $image = "";
        $imageProperties="";
        if (isset($_FILES['image']['tmp_name'])) {
            $file=$_FILES['image']['tmp_name'];
            if(!empty($_FILES['image']['tmp_name'])){
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $imageProperties = getimageSize($_FILES['image']['tmp_name']);
            }
        }
        if (!isset($title) || empty($title)){
            $message = "Please enter title <br />";
            
        }
        else if (!isset($description) || empty($description)){
            $message .= "Please write description<br />";
        }
		else if ($category == 0){
            $message .= "Please Select Category<br />";
        }
        else 
        {
			
            $message = addPost($_SESSION["user_id"], $category, $title, $description, $imageProperties, $image);
			$title = "";
			$description = "";  
        }
    }
    else
    {
		$title = "";
		$description = "";
        $message = "Please fill-in all the fields.";
    }
?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Add Post</title>
        <meta name="description" content="Final Project">
        <link rel="stylesheet" href="css.css">
        
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/agency.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    </head>
        <body>
            <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">Whatchu Got?</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <?php echo $links ?>
                    <li>
                        <a class="page-scroll" href="logout.php">Log-out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header class="aboutpage">
        <div class="container">
            <div class="about-text">
                <div class="body-lead-in"><?php 
    echo $message ;
?></div>
</div>
<form action="addPost.php" method="post" enctype="multipart/form-data" name="addroom">
 Category<br />
 <select name="category" style="color:#000;" size="1">
    <option value="0"></option>
    <option value="1">Textbooks</option>
    <option value="2">Media</option>
    <option value="3">Rentals</option>
    <option value="4">Events / Meetups</option>
    <option value="5">Tutoring</option>
    <option value="6">Electronics</option>
    <option value="7">Jobs</option>
    <option value="8">Furniture</option>
    <option value="9">Services</option>
    <option value="10">Other</option>
 </select><br />
 Title<br />
 <input name="title" type="text" value="<?php echo $title;?>"style="color:#000;"/><br />
 Description<br />
 <textarea class="form-control" name="description" rows="6" cols="50" value=""><?php echo $description;?></textarea><br>
 Select Image: <br />
 <input type="file" name="image"><br /><br />
<button name="submit" type="submit"  style="background-color:#007C87">Submit</button>
</form>     
        </div>
    </header>
          
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>
 </body>
</html>

