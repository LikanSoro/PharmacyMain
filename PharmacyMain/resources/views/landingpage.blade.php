<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        <style>
@import url('https://fonts.googleapis.com/css?family=Slabo+27px');



body {
  margin: 0;
  padding: 0;
  height: 100vh;
  width: 100%;
  font-family: 'Slabo 27px', serif;
}  
@keyframes slideUp {
  0%{height: 0vh; }
  50% {height: 100vh; bottom:0;}
  100% {bottom: 100vh;}
}
body:before {
  content:'';
  height: 0vh;
  width: 100vw;
  background-color: #AA5D9B;
  position:absolute;
  bottom:0;
  z-index: 100;  
  animation-name: slideUp;
  animation-duration: 1s;
}
@keyframes slideUp2 {
  0%{height: 100vh; } 
  50% {height: 100vh; bottom:0;}
  100% {bottom: 100vh;}
}
body:after {
  content:'';
  height: 0vh;
  width: 100vw;
  background-color: white;
  position:absolute;
  bottom:0;
  z-index: 90;  
  animation-name: slideUp2;
  animation-duration: 1s;
}
.bigbox {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  position: relative;
  align-items: center;
  z-index: 5;
  overflow: hidden;
}
@keyframes slideIn {
  0%{right: -800px; }
  50%{right: -800px; }
  100% {right: -600px;}
}
.bigbox:after {
  content: '';
  height: 1200px;
  width: 1200px;
  background-color: #AA5D9B;
  position: absolute;
  z-index: -1;
  border-radius: 1200px;
  right: -600px;
  top: -80px;
  animation-name: slideIn;
  animation-duration: 2s;
}

.nav {
  height: 100px;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
}

.navContain {
  width: 1200px;
  height: 30%;
  display: flex;
  justify-content: space-between;
}

.logo {
  font-weight: 900;
  font-family: sans-serif;
  color: #333;
  font-size: 20px;
  line-height: 30px;
}

.menu {
  height: 100%;
  width: 20px;
  background-color:;
  display: flex;
  flex-direction: column;
  justify-content: center; 
}
.menu:before, .menu:after {
  content: '';
  width: 100%;
  height: 2px;
  margin-bottom: 4px;
  background-color: #333;
}
 
.contentContain {
  width: 1200px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 100%;
}

.titleBox {
 
}
@keyframes shrink {
  
  0%   {height: 100vh; width: 100vw; right: 0;}
    55%  {height: 100vh; width: 100vw; right: 0;}
    100% {height: 80vh; width: 700px; right: calc(calc(100vw - 1200px) / 2);}
}
 
.imgBox {
  position: absolute;
  height: 80vh; width: 700px; right: calc(calc(100vw - 1200px) / 2);
  animation-name: shrink;
  animation-duration: 1.5s;
  
}
.imgBox img {
      width: 100%;
      height: 100%;
      /* object-fit: cover; */
      border-radius: 30px;
      /* opacity: 2; */
      /* box-shadow: 0 0 0 50px white inset; */
    }

.mainTitle {
    font-weight: 900;
  font-family: sans-serif;
  color: #333;
  font-size: 25px;
}
.btn-submit {
      display: none;
    }
    .btn-submit {
      display: inline-block;
      padding: 20px 30px;
      background-color: #f2f2f2;
      color: #ffffff;
      font-weight: 600;
      border-radius: 30px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn-submit:hover {
      background-color: #d546a3f1;
      color: #fff;
    }
    .btn-submit {
  border: none; /* Remove the button border */
  background-color: #ff50bca9; /* Set the button color */
}


.btn-register {
      display: none;
    }
    .btn-register {
      display: inline-block;
      margin-top: 5px;
      padding: 20px 30px;
      background-color: #f2f2f2;
      color: #ffffff;
      font-weight: 600;
      border-radius: 30px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn-register:hover {
      background-color: #d546a3f1;
      color: #fff;
    }
    .btn-register {
  border: none; /* Remove the button border */
  background-color: #ff50bca9; /* Set the button color */
}


    </style>
</head>
<body>
    <div class="bigbox">
        <div class="nav">
          <div class="navContain">
            <div class="logo">MyPharma.</div>
          </div>
        </div>
        <div class="contentContain">
          <div class="titleBox">
            <h1 class="mainTitle">
                Effortlessly Manage your Pharmacy <br>
                With Our System
            </h1>
            <div class="mt-3 mb-4">
                <a href={{url('login')}}><button type="submit" class="btn-submit" id="submit">LOGIN</button></a>
              </div>
              <div class="mt-6">
                <a href="{{route('register')}}"><button type="submit" class="btn-register" id="register">REGISTER</button></a>
              </div>
          </div>
          <div class="imgBox">
            <img src="/images/landingImage.jpg"> 
          </div>
        </div>
      </div>
</body>

</html>