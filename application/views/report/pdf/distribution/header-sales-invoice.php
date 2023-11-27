<table autosize="1" width="100%" style="overflow: wrap; padding-top:70px;">
	<tr>
		<td style="width:1000px;" align="center" colspan="3">
			<div style="font-size:46px; font-weight:bold; font-family:Times New Rowman;">
				INVOICE
			</div>
		</td>
	</tr>
	<tr>
		<td style="width:500px; padding-top:30px; font-family:Times New Rowman; vertical-align:top; ">
			<table style="width:500px;">
				<tr>
					<td style="font-size:16px; vertical-align:top; height: 30px;">TO :</td>
					<td style="font-size:18px; vertical-align:top;">
						<b><?php echo $account_name; ?></b> <br>
						<div style="font-size:17px;">
							<?php 
								if ($company_country == $id_country) {
									echo $main_address.' '.$city.' '.$postal_code; 
								}
								else {
									echo $main_address.' '.$city.' '.$postal_code.', <br>'.$country_name;
								}
							?><br>
							<?php echo 'Phone : '.$phone_1.' Fax : '.$fax; ?><br>
							<?php echo 'Attn : '.$attn; ?>
						</div>
					</td>
				</tr>
			</table>
		</td>
		<td style="width:100px;">&nbsp;</td>
		<td style="width:400px;vertical-align:top; font-family:Times New Rowman; padding-top:30px;">
			<table style="width:400px;">
				<tr>
					<td style="font-size:18px; vertical-align:top; width: 100px; height: 30px;">Invoice No</td>
					<td style="font-size:18px; vertical-align:top; width: 10px;">:</td>
					<td style="font-size:18px; vertical-align:top; width: 290px; font-weight: bold;"><?php echo $sales_invoice_number; ?></td>
				</tr>
				<tr>
					<td style="font-size:18px; vertical-align:top; width: 100px; height: 30px;">Invoice Tax</td>
					<td style="font-size:18px; vertical-align:top; width: 10px;">:</td>
					<td style="font-size:18px; vertical-align:top; width: 290px;"><?php echo $tax_number; ?></td>
				</tr>
				<tr>
					<td style="font-size:18px; vertical-align:top; width: 100px; height: 30px;">PO No.</td>
					<td style="font-size:18px; vertical-align:top; width: 10px;">:</td>
					<td style="font-size:18px; vertical-align:top; width: 290px;"><?php echo $customer_order_number; ?></td>
				</tr>
				<tr>
					<td style="font-size:18px; vertical-align:top; width: 100px; height: 30px;">Currency</td>
					<td style="font-size:18px; vertical-align:top; width: 10px;">:</td>
					<td style="font-size:18px; vertical-align:top; width: 290px;"><?php echo $coa_currency_cd; ?></td>
				</tr>
				<tr>
					<td style="font-size:18px; vertical-align:top; width: 100px; height: 30px;">Category</td>
					<td style="font-size:18px; vertical-align:top; width: 10px;">:</td>
					<td style="font-size:18px; vertical-align:top; width: 290px;"><?php echo $payment_methode_name; ?></td>
				</tr>
				<tr>
					<td style="font-size:18px; vertical-align:top; width: 100px; height: 30px;">Terms</td>
					<td style="font-size:18px; vertical-align:top; width: 10px;">:</td>
					<td style="font-size:18px; vertical-align:top; width: 290px;"><?php echo $payment_terms_name; ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- <tr>
		<td style="width:340px; vertical-align:top; padding-top: 132px;">
			<table>
				<tr>
					<td colspan="3"><div style="font-size:25px; font-weight:bold;">Sales Invoice</div></td>
				</tr>
				<tr>
					<td style="width:150px; height: 50px; border: 1px solid black; vertical-align: top; font-size: 18px;">Sales Invoice Date</td>
					<td style="width:150px; vertical-align: top;  top; font-size: 18px; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;"><?php echo $sales_order_date; ?></td>
					<td rowspan="3" style="width:150px; vertical-align:top;"><img src="<?php echo $base_url.'assets/images/qrcode/'.$filename_qrcode.'.png'; ?>" style="width: 150px; height:150px;"></td>
				</tr>
				<tr>
					<td style="width:150px; height: 50px; vertical-align: top; font-size: 18px; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">Sales Invoice Number</td>
					<td style="width:150px; vertical-align: top;  top; font-size: 18px; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;"><?php echo $sales_order_number; ?></td>
				</tr>
				<tr>
					<td style="width:150px; height: 50px; vertical-align: top; font-size: 18px; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">Cust. Order Number</td>
					<td style="width:150px; vertical-align: top;  top; font-size: 18px; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;"><?php echo $customer_order_number; ?></td>
				</tr>
				<tr>
					<td align="center" style="width:150px; height: 50px; vertical-align: top; font-size: 17px; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">Sales Man<br><?php echo $cNmPegawai_sales_order_owner; ?></td>
					<td align="center" style="width:150px; vertical-align: top;  top; font-size: 17px; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;">Currency<br><?php echo $coa_currency_cd; ?></td>
					<td align="center" style="width:150px; height: 50px; vertical-align: top;  top; font-size: 17px; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;">Rate<br><?php echo $rate_format; ?></td>
				</tr>
			</table>
		</td>

		<td style="width:10px;"></td>

		<td style="width:340px; vertical-align:top; padding-top: 132px;">
			<table>
				<tr>
					<td colspan="3"><div style="font-size:25px; font-weight:bold;">Sales Invoice</div></td>
				</tr>
				<tr>
					<td style="width:150px; height: 50px; border: 1px solid black; vertical-align: top; font-size: 18px;">Sales Invoice Date</td>
					<td style="width:150px; vertical-align: top;  top; font-size: 18px; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;"><?php echo $sales_order_date; ?></td>
					<td rowspan="3" style="width:150px; vertical-align:top;"><img src="<?php echo $base_url.'assets/images/qrcode/'.$filename_qrcode.'.png'; ?>" style="width: 150px; height:150px;"></td>
				</tr>
				<tr>
					<td style="width:150px; height: 50px; vertical-align: top; font-size: 18px; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">Sales Invoice Number</td>
					<td style="width:150px; vertical-align: top;  top; font-size: 18px; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;"><?php echo $sales_order_number; ?></td>
				</tr>
				<tr>
					<td style="width:150px; height: 50px; vertical-align: top; font-size: 18px; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">Cust. Order Number</td>
					<td style="width:150px; vertical-align: top;  top; font-size: 18px; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;"><?php echo $customer_order_number; ?></td>
				</tr>
				<tr>
					<td align="center" style="width:150px; height: 50px; vertical-align: top; font-size: 17px; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">Sales Man<br><?php echo $cNmPegawai_sales_order_owner; ?></td>
					<td align="center" style="width:150px; vertical-align: top;  top; font-size: 17px; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;">Currency<br><?php echo $coa_currency_cd; ?></td>
					<td align="center" style="width:150px; height: 50px; vertical-align: top;  top; font-size: 17px; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;">Rate<br><?php echo $rate_format; ?></td>
				</tr>
			</table>
		</td>
	</tr>	 -->
</table>

<div style="height:5px;">&nbsp;</div>

<table autosize="1" width="760px" style="overflow: wrap; border: 1px solid black; font-size: 12px; font-weight:bold;">
	<tr>
		<td align="center" style="width:40px; height: 30px; border-right: 1px solid black;">NO</td>
		<td align="center" style="width:300px; border-right: 1px solid black;">DESCRIPTION</td>
		<td align="center" style="width:50px; border-right: 1px solid black;">QTY</td>
		<td align="center" style="width:60px; border-right: 1px solid black;">UOM</td>
		<td align="center" style="width:140px; border-right: 1px solid black;">UNIT PRICE</td>
		<td align="center" style="width:170px;">AMOUNT</td>
	</tr>
</table>