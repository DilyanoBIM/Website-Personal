<?php
require 'fpdf/fpdf.php';

// Tangkap data dari URL
$nama_barang = $_GET['nama_barang'];
$harga_barang = $_GET['harga_barang'];
$foto_barang = $_GET['foto_barang'];

// Membuat PDF
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Detail Barang', 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(40, 10, 'Nama Barang:');
$pdf->Cell(0, 10, $nama_barang, 0, 1);

$pdf->Cell(40, 10, 'Harga Barang:');
$pdf->Cell(0, 10, $harga_barang, 0, 1);

// Menambahkan gambar
$pdf->Cell(40, 10, 'Foto Barang:');
$pdf->Ln(10);
$pdf->Image($foto_barang, $pdf->GetX(), $pdf->GetY(), 60);
$pdf->Ln(60);

$pdf->Output('D', 'detail_barang.pdf');
?>
