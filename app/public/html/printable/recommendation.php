<?php
// Include TCPDF library
require_once __DIR__ . '/../../tcpdf/tcpdf.php';

session_start();
class CustomTCPDF extends TCPDF {
    // Override the default header method
    public function Header() {
        // Do nothing to remove the header
    }
}

$pdf = new CustomTCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Disciplinary Committee');
$pdf->SetTitle('Recommendation Letter');

// Path to your external HTML and CSS files
$htmlFile = __DIR__ . '/../../documents/recommendation.html'; // Adjust the path to your HTML file
$cssFile = __DIR__ . '/../../documents/recommendation.css';  // Adjust the path to your CSS file

// Get the content of the CSS file
$cssContent = file_get_contents($cssFile);

// Combine CSS and HTML
$cssStyle = '<style>' . $cssContent . '</style>';

// Sample array of student names
$students = $_SESSION['students_list'];
$currentDate = date('j F Y');
// Iterate over each student
foreach ($students as $student) {
    // Add a page
    $pdf->AddPage();

    // Get the content of the HTML file
    $htmlContent = file_get_contents($htmlFile);

    // Replace placeholder with student name
    $htmlContent = str_replace('{{student_name}}', $student['student_name'], $htmlContent);
    $htmlContent = str_replace('[Date]', $currentDate, $htmlContent);
    // Replace image path
    $imagePath = __DIR__ . '/../../documents/nu_logo/nu_logo.png';
    $htmlContent = str_replace('nu_logo/nu_logo.png', $imagePath, $htmlContent);

    // Combine CSS and HTML
    $fullHTML = $cssStyle . $htmlContent;

    // Write the combined HTML with CSS to the PDF
    $pdf->writeHTML($fullHTML, true, false, true, false, '');
}

// Output the PDF
$pdf->Output('Recommendation_letter.pdf', 'I'); // 'I' for inline display, 'D' for download
?>