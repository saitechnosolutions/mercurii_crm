<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        th,
        td {
            border: 1px solid black;
            padding: 8px;
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
            padding: 20px;
            border: 1px solid #000;
            background-color: #F1F1F1;
            height: 90vh;
        }

        .upload-section h3 {
            background-color: #1b5583;
            color: white;
            padding: 10px;
        }

        .uploaded-file {
            margin-top: 15px;
        }

        iframe,
        embed {
            height: 90vh;
            width: 100%;
            border: 1px solid #ccc;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
@php
    $invoiceDate = $poDetails->created_at;
    $invoiceNo = $poDetails->po_no;
@endphp

<body>
    <div class="container">
        <div class="header">
            <div>
                <img src="/assets/images/logom.png" alt="" width="80"><br>
                <strong>MERCURI INDUSTRIAL SOLUTIONS</strong><br>
                <p>
                    Wing 5 Flat 3D, Kgeyes Samyuktha,<br>
                    771/2B Church Road Valan Nagar,<br>
                    Madambakkam, Kanchipuram-600126<br>
                    GSTIN/UIN: 33BUXPK1095F1ZC<br>
                    kathir@mercuriis.com<br>
                </p>
            </div>
            <div>
                <h2>PURCHASE ORDER</h2>
                <p><strong>Date:</strong>{{ date("d-m-Y", strtotime($invoiceDate)) }}</p>
                <p><strong>PO #</strong> {{ $invoiceNo }}</p>
            </div>
        </div>
        @php
            $city = App\Models\Citylist::where('id', $poDetails->vendorDetails->city_id)->first();
            $state = App\Models\Statelist::where('id', $poDetails->vendorDetails->state_id)->first();
        @endphp
        <div class="vendor-shipto">
            <div style="width: 30%;">
                <div class="section-title" style="margin-bottom: 10px">VENDOR</div>
                <strong>{{ $poDetails->vendorDetails->company_name }},</strong> <br>
                <p>
                    {{ $poDetails->vendorDetails->address }}, <br>
                    {{ $city->city_name }} - {{ $state->state }}, <br>
                </p>

            </div>
            <div style="width: 30%;">
                <div class="section-title" style="margin-bottom: 10px">SHIP TO</div>
                <strong>MERCURI INDUSTRIAL SOLUTIONS</strong> <br>
                No 89 Balaji Nagar, Athancherry village, <br>
                Padappai, Chennai - 601301, <br>
                Tamil Nadu
            </div>
        </div>

        <div class="invoice-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>ITEMS</th>
                        <th>HSN</th>
                        <th>QTY</th>
                        <th>Rate</th>
                        <th>GST(%)</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $poDetails->productDetails->productname }}</td>
                        <td class="description">{{ $poDetails->productDetails->hsn }}</td>
                        <td>{{ $poDetails->product_qty }}</td>
                        <td>₹{{ $poDetails->productDetails->rate }}</td>
                        <td>{{ (int) $poDetails->productDetails->gst }}</td>
                        <td style="text-align: right;">₹{{ $poDetails->total_amount }}</td>
                    </tr>
                    <tr>
                        <td></td>
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
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
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
                        <td></td>
                    </tr>


                </tbody>
            </table>

            <div style="display: flex;justify-content:space-between;">
                <div class="comments">
                    <strong>Comments or Special Instructions</strong>
                    <p style="font-size: 16px">
                        <strong>Note:</strong> P.O.No & Date Should Be Mentioned In the
                        Invoice And the invoice should accompany the
                        supplies.Supplier has to acknowledge the receipt of
                        the Order of signature with Seal
                    </p>
                </div>

                @php
                    $gstAmt = ($poDetails->productDetails->rate / 100) * $poDetails->productDetails->gst;
                    $subTotal = $poDetails->productDetails->rate * $poDetails->product_qty;
                    $totalAmt = number_format($subTotal + $gstAmt, 2);
                @endphp

                <div class="total-section">
                    <table>
                        <tr>
                            <td style="text-align: left;">SUBTOTAL</td>
                            <td>₹{{ number_format($subTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">TAX</td>
                            <td>₹{{ $gstAmt }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">TOTAL</td>
                            <td>₹{{ $totalAmt }}</td>
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
    @if (!empty($poDetails->termsConditionDetails->content))
        <div class="container terms-conditions">
            <h3>Terms and Conditions</h3>
            {{ $poDetails->termsConditionDetails->content }}
        </div>
    @endif

    <div class="footer-text">

    </div>
    <div class="page-break"></div>
    @php
        if ($poDetails->files != null) {
            $fileName = explode('.', $poDetails->files);
            $extension = end($fileName);
        } else {
            $extension = null;
        }

    @endphp
    @if (!empty($extension))
        <div class="container upload-section">
            <h3>Uploaded Documents / Images</h3>

            @if ($extension == "jpg" || $extension == "jpeg" || $extension == "png")
                <!-- For Images -->
                <div class="uploaded-file">
                    <strong>Image Upload:</strong><br>
                    <img src="/assets/images/pallet_rack.webp" alt="">
                </div>
            @endif

            @if ($extension == "pdf")
                <!-- For PDF Files -->
                <div class="uploaded-file">
                    <strong>PDF Upload:</strong><br>
                    <iframe src="/uploads/1742366763_po_AnnexureA.PDF#toolbar=0&navpanes=0&scrollbar=0" frameborder="0"></iframe>
                </div>
            @endif

            @if ($extension == "docx")
                <!-- For Word Documents -->
                <div class="uploaded-file">
                    <strong>Word Document Upload:</strong><br>
                    <iframe
                        src="https://view.officeapps.live.com/op/embed.aspx?src=/assets/images/1742367672_po_Partner Page - STS_250222_130506.docx"
                        frameborder="0">
                    </iframe>
                </div>
            @endif

        </div>
    @endif
    

    <div class="footer-text">

    </div>

</body>

</html>