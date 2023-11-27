<table autosize="1" width="760px" style="overflow: wrap">
	<tr>
		<td style="width:650px; vertical-align:top;">
			<table>
				<tr>
					<td style="vertical-align: top; font-size: 20px; width: 60px; padding-top:10px;">Say : </td>
					<td style="font-size:20px; padding: 10px; width: 390px; height: 80px;  border: 1px solid black; vertical-align: top; border-radius: 25px; overflow: hidden;">
						<?php echo ucwords(strtolower($terbilang)).' '.$coa_currency_cd; ?>
					</td>
				</tr>
			</table>
		</td>
		<td style="width:100px;">&nbsp;</td>
		<td style="width:400px; vertical-align:top;">
			<table style="border: 1px solid black;">
				<tr>
					<td style="font-size:20px; width:200px; vertical-align: top; " align="right">Sub Total Amount :</td>
					<td style="font-size:20px; width:200px; vertical-align: top; padding-right: 10px;" align="right"><?php echo $sub_amount; ?></td>
				</tr>
				<tr>
					<td style="font-size:20px; width:200px; vertical-align: top; " align="right">Discount Amount :</td>
					<td style="font-size:20px; width:200px; vertical-align: top; padding-right: 10px;" align="right"><?php echo $discount_amount; ?></td>
				</tr>
				<tr>
					<td style="font-size:20px; width:200px; vertical-align: top; " align="right">Tax (+) :</td>
					<td style="font-size:20px; width:200px; vertical-align: top; padding-right: 10px;" align="right"><?php echo $ppn; ?></td>
				</tr>
				<tr>
					<td style="font-size:20px; width:200px; vertical-align: top; " align="right">Tax (-) :</td>
					<td style="font-size:20px; width:200px; vertical-align: top; padding-right: 10px;" align="right"><?php echo $pph; ?></td>
				</tr>
				<tr>
					<td style="font-size:20px; width:200px; vertical-align: top; " align="right">Total Amount :</td>
					<td style="font-size:20px; width:200px; vertical-align: top; padding-right: 10px;" align="right"><?php echo $total_amount; ?></td>
				</tr>
			</table>
			<br>
			<table style="width:100%;" align="center">
				<tr>
					<td style="font-size:24px; width:200px; vertical-align: top; " align="center" colspan="2">PT. MEIWA MOLD INDONESIA</td>
				</tr>
				<tr>
					<td style="font-size:20px; width:200px; vertical-align: top; " align="center" colspan="2">Bekasi, <?php echo $sales_invoice_date; ?></td>
				</tr>
				<tr>
					<td style="font-size:24px; width:200px; height: 100px;" align="center" colspan="2"><?php echo $approve_by; ?></td>
				</tr>
				<tr>
					<td style="font-size:23px; width:200px; vertical-align: bottom; " align="center" colspan="2"><?php echo strtoupper($cNmPegawai_approval); ?></td>
				</tr>
				<tr>
					<td style="font-size:20px; width:100px; vertical-align: top; border-top: 1px solid black;" align="center" colspan="2"><?php echo strtoupper($cNmJbtn); ?></td>
				</tr>
			</table>
		</td>
	</tr>	
</table>
<?php echo $page_count; ?>