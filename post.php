<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
  <title>ADD USER</title>
  <script src="resources/ckeditor/ckeditor.js"></script>
</head>
<body>
  <!-- header -->
  
  <div class="auth-content">
    <form action="post.php" method="post" enctype="multipart/form-data" >
      <h3 class="form-title">Add Username</h3>
      <!-- <div class="msg error">
        <li>Username required</li>
      </div> -->
      <div class="input-group">
            <label>Title</label>
            <input type="text" name="txtTitle"  class="text-input">
          </div>
          <div class="input-group">
            <label>Body</label>
            
            <textarea class="text-input" name="txtBody"  id="content-body"></textarea>
          </div>
          <input type="hidden" name="size" value="1000000"> 
        <input type="file" name="image"> 
      <div>
        <button type="submit" name="btnRegister" class="btn">Add</button>
      </div>
      
    </form>
    <?php
    include("assets/conn/dbconnect.php");
    if(isset($_POST["btnRegister"])){
        $title=$_POST["txtTitle"];
        $body=$_POST["txtBody"];
        $image = $_FILES['image']['name'];
        $target = "assets/img/".basename($image);
        if(empty($title) || empty($body) ){
            echo "Bạn vui lòng nhập thông tin";
        }
        else{
            


          $sql = "INSERT INTO post(postTitle,postBody,postImg) VALUES ('$title','$body','$image')";
          mysqli_query($con,$sql);
          if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo '<script language="javascript">alert("Đã upload thành công!");</script>';
            }else{
            echo '<script language="javascript">alert("Đã upload thất bại!");</script>';
            } 
        }
    }
    ?>
  </div>
  <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('content-body');
        </script>
  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="scripts.js"></script>
</body>
</html>
