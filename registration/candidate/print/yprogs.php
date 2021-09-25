<?php
require('fpdf.php');
include '../../../db.php';

class PDF extends FPDF
{
function Header()
{
	// Logo
//	$this->Image('pad.jpg',0,0,210);
//	// New font
//	
//	// Line break
//	$this->Ln(50);
//	// set header
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
if(isset($_GET['pcode'])){
	$pcode = $_GET['pcode'];
}
$sql_seltitle = "SELECT c.*,p.p_name, p.p_code,p.p_kind,u.place FROM candidate_reg c INNER JOIN programmes p ON c.prog_code = p.p_code INNER JOIN users AS u ON c.author = u.username WHERE p.p_code = '$pcode' ORDER BY c.candidate_code";
$run_seltitle = mysqli_query($connect, $sql_seltitle);
while($row1 = mysqli_fetch_assoc($run_seltitle)){
	$title = $row1['p_name'];
	$code = $row1['p_code'];
	$category = $row1['category'];
	$filename = $code.'.pdf';
	$pkind = $row1['p_kind'];
}
// programme title, code, category
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(13,10,$code,1,0,'C');
	$pdf->Cell(30,10,$title,1,0,'C');
	$pdf->Cell(19,10,$category,1,0,'C');
// Title common including chest,ug,name
	
	$pdf->Cell(5,10,'',0,0,'C');
// second
	// programme title, code, category
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(13,10,$code,1,0,'C');
	$pdf->Cell(30,10,$title,1,0,'C');
	$pdf->Cell(19,10,$category,1,0,'C');

	$pdf->Cell(5,10,'',0,0,'C');

	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(13,10,$code,1,0,'C');
	$pdf->Cell(30,10,$title,1,0,'C');
	$pdf->Cell(19,10,$category,1,1,'C');
// Title common including chest,ug,name
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(5,10,'',1,0,'C');
	$pdf->Cell(30,10,'Chest No',1,0,'C');
	$pdf->Cell(27,10,'Mark',1,0,'C');

	$pdf->Cell(5,10,'',0,0,'C');	
//third
// programme title, code, category
	
// Title common including chest,ug,name
	$pdf->Cell(5,10,'',1,0,'C');
	$pdf->Cell(30,10,'Chest No',1,0,'C');
	$pdf->Cell(27,10,'Mark',1,0,'C');

	$pdf->Cell(5,10,'',0,0,'C');	

	$pdf->Cell(5,10,'',1,0,'C');
	$pdf->Cell(30,10,'Chest No',1,0,'C');
	$pdf->Cell(27,10,'Mark',1,1,'C');

	

//splitting as individual and group

	$sql_selprog = "SELECT c.*,p.p_name,u.place FROM candidate_reg c INNER JOIN programmes p ON c.prog_code = p.p_code INNER JOIN users AS u ON c.author = u.username WHERE p.p_code = '$pcode' ORDER BY c.code_letter";
	$run_selprog = mysqli_query($connect, $sql_selprog);
	$i = 1;
	$pdf->SetFont('Arial','',9);
	while($row = mysqli_fetch_assoc($run_selprog)){
		$ug = strtoupper(preg_replace('/@.*/', '', $row['author']));
		$pdf->Cell(5,8,$i,1,0, 'C');
		$pdf->Cell(30,8,$row['candidate_code'],1,0);
		$pdf->Cell(27,8,'',1,0);
		
		$pdf->Cell(5,8,'',0,0);
		
		$pdf->Cell(5,8,$i,1,0, 'C');
		$pdf->Cell(30,8,$row['candidate_code'],1,0);
		$pdf->Cell(27,8,'',1,0);
		
		$pdf->Cell(5,8,'',0,0);
		
		$pdf->Cell(5,8,$i,1,0, 'C');
		$pdf->Cell(30,8,$row['candidate_code'],1,0);
		$pdf->Cell(27,8,'',1,1);
		$i++;
	}
		$pdf->Ln(20);
		$pdf ->Cell(43,10,'Name',0,0,'');
		$pdf ->Cell(25,10,'',0,0,'');
		$pdf ->Cell(43,10,'Name',0,0,'');
		$pdf ->Cell(25,10,'',0,0,'');
		$pdf ->Cell(43,10,'Name',0,1,'');
		
		$pdf ->Cell(43,10,'Sign',0,0,'');
		$pdf ->Cell(25,10,'',0,0,'');
		$pdf ->Cell(43,10,'Sign',0,0,'');
		$pdf ->Cell(25,10,'',0,0,'');
		$pdf ->Cell(43,10,'Sign',0,1,'');
	
mysqli_close($connect);
$pdf->Output('D', $filename);
?>
