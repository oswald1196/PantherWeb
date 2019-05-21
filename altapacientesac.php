
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Panther :: Alta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />

    <link rel="stylesheet" href="assets/css/ace-fonts.css" />

    <link rel="stylesheet" href="assets/css/ace.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="assets/css/estilos.css" />



  
  

<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="altapaciente/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="altapaciente/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="altapaciente/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="altapaciente/vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="altapaciente/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="altapaciente/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="altapaciente/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="altapaciente/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="altapaciente/css/util.css">
  <link rel="stylesheet" type="text/css" href="altapaciente/css/main.css">
<!--===============================================================================================-->




</head>
<body class="login-layout" background="assets/img/astronomy-dark-evening-957061.jpg" style="height: auto; width: auto;">
  
<?php
  include('header.php');
?>

<div class="container">
  <h3 style="color: white; font-size: 40px;">Alta de pacientes</h3>
  <!--:v->
  <p>Use the .navbar-form class to vertically align form elements (same padding as links) inside the navbar.</p>
  <!-:v-->
</div>

<!--Capa transparente y centrado-->
    <div class="container-contact100">	
<!--Capa transparente y centrado-->  

    <div class="wrap-contact100">
      
 
            <!--:v-->
      <div class="contact100-form-title" style="background-image: url(assets/img/bg-02.jpg);">
        <span>Paciente</span>
      </div>
            <!--:v-->
      <center> 
      <form class="contact100-form validate-form">
        <div class="wrap-input100 validate-input">
          <input id="name" class="input100" type="text" name="name" placeholder="Nombre">
          <span class="focus-input100"></span>
          <label class="label-input100" for="name">
            <span class="lnr lnr-user m-b-2"></span>
          </label>
        </div>





<article class="main-content">
        <div class="form-group">
    <label></label>
    <input value="Rick" class="input-control" />

    <label class="right-inline"></label>
    <input value="Strahl" class="input-control" />
  </div>

</article>

<!--:v->
        <style>
  * {
   box-sizing: border-box; 
  }
  .myForm {
    display: flex;
    background-color: beige;
    border-radius: 3px;
    padding: 1.8em;
  }
  .message {
   	margin-right: 4em; 
    display: flex;
    flex-direction: column;
  }
  .message > textarea {
   flex: -1; 
   min-width: 49em;
  }
  .contact {
   	flex: 1; 
  }
  .contact input {
    width: 100%;
  }
  .contact input,
  .contact button {
    padding: 1em;
    margin-bottom: 1em;
  }
</style>

<form class="myForm">
  <div class="message">
    <label for="msg">Message</label>
    <textarea id="msg"></textarea>
  </div>
  <div class="contact">
    <label for="name">Name</label>
    <input class="input100" type="text" id="name">
    <span class="focus-input100"></span>
    <label class="label-input100" for="name">
            <span class="lnr lnr-user m-b-2"></span>
          </label>
  </div>
</form>
<!-:V-->

        <form class="contact100-form validate-form">
        <div class="wrap-input100 validate-input">
          <input id="name" class="input100" type="text" name="name" placeholder="Nombre">
          <span class="focus-input100"></span>
          <label class="label-input100" for="name">
            <span class="lnr lnr-user m-b-2"></span>
          </label>
        </div>
 
        





<style>
/*the container must be positioned relative:*/
.custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element:*/
}

.select-selected {
  background-color: DodgerBlue;
}

/*style the arrow inside the select element:*/
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/*point the arrow upwards when the select box is open (active):*/
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/*style the items (options), including the selected item:*/
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
  user-select: none;
}

/*style items (options):*/
.select-items {
  position: absolute;
  background-color: DodgerBlue;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/*hide the items when the select box is closed:*/
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}
</style>


<div class="custom-select" style="width:100%;">
  <select>
    <option value="0">Select car:</option>
    <option value="1">Audi</option>
    <option value="2">BMW</option>
    <option value="3">Citroen</option>
    <option value="4">Ford</option>
    <option value="5">Honda</option>
    <option value="6">Jaguar</option>
    <option value="7">Land Rover</option>
    <option value="8">Mercedes</option>
    <option value="9">Mini</option>
    <option value="10">Nissan</option>
    <option value="11">Toyota</option>
    <option value="12">Volvo</option>
  </select>
</div>



<script>
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>

   








        <div class="wrap-input100 validate-input">
          <input id="email" class="input100" type="text" name="email" placeholder="Eg. example@email.com">
          <span class="focus-input100"></span>
          <label class="label-input100" for="email">
            <span class="lnr lnr-envelope m-b-5"></span>
          </label>
        </div>


        <div class="wrap-input100 validate-input">
          <input id="phone" class="input100" type="text" name="phone" placeholder="Eg. +1 800 000000">
          <span class="focus-input100"></span>
          <label class="label-input100" for="phone">
            <span class="lnr lnr-smartphone m-b-2"></span>
          </label>
        </div>


        <div class="wrap-input100 validate-input">
          <textarea id="message" class="input100" name="message" placeholder="Your comments..."></textarea>
          <span class="focus-input100"></span>
          <label class="label-input100 rs1" for="message">
            <span class="lnr lnr-bubble"></span>
          </label>
        </div>

        <div class="container-contact100-form-btn">
          <button class="contact100-form-btn">
            Send Now
          </button>
        </div>
      </form>
    </div>
  </div>
   </center>





  <!--===============================================================================================-->
  <script src="altapaciente/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="altapaciente/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="altapaciente/vendor/bootstrap/js/popper.js"></script>
  <script src="altapaciente/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="altapaciente/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="altapaciente/vendor/daterangepicker/moment.min.js"></script>
  <script src="altapaciente/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="altapaciente/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="altapaciente/js/main.js"></script>

</body>
</html>

