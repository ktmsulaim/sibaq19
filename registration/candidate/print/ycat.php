<?php
require('fpdf.php');
include '../../../db.php';

class PDF extends FPDF
{
function Header()
{
	// Logo
	$this->Image('pad.jpg',0,0,210);
	// New font
	
	// Line break
	$this->Ln(50);
	// set header
}

function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Text color in gray
	$this->SetTextColor(128);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}

$pdf = new PDF();
$title = '';
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->SetAuthor('DHIU');
$pdf->SetFillColor(255,255,255);
$pdf->SetDrawColor(0,0,0);

$zonec = '';
$pcode = '';
if(isset($_GET['print'])){
	$zonec = $_GET['zone'];
	$pcode = $_GET['prog'];
}
$sql_seltitle = "SELECT c.*,p.p_name, p.p_code, u.zone FROM candidate_reg c INNER JOIN programmes p ON c.prog_code = p.p_code INNER JOIN users AS u ON c.author = u.username WHERE u.zone = '$zonec' AND p.p_code = '$pcode' ORDER BY c.candidate_code";
$run_seltitle = mysqli_query($connect, $sql_seltitle);
while($row1 = mysqli_fetch_assoc($run_seltitle)){
	$title = $row1['p_name'];
	$code = $row1['p_code'];
	$category = $row1['category'];
	$zone = 'Zone : '.$row1['zone'];
	$filename = $code.'-'.$zone;
}
// programme title, code, category
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(189,10,$zone,'',1,'R');
	$pdf->Ln(5);
	$pdf->Cell(43,10,$code,1,0,'C');
	$pdf->Cell(83,10,$title,1,0,'C');
	$pdf->Cell(63,10,$category,1,1,'C');
// Title common including chest,ug,name
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(15,10,'Sl.no',1,0,'C');
	$pdf->Cell(28,10,'Code Ltr',1,0,'C');
	$pdf->Cell(63,10,'Candidate Name',1,0,'C');
	$pdf->Cell(20,10,'Chest No',1,0,'C');
	$pdf->Cell(43,10,'Institution',1,0,'C');
	$pdf->Cell(20,10,'Sign',1,1,'C');
$sql_selprog = "SELECT c.*,p.p_name,u.place FROM candidate_reg c INNER JOIN programmes p ON c.prog_code = p.p_code INNER JOIN users AS u ON c.author = u.username WHERE u.zone = '$zonec' AND p.p_code = '$pcode' ORDER BY c.candidate_code";
$run_selprog = mysqli_query($connect, $sql_selprog);
$i = 1;
$pdf->SetFont('Arial','',9);
while($row = mysqli_fetch_assoc($run_selprog)){
	$ug = strtoupper(preg_replace('/@.*/', '', $row['author'])) . ', '.$row['place'];
	$pdf->Cell(15,10,$i,1,0);
	$pdf->Cell(28,10,$row['code_letter'],1,0);
	$pdf->Cell(63,10,$row['candidate_name'],1,0);
	$pdf->Cell(20,10,$row['candidate_code'],1,0);
	$pdf->Cell(43,10,$ug,1,0);
	$pdf->Cell(20,10,'',1,1);
	
	$i++;
}
mysqli_close($connect);
$pdf->Output('D',$filename);
?>
