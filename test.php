<?php
include_once("config.php");
$date = date("Y-m-d");
?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
</head>


<style>
body {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'arial', sans-serif;
  background: #eeeeee;
}
.wrapper {
  max-width: 560px;
  margin: 100px auto;
}
label {
  position: relative;
  display: block;
}
label > input {
  position: relative;
  background-color: transparent;
  border: none;
  border-bottom: 1px solid #9e9e9e;
  border-radius: 0;
  outline: none;
  height: 45px;
  width: 100%;
  font-size: 16px;
  margin: 0 0 30px 0;
  padding: 0;
  box-shadow: none;
  box-sizing: content-box;
  transition: all .3s;
}
label > input:valid + span {
  transform: translateY(-25px) scale(0.8);
  transform-origin: 0;
}
label > input:valid {
  border-bottom: 1px solid #3F51B5;
  box-shadow: 0 1px 0 0 #3F51B5;
}
label > span {
  color: #9e9e9e;
  position: absolute;
  top: 0;
  left: 0;
  font-size: 16px;
  cursor: text;
  transition: .2s ease-out;
}
label > input:focus + span {
  transform: translateY(-25px) scale(0.8);
  transform-origin: 0;
  color: #3F51B5;
}
label > input:focus {
  border-bottom: 1px solid #3F51B5;
  box-shadow: 0 1px 0 0 #3F51B5;
}

</style>



<body>

<div class="wrapper">
  <label>
    <input type="text" required="required"/>
    <span>Name</span>
  </label>
  
  <label>
<!--     <input data-provide="datepicker" required="required"> -->
    <input type="text" class="dateselect" required="required"/>
    <span>Date</span>
  </label>
  
  <label>
    <input type="text" class="dateselect2" required="required"/>
    <span>Date</span>
  </label>
</div>


</body>

<script>
  $('.dateselect').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});


</script>


</html>

