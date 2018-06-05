<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Acknowledgement Slip - Testmatch</title>

<style>
	.demo {
		border:1px solid #323232;
		border-collapse:collapse;
		padding:5px;
	}
	.demo th {
		border:1px solid #323232;
		padding:5px;
		background:#F0F0F0;
		//font-family:Verdana, Geneva, sans-serif;
		font-size:9px;
		font-weight:bold;
	}
	.demo td {
		border:1px solid #323232;
		padding:5px;
		//font-family:Verdana, Geneva, sans-serif;
		font-size:11px;		
		
	}
        .small_demo {
		border:1px solid;
		padding:2px;
	}
	.small_demo td {
		//border:1px solid;
		padding:2px;
                width: auto;
               // font-family:Verdana, Geneva, sans-serif; 
                font-size:9px; font-weight:normal;
	}
        
        
	.headerdemo {
		border:0px solid #323232;
		padding:2px;
	}
	
	.headerdemo td {
		//border:1px solid #C0C0C0;
		padding:2px;
	}
         .demo_font{
            font-family:Verdana, Geneva, sans-serif;
		font-size:11px;	
        }
        .break{
            page-break-after: always;
        }
</style>
</head>
    

<body>


    <?php //pre($orderdetailData); ?>
    <table width="100%" align="center">
        <tr>
            <td align="center"><font style="font-family:Verdana, Geneva, sans-serif; font-size:9px; font-weight:bold">ACKNOWLEDGEMENT SLIP</font></td>
        </tr>
        <tr>
            <td align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold"><?php echo "Testmatch.com"; ?></font></td>
        </tr>
       
    </table>    
    
 

    <table width="100%" class="headerdemo" style="border-top:0;border-bottom:0;font-family:Verdana, Geneva, sans-serif; font-size:10px !important;">
	
        <tr style="font-size:20px;bordre:1px solid #323232;">
            <td width="50%" style="border-bottom:0px solid #323232;border-right:0px solid #323232;font-weight:bold;">BY</td>
            <td width="50%" style="border-bottom:0px solid #323232;border-left:0px solid #323232;text-align:right;font-weight:bold;">Billing Address</td>
        </tr>

        <tr style="font-size:20px;">
            <td width="46%" valign="top" style="font-family:Verdana, Geneva, sans-serif; ">
                <table width="100%" class="demo_font" >
                    <tr><td><?php echo $orderdetailData['order_master']->center_name;?></td></tr>
                    <tr><td><?php echo $orderdetailData['order_master']->center_full_add;?></td></tr>
                    <tr><td><?php echo $orderdetailData['order_master']->pincode;?></td></tr>
                    <tr><td><?php echo "<b>Phone : </b>".$orderdetailData['order_master']->contact_no;?></td></tr>
                    <tr><td><?php echo "<b>Email : </b>".$orderdetailData['order_master']->center_email;?></td></tr>
                </table>
            </td>
        
            
            <td width="46%" valign="top" style="font-family:Verdana, Geneva, sans-serif;direction:rtl; ">
                <table width="100%" class="demo_font" >
                    <tr><td><?php echo $orderdetailData['delivery_info']->customerName;?></td></tr>
                    <tr><td><?php echo $orderdetailData['delivery_info']->fullAddress; ?></td></tr>
                    <tr><td><?php echo $orderdetailData['delivery_info']->cusCity.",".$orderdetailData['delivery_info']->stateName.",".$orderdetailData['delivery_info']->cusPincode.",".$orderdetailData['delivery_info']->countryShortName ;?></td></tr>
                </table>
            </td>
        </tr>
    </table>

        <table width="100%" class="headerdemo" style="border-top:0;border-bottom:0;font-family:Verdana, Geneva, sans-serif; font-size:10px !important;">
	
            <tr style="font-size:20px;bordre:1px solid #323232;">
                <td width="50%" style="border-bottom:0px solid #323232;border-right:0px solid #323232;font-weight:bold;">Order Detail</td>
                <td width="50%" style="border-bottom:0px solid #323232;border-left:0px solid #323232;text-align:right;font-weight:bold;">Shipping Address</td>
            </tr>

            <tr style="font-size:20px;">
                <td width="46%" valign="top" style="font-family:Verdana, Geneva, sans-serif; ">
                    <table width="100%" class="demo_font" >
                        <tr>
                            <td>Order Date</td>
                            <td><?php echo date("d/m/Y",strtotime($orderdetailData['order_master']->orderd_on));?></td>
                        </tr>
                        <tr>
                            <td>Order No.</td>
                            <td> <?php echo $orderdetailData['order_master']->uniq_order_id;?></td>
                        </tr>
                        
                    </table>
                </td>
            
                
                <td width="46%" valign="top" style="font-family:Verdana, Geneva, sans-serif; ">
                    <table width="100%" class="demo_font" style="text-align:right;">
                        <tr><td><?php echo $orderdetailData['delivery_info']->customerName;?></td></tr>
                        <tr><td><?php echo $orderdetailData['delivery_info']->fullAddress; ?></td></tr>
                        <tr><td><?php echo $orderdetailData['delivery_info']->cusCity.",".$orderdetailData['delivery_info']->stateName.",".$orderdetailData['delivery_info']->cusPincode.",".$orderdetailData['delivery_info']->countryShortName ;?></td></tr>
                    </table>
                </td>
            </tr>
    </table>

   <table width="100%" border="0" class="demo table-condensed" style="border-top:0;">
          <tr>
            <th>Sl.</th>
            <th>Description</th>
            <th style="text-align:center; ">Test Dt</th>
            <th style="text-align:center; ">Rep Dt.</th>
            <th style="text-align:right; ">Total</th>
           
          </tr>

          <?php 
            if(sizeof($orderdetailData['order_detail_data'])>0){
              $srl=1;
              
              foreach($orderdetailData['order_detail_data'] as $test_detaisl){ ?>
                 <tr>
                  <td><?php echo $srl; ?></td>
                  <td><?php echo $test_detaisl['order_detail_row']->investigationName; ?></td>
                  <td align="center"><?php echo date("d/m/Y",strtotime($test_detaisl['testdate'])); ?></td>
                  <td align="center"><?php echo $test_detaisl['deliveryDate']; ?></td>
                  <td align="right"><?php echo $test_detaisl['order_detail_row']->test_amount; ?></td>
                </tr>
          <?php
              $srl++;
              }
            }
          ?>

         
          <tr>
            <td colspan="4">Total</td>
            <td align="right"><?php echo $orderdetailData['order_master']->order_total_amt;?></td>
          </tr>
    </table>



    <table width="100%" class="headerdemo" border="0" style="border-top:0;font-size:11px;" cellspacing="8" cellpadding="0">
        <tr style="height:25px;">
            <td width="50%"></td>
            <td width="50%" style="text-align:right;">For Testmatch</td>
        </tr>
        
        <tr style="height:25px;">
            <td width="50%">&nbsp;</td>
            <td width="50%" style="text-align:right;">&nbsp;</td>
        </tr>
        <tr>
            <td width="50%"></td>
            <td width="50%" style="text-align:right;">Authorized Signatory</td>
        </tr>


    </table>

</body>
</html>
