<?php
require_once('../setup/fpdf.php');
if(isset($_GET['param'])){
$iduser = $_GET['userid'];
}else{
header('location:../404.php');
}


$pdf = new FPDF('L','mm','Letter');
$pdf->SetMargins(5,3);
$pdf->AddPage();

//header
$pdf->SetDrawColor(255,0,0);
$pdf->SetY(10);
$pdf->SetFont('Arial','I',8);
$pdf->Cell(0,5,'Page '.$pdf->PageNo(),0,0,'R');

$pdf->Ln(10);

require_once('../connectdb.php');

$theday = mysqli_query($conn,"Select * from hari order by id_hari ASC");
while($hari = mysqli_fetch_array($theday)){
$idhari = $hari['id_hari'];
$pdf->SetDrawColor(255,0,0);
$pdf->SetTextColor(255,000,000);
$pdf->SetFont('Arial','B','12');
$pdf->Cell(0,8,$hari['hari'],'B',0,'L');
$pdf->Ln();

$pdf->SetDrawColor(0,0,255);
//title table
$pdf->SetTextColor(0x00,0x00,0x00);
$pdf->Cell(30,8,'Ruang','B',0,'L');
$pdf->Cell(35,8,'Jurusan','B',0,'L');
$pdf->Cell(10,8,'Jam','B',0,'C');
$pdf->Cell(30,8,'KodeMK','B',0,'C');
$pdf->Cell(85,8,'Mata Kuliah','B',0,'L');
$pdf->Cell(65,8,'Pengampu','B',0,'L');
$pdf->Cell(5,8,'Kelas','B',0,'C');

$pdf->Ln();

                $thequery = mysqli_query($conn,"Select * From jadwal_full, hari, matkul, kelas, ruangan, fakultas, jurusan, users Where jadwal_full.id_hari=hari.id_hari && jadwal_full.id_matkul=matkul.id_matkul && jadwal_full.id_kelas=kelas.id_kelas && jadwal_full.id_ruang=ruangan.id_ruang && jadwal_full.id_fak=fakultas.id_fak && jadwal_full.id_jur=jurusan.id_jur && jadwal_full.id_user=users.id_user && jadwal_full.id_user='$iduser' && jadwal_full.id_hari = '$idhari' order by hari.id_hari ASC ");
        $pdf->SetFont('Arial','','11');
                while($data = mysqli_fetch_array($thequery)){
                $pdf->Cell(30,8,$data['nama_ruang'],0,0,'L');
                $pdf->Cell(35,8,$data['nama_jurusan'],0,0,'L');
                $pdf->Cell(10,8,$data['jamkelas'],0,0,'C');
                $pdf->Cell(30,8,$data['kode_matkul'],0,0,'C');
                $pdf->Cell(85,8,$data['nama_matkul'],0,0,'L');
                $pdf->Cell(65,8,$data['nama'],0,0,'L');
                $pdf->Cell(5,8,$data['kelas'].'/'.$data['semester'],0,0,'C');
                $pdf->Ln();
                }
        $pdf->Ln();
}
 $pdf->Output('Jadwal Kuliah Dosen.pdf','I');
 

?>