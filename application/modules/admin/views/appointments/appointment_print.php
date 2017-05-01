<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box{
            max-width:800px;
            margin:auto;
            padding:30px;
            border:1px solid #eee;
            box-shadow:0 0 10px rgba(0, 0, 0, .15);
            font-size:16px;
            line-height:24px;
            font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color:#555;
        }
        .invoice-box table{
            width:100%;
            line-height:inherit;
            text-align:left;
        }
        .invoice-box table td{
            padding:5px;
            vertical-align:top;
        }
        .invoice-box table tr td:nth-child(2){
            text-align:right;
        }
        .invoice-box table tr.top table td{
            padding-bottom:20px;
        }
        .invoice-box table tr.top table td.title{
            font-size:45px;
            line-height:45px;
            color:#333;
        }
        .invoice-box table tr.information table td{
            padding-bottom:40px;
        }
        .invoice-box table tr.heading td{
            background:#eee;
            border-bottom:1px solid #ddd;
            font-weight:bold;
        }
        .invoice-box table tr.details td{
            padding-bottom:20px;
        }
        .invoice-box table tr.item td{
            border-bottom:1px solid #eee;
        }
        .invoice-box table tr.item.last td{
            border-bottom:none;
        }
        .invoice-box table tr.total td:nth-child(2){
            border-top:2px solid #eee;
            font-weight:bold;
        }
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td{
                width:100%;
                display:block;
                text-align:center;
            }
            .invoice-box table tr.information table td{
                width:100%;
                display:block;
                text-align:center;
            }
        }
    </style>
</head>

<body>



<?php foreach ($generateValue as $v): ?>





<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                           <h3>Lab Management</h3>
                        </td>

                        <td>
                            Reference No #:  <?php echo $v['reference_no'];?><br>
                            Date:-  <?php echo $v['appointment_date'];?> <br>
                            Time:-  <?php echo $v['sample_collection_time'];?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                             Patient Name :-<?php echo $v['name'];?> <br>
                             Sex :- <?php echo $v['sex'];?> <br>
                             Age :-<?php echo $v['age'];?> <br>
                             Ref.Dr. <?php echo $v['doctor_ref_by'];?> <br>

                        </td>

                        <td>
                            <br>
                            lab address<br>
                            nkscoder@gmail.com
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>
                Appointment Status
            </td>

            <td>
                Payment Status
            </td>
        </tr>

        <tr class="details">
            <td>
                <?php echo $v['appointment_status'];?>
            </td>

            <td>
                <?php echo $v['payment_status'];?>

            </td>
        </tr>

        <tr class="heading">
            <td>
                Payment mode
            </td>

            <td>
                Price
            </td>
        </tr>

        <tr class="item">
            <td>
                Test Price
            </td>

            <td>
                <?php echo $v['test_price'];?>
            </td>
        </tr>

        <tr class="item">
            <td>
                Discount
            </td>

            <td>
                <?php echo $v['discount'];?>.00

            </td>
        </tr>

        <tr class="item last">
            <td>
                Total Price
            </td>

            <td>
                <?php echo $v['total_price'];?>
            </td>
        </tr>

        <tr class="total">
            <td></td>

            <td>
                Total:  <?php echo $v['total_price'];?>
            </td>
        </tr>
    </table>
</div>
<?php endforeach; ?>
<script type="text/javascript">
    window.print();
    window.onfocus=function(){ window.close();}
    window.location="http://localhost/lab_management/admin/appointments/";
</script>

</body>
</html>