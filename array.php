<?php

setcookie("user","jane",time()+86400 );

//
$fruits= array("Apples"=>5.80,
                "Oranges"=>8.40,
                "Pineapples"=>10.10,
                "Mangoes"=>6.50,
                "Durians"=>25.00);

function sumBasket($fruits){
    $total=0;
    foreach($fruits as $key=> $value){
        $total+= $value;
    }
    return sprintf("%0.2f",$total );
}
        $total = sumBasket($fruits);
                echo "Total Price : RM " . $total;

echo'<br><br>';




if($_SERVER['REQUEST_METHOD']=='POST'){
    $fname=isset($_POST['fname']) ? $_POST['fname'] : "";
    $lname=isset($_POST['lname']) ? $_POST['lname'] : "";
$email2=isset($_POST['email2']) ? $_POST['email2'] : "";
    
}


if(empty($email2)){
$emailError2= true;
}









var_dump($_COOKIE);
print_r($_COOKIE);

$Campus = array("JH"=>"Johor",
                "KL"=>"Kuala Lumpur",
                "PH"=>"Pahang",
                "PR"=>"Perak",
                "SB"=>"Sabah"
);

krsort($Campus);

echo "<ul>";
foreach($Campus as $key => $value){
    echo "<li>";
    echo "$value($key), ";
    echo $value=='Kuala Lumpur' ? 'Main Campus' : 'Branch Campus';
    
}
echo "</ul>";

if($_SERVER['REQUEST_METHOD']=='POST'){
$name=isset($_POST['name']) ? $_POST['name'] : "";
$email=isset($_POST['email']) ? $_POST['email'] : "";

if(empty($name)){
$nameError= true;
}

if(empty($email)){
$emailError= true;
}
}



$cardId = "030300141195";



echo "Born in Johor ? : ".  checkJohorBirthPlace($cardId);



 function checkJohorBirthPlace($cardId){
    

if($cardId[6] == '0' && $cardId[7] == '1'){
    
   return true;
}else if ($cardId[6] == '2' && ($cardId[7] >= 1 && $cardId[7]<= 4) ){
    return true;
}else{
    return false;
}


}


//if(date('H') >= 12){
//    echo "Happy Day";
//}else{
//    echo "Good Day";
//}



echo date('H') >= 12 ? "Happy Day" : "Good Day";

$car = array(
    0=> array(
        "Company"=>"Oxford",
        "Type"=>"Viral vector",
        "Doses"=>2,
        "Storage"=>"Regular fridge tempature"
    ),
      1=> array(
        "Company"=>"Pfizer",
        "Type"=>"Viral vector",
        "Doses"=>2,
        "Storage"=>"Regular fridge tempature"
    )
    
    
);

echo $car[1]['Company'];

  ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
<script
src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.mi
n.js"></script>
<script src="jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="../../js.js"/>
</head>
<body>

<form id="ff" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
Name: <input type="text" name="name" value="<?php  if (isset($name)) echo $name ?>">
<?php
if(isset($nameError)){
    echo "<span class='error'>";
    echo "Name cant be blank!! </span>";
}
?>
<br>


Email: <input type="email" name="email" value="<?php  if (isset($email)) echo $email ?>">
<?php
if(isset($emailError)){
    echo "<span class='error'>";
    echo "Email cant be blank!! </span>";
}
?>
<br>


<input type="submit" name="submit">
</form>

<form method="post" action="array.php">
    
<h2>Member Application </h2>
<h3>First Name:<input type="text" name="fname"></h3>
<h3>Last Name:<input type="text" name="lname"></h3>
<h3>E-mail:<input type="email" name="email2"></h3>
<?php
if(isset($emailError2)){
    echo "<span class='error'>";
    echo "Email cant be blank!! </span>";
}
?>

<input type="submit" value="Submit My Application">
</form>
<br>
<br>

<h2>Ordered List</h2>
<ol>
<li>List item 1</li>
<li>List item 2</li>
<li>List item 3</li>

</ol>

<input type="submit" class="remove" value="Remove last item in the list">
<input type="submit" class="setbg" value="Set background-color of ordered list">

<script>
    
    $('.remove').click(function(){
        $('ol').children().last().remove();
    });
    
    $('.setbg').click(function(){
        $('ol').css("background-color", "cyan");
    });
    
    </script>




    

</body>
</html>
