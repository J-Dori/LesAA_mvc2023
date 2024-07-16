<?php
// Include autoloader
//require ROOT_DIR . '/vendor/autoload.php';

// Reference the Dompdf namespace
use Dompdf\Dompdf;

// Instantiate and use the dompdf class
$dompdf = new Dompdf();


$html='
<style>
    table {
        font-family: arial;
        width:400px;
        border-collapse: collapse;
    }
    td, th {
        border: 1px solid black;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: grey;
    }
</style>
<h1>Welcome to api.template</h1>
<h3>List of Registered users </h3>
<table>
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Date of Birth</th>
        <th>Country</th>
    </tr>
    <tr>
        <td>Caroline White</td>
        <td>50</td>
        <td>20-12-1960</td>
        <td>Germany</td>
    </tr>
    <tr>
        <td>Jane Dutch</td>
        <td>35</td>
        <td>20-12-1978</td>
        <td>Kenya</td>
    </tr>

</table>

';
// Load HTML content
$dompdf->loadHtml($html);

// (Optional) Set up the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();


// Output the generated PDF to Browser
ob_end_clean();
$dompdf->stream('revenus_par_categorie.pdf');
