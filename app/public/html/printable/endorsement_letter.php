<?php
// Include TCPDF library
require_once __DIR__ . '/../../tcpdf/tcpdf.php';

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Disciplinary Committee');
$pdf->SetTitle('Endorsement Letter');

// Add a page
$pdf->AddPage();

// Path to your external HTML and CSS files
$htmlFile = __DIR__ . '/../../documents/endorsement.html'; // Adjust the path to your HTML file
$cssFile = __DIR__ . '/../../documents/endorsement.css';  // Adjust the path to your CSS file



// Get the content of the HTML file
$htmlContent = file_get_contents($htmlFile);

$imagePath = __DIR__ . '/../../documents/nu_logo/nu_logo.png';
$htmlContent = str_replace('nu_logo/nu_logo.png', $imagePath, $htmlContent);

// Get the content of the CSS file
$cssContent = file_get_contents($cssFile);

// Combine CSS and HTML
$fullHTML = '<style>' . $cssContent . '</style>' . $htmlContent;

// Write the combined HTML with CSS to the PDF
$pdf->writeHTML($fullHTML, true, false, true, false, '');

// Output the PDF
$pdf->Output('Endorsement_letter.pdf', 'I'); // 'I' for inline display, 'D' for download
?>