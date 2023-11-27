<?php
	include $base_url.'assets/lib/phpqrcode/qrlib.php';

	$tempdir = "assets/images/qrcode/"; //Nama folder tempat menyimpan file qrcode
    if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

    $filename_qrcode = str_replace('/', 'XX', $purchase_receipt_number);

    //ambil logo
    $logopath= $base_url.'assets/images/mmi/logo.png';

	 //simpan file qrcode
	 QRcode::png($filename_qrcode, $tempdir.''.$filename_qrcode.'.png', QR_ECLEVEL_H, 10, 4);

	 // ambil file qrcode
	 $QR = imagecreatefrompng($tempdir.''.$filename_qrcode.'.png');

	 // memulai menggambar logo dalam file qrcode
	 $logo = imagecreatefromstring(file_get_contents($logopath));
	 
	 imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
	 imagealphablending($logo , false);
	 imagesavealpha($logo , true);

	 $QR_width = imagesx($QR);
	 $QR_height = imagesy($QR);

	 $logo_width = imagesx($logo);
	 $logo_height = imagesy($logo);

	 // Scale logo to fit in the QR Code
	 $logo_qr_width = $QR_width/3;
	 $scale = $logo_width/$logo_qr_width;
	 $logo_qr_height = $logo_height/$scale;

	 imagecopyresampled($QR, $logo, $QR_width/2.75, $QR_height/2.75, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

	 // Simpan kode QR lagi, dengan logo di atasnya
	 imagepng($QR,$tempdir.''.$filename_qrcode.'.png');

?>
<table autosize="1" width="100%" style="overflow: wrap">
	<tr>
		<td style="width:600px;">
			<table>
				<tr>
					<td colspan="2">
						<div style="font-size:28px; font-weight:bold;">
							<?php echo $company_name; ?>
						</div><br>
						<div style="font-size:18px; padding-top:25px;">
							<?php echo $company_address.' '.$company_city.' '.$company_postal_code; ?>
						</div>
						<div style="font-size:18px; padding-top:25px;">
							<?php echo 'Phone : '.$company_phone.' Fax : '.$company_fax; ?>
						</div>
						<div style="font-size:18px; padding-top:25px;">
							<?php echo 'NPWP : 10.869.463.8.055.000'; ?>
						</div>
					</td>		
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td style="width:50px; font-size:18px; vertical-align: top;">Vendor</td>
					<td style="width:500px; font-size:18px; vertical-align: top; height: 120px; border: 1px solid black; padding-left: 5px;">
						<div style="font-size:18px; font-weight:bold;"><?php echo $account_name; ?></div>
						<div style="font-size:18px;">
							<?php echo $main_address.' '.$city.' '.$postal_code; ?><br>
							<?php echo 'Phone : '.$phone_1.' Fax : '.$fax; ?><br>
							<?php echo 'Attn : '.$attn; ?>
						</div>
					</td>
				</tr>
			</table>
		</td>
		<td style="width:10px;"></td>
		<td style="width:440px; vertical-align:top; padding-top: 50px;">
			<table>
				<tr>
					<td colspan="3"><div style="font-size:24px; font-weight:bold;">Purchase Receipt</div></td>
				</tr>
				<tr>
					<td style="width:150px; height: 50px; border: 1px solid black; vertical-align: top; font-size: 18px;">Receipt Date</td>
					<td style="width:150px; vertical-align: top;  top; font-size: 18px; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;"><?php echo $purchase_receipt_date; ?></td>
					<td rowspan="3" style="width:145px; vertical-align:top;"><img src="<?php echo $base_url.'assets/images/qrcode/'.$filename_qrcode.'.png'; ?>" style="width: 145px; height:145px;"></td>
				</tr>
				<tr>
					<td style="width:150px; height: 50px; vertical-align: top; font-size: 18px; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">Receipt Number</td>
					<td style="width:150px; vertical-align: top;  top; font-size: 18px; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;"><?php echo $purchase_receipt_number; ?></td>
				</tr>
				<tr>
					<td style="width:150px; height: 50px; vertical-align: top; font-size: 18px; border-right: 1px solid black; border-left: 1px solid black;">Date Create</td>
					<td style="width:150px; vertical-align: top;  top; font-size: 18px; border-right: 1px solid black; vertical-align: top;"><?php echo $create_date; ?></td>
				</tr>
				<tr>
					<td align="center" style="width:150px; height: 50px; vertical-align: top; font-size: 18px; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">Receipt Qty<br><?php echo $total_qty; ?></td>
					<td colspan="2" style="padding-left: 5px; width:300px; vertical-align: top;  top; font-size: 18px; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; vertical-align: top;">Vendor Receipt Number<br><?php echo $vendor_receipt_number; ?></td>
				</tr>

			</table>
		</td>
	</tr>	
</table>
<br>
<table autosize="1" width="100%" style="overflow: wrap; border: 1px solid black; background-color: rgb(51, 153, 255); color: white; font-size: 12px; font-weight:bold;">
	<tr>
		<td align="center" style="width:40px; height: 30px; border-right: 1px solid black;">NO</td>
		<td align="center" style="width:75px; border-right: 1px solid black;">JOB NO</td>
		<td align="center" style="width:300px; border-right: 1px solid black;">DESCRIPTION</td>
		<td align="center" style="width:40px; border-right: 1px solid black;">QTY</td>
		<td align="center" style="width:50px; border-right: 1px solid black;">UOM</td>
		<td align="center" style="width:100px;">PO NUMBER</td>
	</tr>
</table>