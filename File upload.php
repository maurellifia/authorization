<?php

if($_SERVER['REQUEST_METHOD']== "POST"){
    $email = $_POST['email'];
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Invalid Email Format!";
    }

    if(isset($_POST['submit'])){
        $extension = strtolower(pathinfo($_FILES["Files"]["name"], PATHINFO_EXTENSION));
        if($extension=='.jpg' || $extension=='.jpeg' || $extension=='.png'){
            $pdo = new PDO('mysql:host=localhost; dbname=upload', 'root');
            $stmt = $pdo->prepare("INSERT INTO upload(email, files) VALUES (?, ?)");
            $stmt->execute([$email, $_FILES["files"]["name"]]); 
        }
        else{
            echo "Please Upload JPG or PNG Only!";
        }
    }
    echo "Upload Successfull!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UploadFile</title>
</head>
<body>
<form action ="" method="POST" enctype= "multipart/form-data">
        <h1> Upload File and Add Email here</h1>

        <p>Input your email here</p>
        <input type="email" name="email" placeholder="Enter your email" required/>
        <br>
        <br>
        <label>Select file to upload (JPEG or PNG)</label>
        <input type="file" name="files" accept=".jpeg, .png, .jpg" required />
        <br>
        <br>
        <input type="submit" value="Sumbit"/>
    </form>
</body>
</html>
