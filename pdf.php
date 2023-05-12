<?php
if(!empty($_POST['save']))
{
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $user=$_POST['user'];
  $email=$_POST['email'];

  require("fpdf/fpdf.php");
  $pdf= new FPDF();
  $pdf->AddPage();
  $pdf->SetFont("arial","",12);
  $pdf->Cell(0,10,"User Detail",1,1,"C");
  $pdf->Cell(45,10,"First Name",1,0);
  $pdf->Cell(45,10,"Last Name",1,0);
  $pdf->Cell(45,10,"User Name",1,0);
  $pdf->Cell(0,10,"Email",1,1);

  $pdf->Cell(45,10,$fname,1,0);
  $pdf->Cell(45,10,$lname,1,0);
  $pdf->Cell(45,10,$user,1,0);
  $pdf->Cell(0,10,$email,1,1);



  $pdf->output();
}


 ?>
