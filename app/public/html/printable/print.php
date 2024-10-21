<?php
// Include TCPDF library
require_once __DIR__ . '/../../tcpdf/tcpdf.php';

session_start();
// Create new PDF document

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
$pdf->SetTitle('Violation Slip');

// Path to your external HTML and CSS files
$htmlFile = __DIR__ . '/../../documents/print.html'; // Adjust the path to your HTML file
$cssFile = __DIR__ . '/../../documents/print.css';  // Adjust the path to your CSS file

// Get the content of the CSS file
$cssContent = file_get_contents($cssFile);

// Combine CSS and HTML
$cssStyle = '<style>' . $cssContent . '</style>';

// Sample array of student names
$students = $_SESSION['students_list'];
$currentDate = date('j F Y');
$violationString = $_SESSION['violationString'] ?? '';
$offense = $_SESSION['offense'] ?? '';
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Iterate over each student
foreach ($students as $student) {
    // Add a page
    $pdf->AddPage();

    // Set the background image
    $imagePath = __DIR__ . '/../../documents/images/aaafds.jpg';
    $pdf->Image($imagePath, 10, 9, 55, 50, '', '', '', false, 300, '', false, false,0);

    $ndImage = __DIR__ . '/../../documents/nu_logo/nu_logo.png';
    $pdf->Image($ndImage, 120, 13, 80, 40, '', '', '', false, 300, '', false, false,0);

    // Get the content of the HTML file
    $htmlContent = file_get_contents($htmlFile);

    // Replace placeholder with student details
    $htmlContent = str_replace('[Name]', $student['student_name'], $htmlContent);
    $htmlContent = str_replace('[StudentID]', $student['student_id'], $htmlContent);
    $htmlContent = str_replace('[Course]', $student['course'], $htmlContent);
    $htmlContent = str_replace('[Section]', $student['section'], $htmlContent);
    $htmlContent = str_replace('[Violation]', $violationString, $htmlContent);
    $htmlContent = str_replace('[Date]', $currentDate, $htmlContent);
    $htmlContent = str_replace('[Offense]', $offense, $htmlContent);

    // Combine CSS and HTML
    $fullHTML = $cssStyle . $htmlContent;

    // Write the combined HTML with CSS to the PDF
    $pdf->writeHTML($fullHTML, true, false, true, false, '');
}

// Output the PDF
$pdf->Output('Violation_Slip.pdf', 'I'); // 'I' for inline display, 'D' for download
?>