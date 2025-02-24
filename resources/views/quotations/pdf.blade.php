<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation</title>
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
            padding: 8px;
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

    </style>
</head>

<body>

    <!-- Header Section -->
    <div class="header">
        <table width="100%">
            <tr>
                <td class="text-left">
                    <h2>Mercuri Industrial Solutions</h2>
                </td>
                <td class="company-logo"><img src="/assets/images/logom.png" width="100px"></td>
            </tr>
        </table>
    </div>

    <!-- Black Line -->
    <div class="black-line"></div>

    <!-- Center Heading -->
    <div class="center-heading">Techno Commercial Proposal</div>

    <!-- Quotation & Client Info -->
    <table class="quotation-info">
        <tr>
            <td><b>Quotation Reference Number:</b>{{ $quotation->quotationno ?? 'N/A' }}</td>
            <td class="text-right"><b>Date:</b> {{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-Y') }}
            </td>
        </tr>
    </table>

    <table class="client-info">
        <tr>
            <td><b>{{ $quotation->lead->LeadName ?? 'N/A' }}</b></td>
        </tr>
        <tr>
            <td>{{ $quotation->lead->billaddress ?? 'Address not available' }}</td>
        </tr>
        <tr>
            <td>Kind Attn:{{ $quotation->lead->contactname ?? 'N/A' }}</td>
        </tr>
    </table>

    <!-- Subject -->
    <h3>Subject: Techno Commercial Offer</h3>
    <p>Dear Madam,</p>
    <p>We thank you for your expression of interest in our products. </p>
    <p>In furtherance, we are pleased to submit our detailed Techno-Commercial Proposal for the supply of embedded
        products.
        Please feel free to reach out in case of any clarification. We look forward to serving you.
    </p>
    <p>We trust the details are in order. In the event you require any clarification on same, we shall be glad to be of
        assistance. We
        look forward to an opportunity to meet you and present our products and solutions.
    </p>
    <p>Thanking you and assuring you of our best services.</p>
    <p>Your Sincerely, <br> <b>Mercuri Industrial Solutions</b></p>

    <p><b>{{ $quotation->lead->assignedUser->name ?? 'N/A' }}</b><br>
        Territory Sales Manager<br>
        +91 1234567890
    </p>

    <h4>Enclosures:</h4>
    <ol>
        <li>Commercial Offer</li>
        <li>Technical Details</li>
        <li>General Terms and Conditions</li>
    </ol>

    <!-- Footer Line -->
    <div class="footer-line"></div>

    <!-- Footer -->
    <div class="footer">
        <p style="margin: 0;font-size: 11px;">Mercuri Industrial Solutions. Correspondence Address: Mercuri Industrial
            Solutions(Mercuriis)-Chennai,Tamil Nadu, INDIA.</p>
        {{-- <p style="margin: 0;font-size: 11px;">Phone: +91 8043526565, Fax: +91 8043526580, Regd. Office: MainiSadan, No.38, Lavelle Road, 7th Cross, Bangalore-560 001,</p> --}}
        <p style="margin: 0;font-size: 11px;">Email: Mercuri@gmail.com, Website: <a
                href="http://www.meruriis.com">www.mercuriis.com</a></p>
        <p style="margin: 0;font-size: 11px;">CIN: U60231KA1984PTC006017, PAN: AABCM8922D</p>
    </div>
    {{-- <div class="page-break"></div> --}}

    <div class="second-page">
        <table width="100%" class="head-table" >
            <tr>
                <td width="20%" style="border: 1px solid #000;">
                    <h2>Mercuri Industrial Solutions</h2>
                </td>
                <td width="60%" style="border: 1px solid #000;text-align: center;">
                    <h2>Commercial Offer</h2>
                    <p>GST No: 29AABCM9822D1ZG</p>
                </td>
                <td width="20%" style="border: 1px solid #000;text-align: right;" >

                    <img src="/assets/images/logom.png" alt="Company Logo" width="80">
                </td>
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
                <td colspan="8"><b>Total Quotation Value (In Words):</b> {{ $grandTotalInWords }}</td>
                <td colspan="1" style="text-align: right;">{{ number_format($quoprods['lbt'], 2) }}</td>
                <td colspan="2" style="text-align: right;"></td>
                <td colspan="2" style="text-align: right;"></td>
                <td colspan="2" style="text-align: right;">{{ number_format($quoprods['taxamt'], 2) }}</td>
                <td colspan="1" style="text-align: right;">{{ number_format($quoprods['grandtotal'], 2) }}</td>
            </tr>
            <tr>
                <td colspan="16"><b>Payment Terms:</b> 100% advance</td>
            </tr>
            <tr>
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
            </tr>
            {{-- <tr>
                <td rowspan="2"><b>Unloading Scope:</b> Customer</td>
            </tr> --}}
            <tr>
                <td colspan="8"><b>Our Bankers are : Kotak Mahindra Bank, Account Number : 9411742790, IFSC Code : KKBK0000422,
                    Swift Code : KKB000958</b></td>
                    <td colspan="8">Refer clause 1.4 of General Terms & Conditions for payments based on installation/commissioning</td>
            </tr>
            <tr>
                <td colspan="16"><b>Mercuri Industrial Solutions. Correspondence Address:</b> Mercuri Industrial
                    Solutions(Mercuriis)-Chennai,Tamil Nadu, INDIA.</td>

            </tr>
        </table>

    </div>

    <div class="third-page">
        <div class="header">
            <table width="100%">
                <tr>
                    <td class="text-left">
                        <h2>Mercuri Industrial Solutions</h2>
                    </td>
                    <td class="company-logo"><img src="/assets/images/logom.png" width="100px"></td>
                </tr>
            </table>
        </div>
        <div class="center-heading">Technical Specification</div>
        <div class="">50012639 - MHE,SP-36 STD,FL-1220MMX,FW-685MM,SH-90MM,LH-220MM</div>
        <table class="specif-table">
            <tr>
                <td >Description</td>
                <td >Unit</td>
                <td>Specification</td>
            </tr>
            <tr>
                <td >Capacity</td>
                <td >kg</td>
                <td>3600</td>
            </tr>
            <tr>
                <td >Pump Motor  </td>
                <td >V/kW</td>
                <td>24/2</td>
            </tr>
            <tr>
                <td >Drive Motor
                </td>
                <td >kW</td>
                <td>1.5</td>
            </tr>
            <tr>
                <td >Max. Travel Speed Laden  </td>
                <td >km/h</td>
                <td>4.5</td>
            </tr>
            <tr>
                <td >Max. Travel Speed UNladen  </td>
                <td >km/h</td>
                <td>5.5</td>
            </tr>
            <tr>
                <td >Gradeability Laden
                </td>
                <td >%</td>
                <td>5</td>
            </tr>
            <tr>
                <td >Gradeability UNladen
                </td>
                <td >%</td>
                <td>10</td>
            </tr>
            <tr>
                <td >Lifting Speed Laden
                </td>
                <td >m/s</td>
                <td>0.04</td>
            </tr>
            <tr>
                <td >Lifting Speed Unladen
                </td>
                <td >m/s</td>
                <td>0.05</td>
            </tr>
            <tr>
                <td >Lowering Speed Laden
                </td>
                <td >m/s</td>
                <td>0.02</td>
            </tr>
            <tr>
                <td >Lowering Speed Unladen
                </td>
                <td >m/s</td>
                <td>0.006</td>
            </tr>
            <tr>
                <td >Battery Type
                </td>
                <td ></td>
                <td>Lead-acid</td>
            </tr>
            <tr>
                <td >Battery Capacity
                </td>
                <td >V x Ah</td>
                <td>24 x 345</td>
            </tr>
            <tr>
                <td >Net Weight without battery
                </td>
                <td >kg</td>
                <td>580</td>
            </tr>
            <tr>
                <td >Net Weight with battery
                </td>
                <td >kg</td>
                <td>865</td>
            </tr>
            <tr>
                <td >Fork Length and Width
                </td>
                <td >mm</td>
                <td>1220</td>
            </tr>
            <tr>
                <td >Fork Width
                </td>
                <td >mm</td>
                <td>685</td>
            </tr>
            <tr>
                <td >Turning Radius
                </td>
                <td >mm</td>
                <td>1940</td>
            </tr>
            <tr>
                <td >Over all length
                </td>
                <td >mm</td>
                <td>2550</td>
            </tr>




        </table>


    </div>

    <div class="four-page">
        <div class="header">
            <table width="100%">
                <tr>
                    <td class="text-left">
                        <h2>Mercuri Industrial Solutions</h2>
                    </td>
                    <td class="company-logo"><img src="/assets/images/logom.png" width="100px"></td>
                </tr>
            </table>
        </div>
        <table class="specif-table">
        <tr>
            <td ><h2 style="text-align: center;
    margin: 0;padding:0px;">General Terms and Conditions</h2></td>
        </tr>
        <tr>
            <td style="text-wrap: auto;">

                <p style="font-size: 8px;">
                    <b>General:</b> “Buyer” means the entity to which Seller is providing Products or Services under the Contract.
“Contract” means either the contract agreement signed by both parties, or the purchase order signed by Buyer and accepted by Seller in writing, for the sale of Products or
Services, together with these Terms and Conditions, Seller’s final quotation, the agreed scope(s) of work, and Seller’s order acknowledgement. In the event of any conflict,
the Terms and Conditions shall take precedence over other documents included in the Contract unless mutually agreed otherwise in a separate agreement.<br>
<b>1)Payment Terms:</b><br>
1.1)Payments are to be made to M/S Maini Materials Movement Pvt. Ltd as per the terms agreed in the Purchase order, all payable in the currency specified in the invoice.<br>
1.2) Provisions of Section 206C (1H) of the Income tax Act regarding Tax Collected at Source (TCS) would be applicable<br>
1.3) Buyer shall pay interest on all late payments at the lesser of the rate of 1.5% per month or the highest rate permissible under applicable law, calculated daily and
compounded monthly. Buyer shall reimburse Seller for all costs incurred in collecting any late payments, including, without limitation, attorneys’ fees and court costs. In
addition to all other remedies available under these Terms and Conditions or at law (which Seller does not waive by the exercise of any rights hereunder), Seller shall be
entitled to suspend the delivery of any Products if Buyer fails to pay any amounts when due hereunder and such failure continues for thirty (30) days following written
notice thereof.<br>
1.4) Seller is a registered MSME under the MSMED, Act 2006.
d) With the enactment of the Micro, Small and Medium Enterprises Development (MSMED), Act 2006, for the goods and services supplied by the MSEME units, payments
have to be made by the buyers as under:-
 - The buyer is to make payment on or before the date agreed on between him and the Seller in writing or, in case of no agreement, before the appointed day. The
agreement between seller and buyer shall not exceed more than 45 days.·
 - If the buyer fails to make payment of the amount to the supplier, he shall be liable to pay compound interest with monthly rests to the supplier on the amount from
the appointed day or, on the date agreed on, at three times of the Bank Rate notified by Reserve Bank.
 - For any goods supplied or services rendered by the supplier, the buyer shall be liable to pay the interest as advised at above<br>
1.5) Payments due against Installation/Commissioning should be made no later than 10 days from the agreed date between the buyer and seller. Seller's payment should
not be withheld by the Buyer on account of delays in the readiness of Buyer's Project/Site for equipment installation/commissioning.<br>
                    <b>2) Shipment Terms:</b><br>
2.1) Seller shall deliver Products to Buyer at Ex Works, Bangalore Maini Materials Movement Pvt. Ltd. Buyer shall pay all delivery costs and charges or pay Seller’s standard
shipping charges plus handling. Partial deliveries are permitted. Seller may deliver Products in advance of the delivery schedule. Delivery times are approximate and are
dependent upon prompt receipt by Seller of all information necessary to proceed with the work without interruption from the Buyer. If Products delivered do not
correspond in quantity, type or price to those itemized in the shipping invoice or documentation, Buyer shall so notify Seller within ten (10) days after receipt.<br>
<b>2.2) Risk and Title</b><br>
2.2.1 Risk of damage or loss of the Goods shall pass to the Buyer in the case of Goods to be delivered at the Seller’s premises, at the time when the Seller notifies the Buyer
that the Goods are available for collection, or in the case of Goods to be delivered otherwise than at the Seller’s premises, at the time of delivery.<br>
2.2.2 Notwithstanding delivery and the passing of risk in the Goods, or any other provision of these conditions, the property in the Goods shall not pass to the Buyer until
the Seller has received in cash or cleared funds payment in full of the Price of the Goods and of all other Goods agreed to be sold by the Seller to the Buyer for which
payment is then due.<br>
2.2.3 Until such time as the property in the Goods passes to the Buyer, the Buyer shall hold the Goods as the Seller’s fiduciary agent and bailee, and shall keep the Goods
separate from those of the Buyer and third parties and properly stored, protected and insured and identified as the Seller’s property.<br>
2.2.4 Until payment of the Price the Buyer shall be entitled to resell or use the Goods in the course of its business but shall account to the Seller for the proceeds of sale or
otherwise of the Goods, whether tangible or intangible including insurance proceeds, and shall keep all such proceeds separate from any monies or property of the Buyer
and third parties and, in the case of tangible proceeds, properly stored, protected and insured.<br>
2.2.5 Until such time as the property in the Goods passes to the Buyer (and provided that the Goods are still in existence and have not been resold) the Seller shall be
entitled at any time to require the Buyer to deliver up the Goods to the Seller and if the Buyer fails to do so forthwith to enter upon any premises of the Buyer or of any
third party where the Goods are stored and repossess the Goods.<br>
2.2.6 The Buyer shall not be entitled to pledge or in any way charge by way of security for any indebtedness any of the Goods which remain the property of the Seller, but if
the Buyer does so all monies owing by the Buyer to the Seller shall (without prejudice to any other right or remedy of the Seller) forthwith become due and payable.<br>
2.2.7 The Seller shall be entitled to recover the Price notwithstanding that property in any of the Goods has not passed from the Seller.<br>
<b>3) Liability</b><br>
3.1 No liability of any nature shall be incurred or accepted by the Seller in respect of any representation made by the Seller, or on its behalf, to the Buyer, or to any party
acting on its behalf, prior to the making of this contract where such representations were made or given in relation to:-<br>
3.1.1. the correspondence of the Goods with any description or sample;<br>
3.1.2. the quality of the Goods; or<br>
3.1.3. the fitness or merchantability of the Goods for any purpose whatsoever.<br>
3.2 No liability of any nature shall be accepted by the Seller to the Buyer in respect of any express term of this contract where such term relates in any way to:<br>
3.2.1. the correspondence of the Goods with any description;<br>
3.2.2. the quality of the Goods; or<br>
3.2.3. the fitness or merchantability of the Goods for any purpose whatsoever.<br>
3.3 Except where the Buyer deals as a consumer all other warranties, conditions or terms relating to fitness for purpose, quality or condition of the Goods, whether express
or implied by statute or common law or otherwise are hereby excluded from the contract to the fullest extent permitted by law.<br>
3.4 For the avoidance of doubt the Seller will not accept any claim for consequential or financial loss of any kind however caused.<br>
<b>4) Limitation of Liability:</b><br>
4.1 Seller’s liability to Buyer on any claim of any kind, including negligence, with respect to the product, shall in no case exceed the purchase price of the product or any part
thereof which gives rise to the claim. in no event shall seller be liable to buyer for any special, indirect, incidental or consequential damages, even if informed of the
possibility of these damages and notwithstanding the failure of the essential purpose of any limited remedy, arising out of, or as a result of, the sale, delivery, non-delivery,
servicing, use or loss of use of the product or any part thereof, or for any charges or expenses of any nature incurred related thereto.<br>
<b>5) Cancellation of Purchase Order:</b><br>
Buyer may cancel its order only with the prior written consent of Seller, which Seller may withhold in its sole discretion. All cancelations will be subject to payment to Seller
of reasonable and proper cancelation charges. Buyer may return Products only at its sole cost and only with the prior written authorization of Seller, subject to a restocking
fee as agreed by the parties. No returns of special, custom, or made-to-order Products will be permitted. No returns will be permitted more than sixty (60) days after
delivery.
                </p>
            </td>
        </tr>
        </table>

    </div>

    <div class="five-page">
        <div class="header">
            <table width="100%">
                <tr>
                    <td class="text-left">
                        <h2>Mercuri Industrial Solutions</h2>
                    </td>
                    <td class="company-logo"><img src="/assets/images/logom.png" width="100px"></td>
                </tr>
            </table>
        </div>
        <table class="specif-table">
        <tr>
            <td ><h2 style="text-align: center;
    margin: 0;padding:0px;">General Terms and Conditions</h2></td>
        </tr>
        <tr>
            <td style="text-wrap: auto;">

                <p style="font-size: 8px;">
                    <b>General:</b> “Buyer” means the entity to which Seller is providing Products or Services under the Contract.
“Contract” means either the contract agreement signed by both parties, or the purchase order signed by Buyer and accepted by Seller in writing, for the sale of Products or
Services, together with these Terms and Conditions, Seller’s final quotation, the agreed scope(s) of work, and Seller’s order acknowledgement. In the event of any conflict,
the Terms and Conditions shall take precedence over other documents included in the Contract unless mutually agreed otherwise in a separate agreement.<br>
<b>1)Payment Terms:</b><br>
1.1)Payments are to be made to M/S Maini Materials Movement Pvt. Ltd as per the terms agreed in the Purchase order, all payable in the currency specified in the invoice.<br>
1.2) Provisions of Section 206C (1H) of the Income tax Act regarding Tax Collected at Source (TCS) would be applicable<br>
1.3) Buyer shall pay interest on all late payments at the lesser of the rate of 1.5% per month or the highest rate permissible under applicable law, calculated daily and
compounded monthly. Buyer shall reimburse Seller for all costs incurred in collecting any late payments, including, without limitation, attorneys’ fees and court costs. In
addition to all other remedies available under these Terms and Conditions or at law (which Seller does not waive by the exercise of any rights hereunder), Seller shall be
entitled to suspend the delivery of any Products if Buyer fails to pay any amounts when due hereunder and such failure continues for thirty (30) days following written
notice thereof.<br>
1.4) Seller is a registered MSME under the MSMED, Act 2006.
d) With the enactment of the Micro, Small and Medium Enterprises Development (MSMED), Act 2006, for the goods and services supplied by the MSEME units, payments
have to be made by the buyers as under:-
 - The buyer is to make payment on or before the date agreed on between him and the Seller in writing or, in case of no agreement, before the appointed day. The
agreement between seller and buyer shall not exceed more than 45 days.·
 - If the buyer fails to make payment of the amount to the supplier, he shall be liable to pay compound interest with monthly rests to the supplier on the amount from
the appointed day or, on the date agreed on, at three times of the Bank Rate notified by Reserve Bank.
 - For any goods supplied or services rendered by the supplier, the buyer shall be liable to pay the interest as advised at above<br>
1.5) Payments due against Installation/Commissioning should be made no later than 10 days from the agreed date between the buyer and seller. Seller's payment should
not be withheld by the Buyer on account of delays in the readiness of Buyer's Project/Site for equipment installation/commissioning.<br>
                    <b>2) Shipment Terms:</b><br>
2.1) Seller shall deliver Products to Buyer at Ex Works, Bangalore Maini Materials Movement Pvt. Ltd. Buyer shall pay all delivery costs and charges or pay Seller’s standard
shipping charges plus handling. Partial deliveries are permitted. Seller may deliver Products in advance of the delivery schedule. Delivery times are approximate and are
dependent upon prompt receipt by Seller of all information necessary to proceed with the work without interruption from the Buyer. If Products delivered do not
correspond in quantity, type or price to those itemized in the shipping invoice or documentation, Buyer shall so notify Seller within ten (10) days after receipt.<br>
<b>2.2) Risk and Title</b><br>
2.2.1 Risk of damage or loss of the Goods shall pass to the Buyer in the case of Goods to be delivered at the Seller’s premises, at the time when the Seller notifies the Buyer
that the Goods are available for collection, or in the case of Goods to be delivered otherwise than at the Seller’s premises, at the time of delivery.<br>
2.2.2 Notwithstanding delivery and the passing of risk in the Goods, or any other provision of these conditions, the property in the Goods shall not pass to the Buyer until
the Seller has received in cash or cleared funds payment in full of the Price of the Goods and of all other Goods agreed to be sold by the Seller to the Buyer for which
payment is then due.<br>
2.2.3 Until such time as the property in the Goods passes to the Buyer, the Buyer shall hold the Goods as the Seller’s fiduciary agent and bailee, and shall keep the Goods
separate from those of the Buyer and third parties and properly stored, protected and insured and identified as the Seller’s property.<br>
2.2.4 Until payment of the Price the Buyer shall be entitled to resell or use the Goods in the course of its business but shall account to the Seller for the proceeds of sale or
otherwise of the Goods, whether tangible or intangible including insurance proceeds, and shall keep all such proceeds separate from any monies or property of the Buyer
and third parties and, in the case of tangible proceeds, properly stored, protected and insured.<br>
2.2.5 Until such time as the property in the Goods passes to the Buyer (and provided that the Goods are still in existence and have not been resold) the Seller shall be
entitled at any time to require the Buyer to deliver up the Goods to the Seller and if the Buyer fails to do so forthwith to enter upon any premises of the Buyer or of any
third party where the Goods are stored and repossess the Goods.<br>
2.2.6 The Buyer shall not be entitled to pledge or in any way charge by way of security for any indebtedness any of the Goods which remain the property of the Seller, but if
the Buyer does so all monies owing by the Buyer to the Seller shall (without prejudice to any other right or remedy of the Seller) forthwith become due and payable.<br>
2.2.7 The Seller shall be entitled to recover the Price notwithstanding that property in any of the Goods has not passed from the Seller.<br>
<b>3) Liability</b><br>
3.1 No liability of any nature shall be incurred or accepted by the Seller in respect of any representation made by the Seller, or on its behalf, to the Buyer, or to any party
acting on its behalf, prior to the making of this contract where such representations were made or given in relation to:-<br>
3.1.1. the correspondence of the Goods with any description or sample;<br>
3.1.2. the quality of the Goods; or<br>
3.1.3. the fitness or merchantability of the Goods for any purpose whatsoever.<br>
3.2 No liability of any nature shall be accepted by the Seller to the Buyer in respect of any express term of this contract where such term relates in any way to:<br>
3.2.1. the correspondence of the Goods with any description;<br>
3.2.2. the quality of the Goods; or<br>
3.2.3. the fitness or merchantability of the Goods for any purpose whatsoever.<br>
3.3 Except where the Buyer deals as a consumer all other warranties, conditions or terms relating to fitness for purpose, quality or condition of the Goods, whether express
or implied by statute or common law or otherwise are hereby excluded from the contract to the fullest extent permitted by law.<br>
3.4 For the avoidance of doubt the Seller will not accept any claim for consequential or financial loss of any kind however caused.<br>
<b>4) Limitation of Liability:</b><br>
4.1 Seller’s liability to Buyer on any claim of any kind, including negligence, with respect to the product, shall in no case exceed the purchase price of the product or any part
thereof which gives rise to the claim. in no event shall seller be liable to buyer for any special, indirect, incidental or consequential damages, even if informed of the
possibility of these damages and notwithstanding the failure of the essential purpose of any limited remedy, arising out of, or as a result of, the sale, delivery, non-delivery,
servicing, use or loss of use of the product or any part thereof, or for any charges or expenses of any nature incurred related thereto.<br>
<b>5) Cancellation of Purchase Order:</b><br>
Buyer may cancel its order only with the prior written consent of Seller, which Seller may withhold in its sole discretion. All cancelations will be subject to payment to Seller
of reasonable and proper cancelation charges. Buyer may return Products only at its sole cost and only with the prior written authorization of Seller, subject to a restocking
fee as agreed by the parties. No returns of special, custom, or made-to-order Products will be permitted. No returns will be permitted more than sixty (60) days after
delivery.
                </p>
            </td>
        </tr>
        </table>

    </div>

</body>

</html>
