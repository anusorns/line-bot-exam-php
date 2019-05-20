<html>
<head>
<link rel="icon" href="favicon.png">
<title>Food Order</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=0.3">
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<!-- <body background="../img/bg2.jpg"> -->
<!-- <img src='./food_bg.jpg' style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;'> -->
<style>
body{
padding: 0 2em;
  font-family: Montserrat, sans-serif;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  color: #000;
  #background: #CF5339;
  background:#FFFFFF;
  
}

h1 {
  font-weight: normal;
  letter-spacing: -1px;
  color: #ffffff;
}

h2 {
  font-weight: normal;
  letter-spacing: -1px;
  color: #ffffff;
}

h3 { 
    display: block;
    font-size: 1.3em;
    margin-top: 0.75em;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
    font-weight: normal;
}


h4 { 
    display: block;
    font-size: 1em;
    margin-top: 0;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
    font-weight: normal;
    color: #080191;
}


h6 {
   font-weight: normal;
   letter-spacing: -1px;
   color: #FFFFFF; 
   font-size: 18px;
   font: normal 18px Arial, Helvetica, Clean, sans-serif;
}

#tbgrid{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    color:white;
    width: 20%;
}

#tbgrid td, #tbgrid th {
    border: 1px solid #ddd;
    padding: 8px;
}

#tbgrid tr:nth-child(even){background-color: #808080;}

#tbgrid tr:nth-child(odd){background-color: #404040;}

#tbgrid tr:hover {background-color: #191919;}

#tbgrid th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #9e2938;
    color: white;
}

p {
    text-shadow: 3px 3px 5px black;
    font-size: 120%;
}

#combo_poby{
width: 8%;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-position: 10px 10px; 
    padding: 8px;
    padding-left: 15px;
    padding-right: 15px;
}
#funkystyling {

</style>
</body>
</html>


<?php
#echo '<center><img src=../img/ck-st.png>';
#echo "<h3><center><br><p>รายการที่สั่ง</h3>";
require_once("./connect.php");
echo "<p align='right'><a href='./index.php'style='color:white'>Home</a>"; 

$conn = conn_db();
$jd = cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
$tomorrow = jddayofweek($jd + 1,1); # plus 1 for tomorrow

if ($tomorrow == 'Saturday')
{
  $tomorrow = jddayofweek($jd + 3,1);
}
if ($tomorrow == 'Sunday')
{
  $tomorrow = jddayofweek($jd + 2,1);
}


switch ($tomorrow) {
    case "Monday":
       $k = 0;
        break;
    case "Tuesday":
        $k = 1;
        break;
    case "Wednesday":
        $k = 2;
        break;
    case "Thursday":
        $k = 3;
        break;
    case "Friday":
        $k = 4;
        break;
    case "Saturday":
        $k = 5;
        break;
    
}
#$fcur = $m;
#$ip = $_GET['ip'];
$ip = $_SERVER['REMOTE_ADDR'];       

#print ("This is :" . $ip);
echo '<form action="make_order.php">';
$sql_f = "SELECT description,pict FROM food_menu WHERE Ordinary ='$k'";

#echo "<br>" . $sql_f;

$result1 = $conn->query($sql_f);
$num_rows = mysql_num_rows($result1);
#echo "This is count = " . $num_rows;
while($row1 = $result1->fetch_assoc())
 {
  $food = $row1['description'];
 $pict = $row1['pict'];
 }
 
echo "<div class='zoom'>";
echo "<center><img src='http://jvckst.com/lunch/". $pict ."' width='300' height='200'></div>";
echo "<h3><center><p>" . $food . "</h3>";

/*
if (substr($ip,0,3) == "172")
{
$sql = "SELECT name FROM user_food WHERE outside = 'N'";
}else{
  $sql = "SELECT name FROM user_food WHERE outside = 'Y'";
}
*/
$sql = "SELECT name FROM user_food ORDER BY name ASC";
$result = $conn->query($sql);
echo '<center><select name="order_by" id="combo_poby">' .
             '<option value="">ผู้สั่ง *</option>';
                while($row = $result->fetch_assoc())
                  {
                    echo '<option value=' .  $row['name'] . '>' .  $row['name'] . '</option>'; 
                  }
                    echo '</select>';

echo '<select name="amount_order" id="combo_poby">' .
    '<option value="0">ยกเลิก Order</option>' . 
    '<option value="1" selected>1 ชุด</option>' . 
    '<option value="2">2 ชุด</option>' . 
    '<option value="3">3 ชุด</option>' . 
    '<option value="4">4 ชุด</option>' . 
    '<option value="5">5 ชุด</option>' .   
    '<option value="6">6 ชุด</option>' .
    '<option value="7">7 ชุด</option>' .
    '<option value="8">8 ชุด</option>' .
    '<option value="9">9 ชุด</option>' .
    '<option value="10">10 ชุด</option>' .         
    '</option></select>';


?>
<input type="hidden" name="food" value="<?php echo $food; ?>">
<input type="hidden" name="ip" value="<?php echo $ip; ?>">
<br><input type="image" src="order_1.png" alt="Order">
<?php
/*
 $usr = $_POST['order_by'];
 if ($usr = ''){
 	$message = "You not seclect Name:";
echo "<script type='text/javascript'>alert('$message');</script>";
 }
*/
 ?>
</form>

<?php
echo "<h3><center><p>รายชื่อผู้สั่ง</h3>";
#echo "<form action ='./update_attach.php' method='POST' enctype='multipart/form-data' accept-charset='UTF-8'>";
echo '<p><Center><table id="tbgrid" border="1" cellpadding="5px" cellspacing="3px" style="font-family:Montserrat, sans-serif; font-size:.7em,border-radius: .2em;border-radius: .2em;overflow: hidden; width="100%">
            <col style="width:5%">
            <col style="width:1%">
            
            
            
            <th>ผู้สั่ง</th>
            
            <th>ชุด</th>
        
            </tr>';
$sql1 = "SELECT * FROM food_order where DATE(time_order) = CURDATE()";
$result1 = $conn->query($sql1);

while($row1 = $result1->fetch_assoc())
{
  
  echo "<td>" . $row1['user'] . "</td>";
  echo "<td>" . $row1['total'] . "</td>";
  echo "<tr>";
 }
 echo "</tr>";
 echo "</table>";



 echo "<br><br.<center><img src='./Qr_krungthai.jpg' height='128' width='128'><br>";
 echo "<h4><p>เพื่อความสะดวก หากต้องการชำระเงินผ่าน QR Code<br>";
 echo "Line id: automodx  รบกวนส่งสลิปด้วยนะครับ";
 ?>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>



