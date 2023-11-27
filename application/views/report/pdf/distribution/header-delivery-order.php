<table autosize="1" width="100%" style="overflow: wrap; padding-top: -10px;">
	<tr>
		<td style="width:680px;">
			<table>
				<tr>
					<td colspan="2">
						<div style="font-size:20px; font-weight:bold;">
							<?php echo $company_name; ?>
						</div>
						<div style="font-size:14px;">
							<?php echo $company_address.' '.$company_city.' '.$company_postal_code; ?>
						</div>
						<div style="font-size:14px; padding-top:25px;">
							<?php echo 'NPWP : 10.869.463.8.055.000 Phone : '.$company_phone.' Fax : '.$company_fax; ?>
						</div>
					</td>		
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td style="width:75px; font-size:16px; vertical-align: top;">Bill To</td>
					<td style="width:605px; font-size:16px; vertical-align: top; height: 80px; border: 1px solid black; padding-left: 5px; border-radius: 50px solid red;">
						<div style="font-size:14px; font-weight:bold;"><?php echo $account_name; ?></div>
						<div style="font-size:14px;">
							<?php 
								if ($company_country == $id_country) {
									echo $main_address.' '.$city.' '.$postal_code; 
								}
								else {
									echo $main_address.' '.$city.' '.$postal_code.', '.$country_name;
								}
							?><br>
							<?php echo 'Phone : '.$phone_1.' Fax : '.$fax.'. Attn : '.$attn; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td style="width:75px; font-size:16px; vertical-align: top;">Delivery</td>
					<td style="width:605px; font-size:16px; vertical-align: top; height: 80px; border: 1px solid black; padding-left: 5px;">
						<div style="font-size:14px; font-weight:bold;"><?php echo $account_name_project; ?></div>
						<div style="font-size:14px;">
							<?php 
								if ($company_country == $id_country) {
									echo $main_address_project.' '.$city_project.' '.$postal_code_project; 
								}
								else {
									echo $main_address_project.' '.$city_project.' '.$postal_code_project.', '.$country_name_project;
								}
							?><br>
							<?php echo 'Phone : '.$phone_1_project.' Fax : '.$fax_project.'. Attn : '.$attn_project; ?>
						</div>
					</td>
				</tr>
			</table>
		</td>
		<td style="width:10px;"></td>
		<td style="width:360px; vertical-align:top; padding-top: 45px;">
			<table>
				<tr>
					<td colspan="3" align="center"><div style="font-size:30px; font-weight:bold; font-family:Times New Rowman;">Delivery Order</div></td>
				</tr>
				<tr>
					<td style="width:180px; height: 50px; border: 1px solid black; vertical-align: top; font-size: 14px;" align="center">Delivery Order Date<br><?php echo $delivery_order_date; ?></td>
					<td style="width:180px; vertical-align: top;  top; font-size: 14px; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;" align="center">PO No.<br><?php echo $delivery_order_date; ?></td>
				</tr>
				<tr>
					<td style="width:180px; height: 50px; vertical-align: top; font-size: 14px; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;" align="center">Delivery Order Number<br><?php echo $delivery_order_number; ?></td>
					<td style="width:180px; vertical-align: top;  top; font-size: 14px; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;" align="center">Delivery With<br><?php // echo $sales_order_number; ?></td>
				</tr>
			</table>
		</td>
	</tr>	
</table>
<table autosize="1" width="100%" style="overflow: wrap; border: 1px solid black; font-size: 11px; font-weight:bold;">
	<tr>
		<td align="center" style="width:50px; height: 25px; border-right: 1px solid black;">NO</td>
		<td align="center" style="width:150px; border-right: 1px solid black;">JOB NO</td>
		<td align="center" style="width:300px; border-right: 1px solid black;">DESCRIPTION</td>
		<td align="center" style="width:100px; border-right: 1px solid black;">QTY</td>
		<td align="center" style="width:150px;">UOM</td>
	</tr>
</table>