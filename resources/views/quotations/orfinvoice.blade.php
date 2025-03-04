<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 20px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .company-logo {
            text-align: right;
        }

        .company-logo-placeholder {
            width: 100px;
            height: 50px;
            background-color: #ccc;
            display: inline-block;
        }

        .quotation-info,
        .client-info,
        .footer-info {
            width: 100%;
            margin-bottom: 20px;
        }

        .quotation-info td,
        .client-info td,
        .products-table td,
        .products-table th,
        .footer-info td {
            padding: 6px;
            border: 1px solid black;
        }

        .bold {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }
        .head-table {
        border-collapse: collapse;
        width: 100%;
    }
    .head-table th,.head-table td {
        border: 1px solid #000;
        padding: 5px;
        text-align: left;
    }

    /* .second-page {
        width: 100%;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .products-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    .products-table th, .products-table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
    }
    .empty-row {
        height: 40px;
    } */
.specif-table{
    width: 100%;
            border-collapse: collapse;
margin-top: 10px;
            table-layout: fixed;
}
.specif-table th {
            background-color: #f2f2f2;
        }

        .specif-table td,
        .specif-table th {
            font-size: 11px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .specif-table td,
        .specif-table th {
            padding: 4px;
            border: 1px solid black;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;

            table-layout: fixed;
        }

        .products-table th {
            background-color: #f2f2f2;
        }

        .products-table td,
        .products-table th {
            font-size: 11px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
        }

        .page-break {
            page-break-before: always;
        }

        /* Ensures 5 pages */
        .quotation-info td,
        .client-info td {
            border: none;
        }

        .black-line {
            border-bottom: 2px solid black;
            margin-bottom: 10px;
        }

        .center-heading {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .footer-line {
            border-top: 2px solid black;
            margin-top: 30px;
            margin-bottom: 10px;
        }



            .footer {
                position: relative;
                bottom: 0;
                width: 100%;
                text-align: center;
                font-size: 12px;
                margin-top: 20px;
            }

            .footer-line {
                border-top: 2px solid black;
                margin-top: 30px;
                margin-bottom: 10px;
            }
            .second-page {
                page-break-before: always;
            }

            @media print {
            /* Default A4 size for all pages */
            @page {
                size: A4 portrait;
                margin: 15mm;
            }

            /* Second Page: A3 Landscape */
            @page second {
                size: A3 landscape;
                margin: 15mm;
            }

            /* Apply A3 layout to the second page */
            .second-page {
                page: second;
                page-break-before: always;
            }
            .third-page {
                page: third;
                page-break-before: always;
            }
            .four-page {
                page: four;
                page-break-before: always;
            }
            .five-page {
                page: five;
                page-break-before: always;
            }
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            border: 1px solid #000;
        }
        .content {
            text-align: justify;
            /* margin-top: 20px; */
            border: 1px solid #000;
            /* border-top:0px; */
        }
        h3 {
            /* border-bottom: 2px solid #000; */
            padding-bottom: 5px;
        }
        ul {
            margin-left: 20px;
        }
        .invoice-header {
            width: 100%;
            border: 2px solid black;
            border-collapse: collapse;
        }
        .invoice-header td {
            padding: 10px;
            vertical-align: middle;
        }
        .left-logo {
            width: 20%;
            text-align: left;
        }
        .center-content {
            width: 60%;
            text-align: center;
            border-left: 2px solid black;
            border-right: 2px solid black;
        }
        .right-logo {
            width: 20%;
            text-align: right;
        }
        .company-details, .gst-details {
            font-size: 14px;
            font-weight: bold;
        }
        .company-details {
            text-align: left;
            padding-left: 10px;
        }
        .gst-details {
            text-align: right;
            padding-right: 10px;
        }
        .bottom-border {
            border-top: 2px solid black;
            padding-top: 5px;
        }
        .invoice-details {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    font-size: 10px;
}

.invoice-details td,
.invoice-details th {
    border: 1px solid #ddd;
    padding: 5px;
    text-align: left;
}

.invoice-details .section-title {
    background-color: #f2f2f2;
    font-weight: bold;
    text-align: center;
}

.invoice-details .bold-text {
    font-weight: bold;
}

.invoice-details tr:nth-child(even) {
    background-color: #f9f9f9;
}

.invoice-details tr:hover {
    background-color: #e6e6e6;
}

.invoice-details td[colspan="3"] {
    font-weight: bold;
}

.invoice-details td:nth-child(1),
.invoice-details td:nth-child(2),
.invoice-details td:nth-child(3),
.invoice-details td:nth-child(4),
.invoice-details td:nth-child(5),
.invoice-details td:nth-child(6) {
    width: 16.66%;
}


    </style>
</head>

<body>


    <div class="second-page">
        <table class="invoice-header">
            <tr>
                <td class="left-logo">
                    {{-- <img src="logo-left.png" alt="Company Logo" width="120"> --}}
                    <h2>Mercuri Industrial Solutions</h2>
                </td>
                <td class="center-content" style="padding: 0;">
                    <div><b>ORDER CONFIRMATION / PROFORMA INVOICE</b></div>
                    <div class="bottom-border">
                        <table width="100%">
                            <tr>
                                <td class="company-details">
                                    Mercuri Industrial Solutions <br>
                                    Sy. No 32, Chandapura, Hosur Road, Bangalore-560099, INDIA
                                </td>
                                <td class="gst-details">
                                    <b>GSTIN:</b> 29AABCM8922D1ZG <br>
                                    <b>State Code:</b> 29
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td class="right-logo">
                    <img src="/assets/images/logom.png" alt="Company Logo" width="80">
                </td>
            </tr>
        </table>
        <table class="invoice-details">
            <tr>
                <td colspan="3" class="section-title">Details of Receiver (Billed to):</td>
                <td colspan="3" class="section-title">Details of Consignee (Shipped to):</td>
            </tr>
            <tr>
                <td colspan="3">
                    <span class="bold-text">M/s. Mercuri Industrial Solutions - 105099</span> <br>
                    Wing 5 Flat 3D, Keyees Samyuktha 7/128 Church Road Valan Nagar, Madambakkam, <br>
                    Chennai-600126, Tamil Nadu, INDIA
                </td>
                <td colspan="3">
                    <span class="bold-text">Mercuri Industrial Solutions-610/44</span> <br>
                    610/44, Muthamakkadu Street, Kollupalayam, Arasur, <br>
                    Coimbatore-641047, Tamil Nadu, INDIA
                </td>
            </tr>
            <tr>
                <td>Phone No:</td>
                <td>Fax No:</td>
                <td>State Name:</td>
                <td>State Code:</td>
                <td>GST No:</td>
                <td>GST No:</td>
            </tr>
            <tr>
                <td>---</td>
                <td>---</td>
                <td>Tamil Nadu</td>
                <td>33</td>
                <td>33BUPXK1095F1ZC</td>
                <td>33BUPXK1095F1ZC</td>
            </tr>
            <tr>
                <td class="section-title">Sale Order No.</td>
                <td class="section-title">Date</td>
                <td class="section-title">Transportation</td>
                <td class="section-title">Customer</td>
                <td class="section-title">Customer PO No</td>
                <td class="section-title">Customer PO Date</td>
            </tr>
            <tr>
                <td>SO242410211</td>
                <td>27-12-2024</td>
                <td>STD / SPL</td>
                <td>Ex-works</td>
                <td>MSIPO24/25/238</td>
                <td>18-12-2024</td>
            </tr>
            <tr>
                <td class="section-title">Shipping Date</td>
                <td class="section-title">Installation</td>
                <td class="section-title">Sales Person</td>
                <td class="section-title">Payment Term</td>
                <td class="section-title">Contact Person</td>
                <td class="section-title">Mob No</td>
            </tr>
            <tr>
                <td>28-Feb-2025</td>
                <td>Not Included</td>
                <td>Alagiri Dinesh Kumar K</td>
                <td>30 Days Credit</td>
                <td>Uday Kumar</td>
                <td>9786688307</td>
            </tr>
        </table>

        <table class="products-table">
            <thead>
                <tr>
                    <th rowspan="2">Sl. No</th>
                    <th rowspan="2">Part No</th>
                    <th rowspan="2">Description of Goods</th>
                    <th rowspan="2">HSN/SAC Code</th>
                    <th rowspan="2">Unit</th>
                    <th rowspan="2">Quantity</th>
                    <th rowspan="2">List Price (INR)</th>
                    <th rowspan="2">Rate Unit (INR)</th>
                    <th rowspan="2">Total Rate (INR)</th>
                    <th colspan="2">CGST</th>
                    <th colspan="2">SGST</th>
                    <th colspan="2">IGST</th>
                    <th rowspan="2">Total + Tax (INR)</th>
                </tr>
                <tr>
                    <th>Rate</th>
                    <th>Amt</th>
                    <th>Rate</th>
                    <th>Amt</th>
                    <th>Rate</th>
                    <th>Amt</th>
                </tr>
            </thead>
            {{-- @dd($quotation->toArray()) --}}
            <tbody>
                {{-- <tr>
                    <td>1</td>
                    <td>50012639</td>
                    <td>MHE,SP-36 STD,FL-1220MM,FW-685MM,SH-90MM,LH-220MM</td>
                    <td>84271000</td>
                    <td>Nos</td>
                    <td>1.00</td>
                    <td>551,971.00</td>
                    <td>551,971.00</td>
                    <td>551,971.00</td>
                    <td>18.0%</td>
                    <td>99,354.78</td>
                    <td>18.0%</td>
                    <td>99,354.78</td>
                    <td>0%</td>
                    <td>0</td>
                    <td>651,325.78</td>
                </tr> --}}
                @php
                    $quoprods = $quotation->toArray();
                    $prod = $quoprods['product'];
                    $i= 1
                @endphp

                {{-- @dd($quoprods['product'])    <!-- Debugging to check the structure --> --}}

                {{-- @foreach($quoprods as $product) --}}
                    <tr>
                        {{-- @dd($prod) --}}
                        <td>{{ $i++}}</td> <!-- Serial number -->
                        <td>{{ $quotation->part_no ?? 'N/A' }}</td>
                        <td>{{ $prod['productdes'] }}</td>  <!-- Description -->
                        <td>{{ $prod['hsn'] }}</td>  <!-- HSN/SAC Code -->
                        <td>{{ $prod['uom'] }}</td>  <!-- Unit -->
                        <td>{{ $quoprods['quanty'] }}</td>  <!-- Quantity -->
                        <td>{{ number_format($prod['rate'], 2) }}</td>  <!-- List Price -->
                        <td>{{ number_format($prod['rate'], 2) }}</td>  <!-- Rate Unit -->
                        <td>{{ number_format($quoprods['lbt'], 2) }}</td>  <!-- Total Rate -->
                        <td></td>  <!-- CGST Rate -->
                        <td></td>  <!-- CGST Amount -->
                        <td></td>  <!-- SGST Rate -->
                        <td></td>  <!-- SGST Amount -->
                        <td>{{ $quoprods['tax'] }}%</td>  <!-- IGST Rate -->
                        <td>{{ number_format($quoprods['taxamt'], 2) }}</td>  <!-- IGST Amount -->
                        <td>{{ number_format($quoprods['grandtotal'], 2) }}</td>  <!-- Total + Tax -->
                    </tr>
                {{-- @endforeach --}}

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let tbody = document.querySelector(".products-table tbody");
                        let rowCount = tbody.rows.length;
                        let minRows = 12; // Adjust based on how much space you need to fill

                        while (rowCount < minRows) {
                            let emptyRow = document.createElement("tr");
                            emptyRow.classList.add("empty-row");
                            for (let i = 0; i < 16; i++) {
                                let td = document.createElement("td");
                                td.innerHTML = "&nbsp;";
                                emptyRow.appendChild(td);
                            }
                            tbody.appendChild(emptyRow);
                            rowCount++;
                        }
                    });
                </script>
            </tbody>
        </table>
        <table class="products-table">
            @php
            use NumberToWords\NumberToWords;

            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $grandTotal = $quoprods['grandtotal'];
            $grandTotalInWords = ucfirst($numberTransformer->toWords($grandTotal)) . ' only';
            @endphp

            <tr>
                <td colspan="6"><b></td>
                <td colspan="2"><b>Total</td>
                <td colspan="1" style="text-align: right;">{{ number_format($quoprods['lbt'], 2) }}</td>
                <td colspan="2" style="text-align: right;"></td>
                <td colspan="2" style="text-align: right;"></td>
                <td colspan="2" style="text-align: right;">{{ number_format($quoprods['taxamt'], 2) }}</td>
                <td colspan="1" style="text-align: right;">{{ number_format($quoprods['grandtotal'], 2) }}</td>
            </tr>
            <tr>
                <td colspan="8"><b>Total Quotation Value (In Words):</b> {{ $grandTotalInWords }}</td>
                <td colspan="8" style="text-align: center;border-bottom: none;padding-bottom: 0px;"><b>For MAINI MATERIALS MOVEMENT PVT. LTD.,</b></td>
            </tr>
            <tr>
                <td colspan="8"><b>Payment Terms:</b> 100% advance</td>
                <td colspan="8" style="border-top: none;border-bottom: none;"></td>
            </tr>
            {{-- <tr>
                <td colspan="8"><b>Price:</b> Ex works Mercuri Industrial Solutions</td>
                <td colspan="8"><b>Standard Warranty:</b> 12 Months or 2000 Hrs from the date of commissioning whichever is earlier</td>
            </tr>
            <tr>
                <td colspan="8"><b>Despatch:</b> 6 weeks from the date of receipt of PO and advance whichever is later</td>
                <td colspan="8" style="border-bottom: none;padding-bottom: 0px;"><b>Essential Documents : Purchase order, Advance payment, E-Way bill if required, Declaration form, </b></td>
            </tr>
            <tr>
                <td colspan="8"><b>Unloading Scope:</b> Customer</td>
                <td colspan="8" style="border-top: none;padding-top: 0px;"><b>any other statutory
                    exemption documents( 100% EOU unit, SEZ, concessional GST etc.)</b></td>
            </tr> --}}
            {{-- <tr>
                <td rowspan="2"><b>Unloading Scope:</b> Customer</td>
            </tr> --}}
            <tr>
                <td colspan="7"><b>Our Bankers are : Kotak Mahindra Bank, Account Number : 9411742790, IFSC Code : KKBK0000422,
                    Swift Code : KKB000958</b></td>
                    <td colspan="1">E&O, E.,</td>
                    <td colspan="8" style="text-align: center;border-top: none;padding-top: 0px;"><b>Authorised Signatory</b></td>
            </tr>
            <tr>
                <td colspan="8"><b>Mercuri Industrial Solutions</b></td>
                <td colspan="8" style="text-wrap: unset;">For Instant Service & Support - Call Toll Free @ 1800 102 9877 or write to us at mercuri.com
                    Please mention our reference number in all correspondence/communication
                    </td>

            </tr>
            <tr>
                <td colspan="16"><b>Mercuri Industrial Solutions. Correspondence Address:</b> Mercuri Industrial
                    Solutions(Mercuriis)-Chennai,Tamil Nadu, INDIA.</td>

            </tr>
        </table>

    </div>





</body>

</html>
