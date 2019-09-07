<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<title>Portfolio</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}


.uploadbutton {
    background-color: #4CAF50; 
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1; 
    padding-top: 100px; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
}

.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 250px;
  background-color: #fff;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

.sidebar a:hover {
  background-image: linear-gradient(#5f0ef9, #0c23f0);
  opacity:0.7;
  color: white;
}

div.content {
  margin-left: 250px;
  padding: 1px 16px;
  height: 1000px;
}

div.gallery {
    border: 1px solid #ccc;
}

div.gallery:hover {
    border: 1px solid #777;
}

div.gallery {
    width: 100%;
    height: auto;
}
img{
	width: 100%;
	overflow: hidden;
}

div.desc {
    padding: 15px;
    text-align: center;
}

* {
    box-sizing: border-box;
}

.responsive {
    padding: 0 6px;
    float: left;
    width: 24.99999%;
}

.clearfix:after {
    content: "";
    display: table;
    clear: both;
}

.main {
    max-width: 1000px;
    margin: auto;
}

h1 {
    font-size: 50px;
    word-break: break-all;
}

.row {
    margin: 10px -16px;
}

.column {
    padding: 0 6px;
    float: left;
    width: 100%;
    display: none;
}

.show {
  display: block;
}

.btn {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: white;
  cursor: pointer;
}

.btn:hover {
  background-color: #ddd;
}

.btn.active {
  background-color: #666;
  color: white;
}

@media screen and (max-width: 700px) {
	.responsive {
        width: 49.99999%;
        margin: 6px 0;
    }
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 500px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
  .responsive {
        width: 100%;
    }
}
</style>

<body>

<!-- Sidebar/menu
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <h4><b>PORTFOLIO</b></h4>
  </div>
  <div class="w3-bar-block">
    <a href="#portfolio" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>EDIT</a> 
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>UPLOAD</a> 
  </div>
</nav>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#explorediv").hide();
		});
		$(document).ready(function(){
			$('#explore').on("click", function(){
				$("#portfoliodiv").hide();
				$("#explorediv").show();
			});
		});
		$(document).ready(function(){
			$('#portfolio').on("click", function(){
				$("#explorediv").hide();
				$("#portfoliodiv").show();
			});
		});
	</script>

<div class="sidebar">
  <a href="" id="portfolio">PORTFOLIO</a>
  <a href="editor.html">EDIT</a>
  <a href="#" id="uploadButton">UPLOAD</a>
  <a href="#" id="explore">EXPLORE</a>
  <a href="logout.php" id="explore">LOGOUT</a>
</div>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form name="frmImage" enctype="multipart/form-data" action="uploadimage.php"	
        method="post" class="frmImageUpload">
        <label>Upload Image File:</label><br> <br>
		<input name="userImage" type="file" onchange="readURL(this);"><br>
		<img src="" id="uploadimg" name="uploadimage" style="width:40%;"><br>
		<div class="custom-select" style="width:200px;">
		  <select name="hashtag">
			<option value="none">None</option>
			<option value="travel">#travel</option>
			<option value="food">#food</option>
			<option value="wildlife">#wildlife</option>
		  </select>
		</div>
		<input type="submit" value="Submit" class="uploadbutton">
    </form>
  </div>
</div>

<div class="content" id="portfoliodiv">
  <header>
    <div>
    <h1><b>My Portfolio</b></h1>
    </div>
  </header>
<?php
	
    require_once "db.php";
	if(isset($_SESSION['userid'])){
	$userid = $_SESSION['userid'];
    $sql = "SELECT id, hashtag FROM image where user_id='$userid' ORDER BY id DESC"; 
    $result = mysqli_query($conn, $sql);
	
?>

  <?php
	while($row = mysqli_fetch_array($result)) {
	?>
  <div class="responsive">
  <div class="gallery">
    <a target="_blank" href="imageView.php?image_id=<?php echo $row["id"]; ?>">
		<img src="imageView.php?image_id=<?php echo $row["id"]; ?>" >
    </a>
    <div class="desc"><?php echo $row["hashtag"]; ?></div>
  </div>
</div>
<?php		
	}
	}
	mysqli_close($conn);
?>
 </div>
 
 <div class="main content" id="explorediv">

<div id="myBtnContainer">
  <button class="btn active" onclick="filterSelection('all')"> Show all</button>
  <button class="btn" onclick="filterSelection('travel')"> Travel</button>
  <button class="btn" onclick="filterSelection('food')"> Food</button>
  <button class="btn" onclick="filterSelection('wildlife')"> Wildlife</button>
</div>

<div class="row">
<?php
	$conn = mysqli_connect("localhost", "root", "", "test");
    $sql = "SELECT id, hashtag FROM image ORDER BY id DESC"; 
    $result = mysqli_query($conn, $sql);
?>
  <?php
	while($row = mysqli_fetch_array($result)) {
		
	?>
  <div class="column <?php echo $row["hashtag"]; ?>">
    <div>
      <a target="_blank" href="imageView.php?image_id=<?php echo $row["id"]; ?>">
      <img style="width:50%;" src="imageView.php?image_id=<?php echo $row["id"]; ?>" >
    </a>
    </div>
	 </div>
	<?php		
	}
    mysqli_close($conn);
?>
</div>
</div>

  <script>
var modal = document.getElementById('myModal');
var btn = document.getElementById("uploadButton");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
				function readURL(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();

						reader.onload = function (e) {
							$('#uploadimg').attr('src', e.target.result);
						};
						reader.readAsDataURL(input.files[0]);
					}
				}
				
function logoutfunc() {
    if (confirm("Comfirm Logout?")) {
        window.location.assign("index.html");
    }
    document.getElementById("demo").innerHTML = txt;
}
</script>
<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
</body>
</html>