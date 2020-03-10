<!DOCTYPE html>
<html>
  <head >
    <title>حسابات التطبيقات</title>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <style type="text/css">
      
  
    </style>
    <link rel="icon" href="logo.jpg">
  </head>
  <?php require("auth.php");
   include("connection.php");
   ?>
  <body dir="rtl" >
    <nav class="navbar navbar-expand-lg nav-dark" style="background-color: #3b588e; color: white;" >
  <a class="navbar-brand" href="index.php">PMS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
    <span class="navbar-toggler-icon "style="background-color: black" ></span>
  </button>
   <?php if($_SESSION['typee']==1 ||($_SESSION['typee']==2 )){ ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">الرئيسية <span></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sales.php">مبيعات</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="journal.php">الحسابات</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Portion.php">الحصص</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        أكثر
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="customer.php">زبائن</a>
          <a class="dropdown-item" href="user.php">مستخدم</a>
          <a class="dropdown-item" href="salereport.php">تقارير</a>
          </div>
          
      </li>
      <li class="nav-item navbar-left" >
        <a class="nav-link" href="Logout.php">تسجيل خروج</a>
      </li>
    </ul>
    
  </div>
<?php } if($_SESSION['typee']==3 ){?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">الرئيسية <span></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="saleRep.php">تقرير المبيعات</a>
      </li>
      
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        تقرير الزبائن
         
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="customerreport.php">الزبائن المسجلين</a>
          <a class="dropdown-item" href="customerpaymentRep.php">	دفعات الزبائن</a>
          
          </div>
          
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        	تقرير المستخدمين
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="partnerwithRep.php">سحب المستخدم</a>
          <a class="dropdown-item" href="jparmentRep.php">	دفعات الشركاء</a>
          <a class="dropdown-item" href="jincomeRep.php">ورادات الشركاء</a>
          
          </div>
          
      </li>
      <li class="nav-item navbar-left" >
        <a class="nav-link" href="Logout.php">تسجيل خروج</a>
      </li>
    </ul>
    
  </div>
<?php } ?>
</li>
      
</nav>