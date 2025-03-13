<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 800px;
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 {
            color: #1b5583;
        }
        .vendor-shipto {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .section-title {
            background-color: #1b5583;
            color: white;
            padding: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #1b5583;
            color: white;
        }
        .order-table td {
            height: 25px;
        }
        .total-section {
            width: 300px;
            border: 1px solid black;
            margin-top: 10px;
            background-color: #F1F1F1;
        }
        .total-section table {
            width: 100%;
            border: none;
        }
        .total-section td {
            border: none;
            text-align: right;
            padding: 8px;
        }
        .total-section tr:first-child td {
            border-top: 1px solid black;
        }
        .total-section tr:last-child td {
            background-color: #1b5583;
            color: white;
            font-weight: bold;
        }
        .comments {
            width: 50%;
            height: 150px;
            border: 1px solid black;
            margin-top: 20px;
            padding: 10px;
            background-color: #F1F1F1;
        }
        .footer-text {
            text-align: center;
            margin-top: 10px;
            font-size: 12px;
        }
        .page-break {
            page-break-before: always;
        }
        .terms-conditions {
            padding: 20px;
            border: 1px solid #000;
            background-color: #F1F1F1;
            height: 90vh;
        }
        .terms-conditions h3 {
            background-color: #1b5583;
            color: white;
            padding: 10px;
        }
        .terms-conditions p {
            margin: 10px 0;
            line-height: 1.5;
        }
        .upload-section {
            height: 90vh;
            padding: 20px;
            border: 1px solid #000;
            background-color: #F1F1F1;
        }
        .upload-section h3 {
            background-color: #1b5583;
            color: white;
            padding: 10px;
        }
        .uploaded-file {
            margin-top: 15px;
        }
        iframe, embed {
            width: 100%;
            height: 700px;
            border: 1px solid #ccc;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <img src="assets/images/logom.png" alt="" width="80"><br>
                {{-- <strong>[Company Name]</strong><br> --}}
                [Street Address]<br>
                [City, ST ZIP]<br>
                Phone: (000) 000-0000<br>
                Fax: (000) 000-0000<br>
                Website
            </div>
            <div>
                <h2>PURCHASE ORDER</h2>
                <p><strong>Date:</strong> 9/17/2015</p>
                <p><strong>PO #</strong> [123456]</p>
            </div>
        </div>
        <div class="vendor-shipto">
            <div style="width: 30%;">
                <div class="section-title">VENDOR</div>
                [Company Name] <br>
                [Contact or Department] <br>
                [Street Address] <br>
                [City, ST ZIP] <br>
                Phone: (000) 000-0000 <br>
                Fax: (000) 000-0000
            </div>
            <div style="width: 30%;">
                <div class="section-title">SHIP TO</div>
                [Name] <br>
                [Company Name] <br>
                [Street Address] <br>
                [City, ST ZIP] <br>
                [Phone]
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>REQUISITIONER</th>
                    <th>SHIP VIA</th>
                    <th>F.O.B.</th>
                    <th>SHIPPING TERMS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="invoice-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>ITEM #</th>
                        <th>DESCRIPTION</th>
                        <th>QTY</th>
                        <th>UNIT PRICE</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Wire Decking</td>
                        <td class="description">Product XYZ</td>
                        <td>20</td>
                        <td>₹2,200</td>
                        <td style="text-align: right;">₹44,000.00</td>
                    </tr>
                    <tr>
                        <td>Base Plates</td>
                        <td class="description">Product ABC</td>
                        <td>30</td>
                        <td>₹1,200</td>
                        <td style="text-align: right;">₹36,000.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>


                </tbody>
            </table>

        <div style="display: flex;justify-content:space-between;">
        <div class="comments">
            <strong>Comments or Special Instructions</strong>
        </div>

        <div class="total-section">
            <table>
                <tr>
                    <td style="text-align: left;">SUBTOTAL</td>
                    <td>₹80,000.00</td>
                </tr>
                <tr>
                    <td style="text-align: left;">TAX</td>
                    <td>₹14,400</td>
                </tr>
                <tr>
                    <td style="text-align: left;">SHIPPING</td>
                    <td>₹1,000</td>
                </tr>
                <tr>
                    <td style="text-align: left;">TOTAL</td>
                    <td>₹95,400.00</td>
                </tr>
            </table>
        </div>
        </div>

        <div class="footer-text">
            If you have any questions about this purchase order, please contact <br>
            [Name, Phone #, Email]
        </div>

    </div>
    </div>

    <div class="page-break"></div>
    <div class="container terms-conditions">
        <h3>Terms and Conditions</h3>
        <p>1. Payment is due within 30 days from the invoice date.</p>
        <p>2. All products remain the property of the company until full payment is received.</p>
        <p>3. Any discrepancies must be reported within 7 days of delivery.</p>
        <p>4. Late payments may incur additional charges.</p>
        <p>5. All returns are subject to prior approval and a restocking fee.</p>
    </div>
    <div class="footer-text">
        If you have any questions about this purchase order, please contact <br>
        [Name, Phone #, Email]
    </div>
    <div class="page-break"></div>
    <div class="container upload-section">
        <h3>Uploaded Documents / Images</h3>

        <!-- For Images -->
        <div class="uploaded-file">
            <strong>Image Upload:</strong><br>
            <img src="assets/uploads/sample-image.jpg" alt="Uploaded Image">
        </div>

        <!-- For PDF Files -->
        <div class="uploaded-file">
            <strong>PDF Upload:</strong><br>
            <iframe src="/assets/images/1740635578_attcuspo_MERCURI.PDF#toolbar=0&navpanes=0&scrollbar=0"
            frameborder="0"
            style="width: 100%; height: 600px;"></iframe>
        </div>

        <!-- For Word Documents -->
        <div class="uploaded-file">
            <strong>Word Document Upload:</strong><br>
            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=http://127.0.0.1:8000/assets/images/1741866198_drawing_Square%20Tech%20Interio%20intro.docx"
            frameborder="0"
            style="width: 100%; height: 600px;">
        </iframe>
        </div>

    </div>

    <div class="footer-text">
        If you have any questions about this purchase order, please contact <br>
        [Name, Phone #, Email]
    </div>

</body>
</html>
