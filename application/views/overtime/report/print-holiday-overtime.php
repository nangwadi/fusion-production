<html>
	<head>
		<title>DAFTAR KARYAWAN YANG BEKERJA LEMBUR PADA HARI LIBUR TANGGAL <?php echo strtoupper(date_format(date_create($dTglHdr), 'd-M-Y')); ?></title>
		<style>
			html, body {
				font-family: "calibri", Times, serif;
				padding-top:10px;
			}

			.table2 {
			    border-collapse: collapse;
				width:740px;
				font-size:11px;
			}

			.table2, td {
			    border: 1px solid black;
			}
		</style>
	</head>

	<body>
		<table class="table2">
			<tr>
				<td style="width:580px; height: 30px; font-size: 9pt;" colspan="8" align="center"><b>DAFTAR KARYAWAN YANG BEKERJA LEMBUR PADA HARI LIBUR TANGGAL <?php echo strtoupper(date_format(date_create($dTglHdr), 'd-M-Y')); ?></b></td>
			</tr>
			<tr>
				<td style="width:30px; font-weight: bold;"  rowspan="2" align="center">NO.</td>
				<td style="width:150px; font-weight: bold;"  rowspan="2" align="center">NAMA</td>
				<td style="width:100px; font-weight: bold;" rowspan="2" align="center">BAGIAN</td>
				<td style="width:120px; font-weight: bold;" colspan="2" align="center">REALISASI WAKTU LEMBUR</td>
				<td style="width:60px; font-weight: bold;" rowspan="2" align="center">JAM</td>
				<td style="width:120px; font-weight: bold;" rowspan="2" align="center">JOB</td>
				<td style="width:80px; font-weight: bold;" rowspan="2" align="center">TANDA TANGAN</td>
			</tr>
			<tr>
				<td style="font-size:9px; font-weight: bold; width:60px;" align="center">DATANG</td>
				<td style="font-size:9px; font-weight: bold; width:60px;" align="center">PULANG</td>
			</tr>

			<?php
				if (count($result)==0) {
					?>
					<tr style="height:25px;">
						<td align="center" colspan="8">Tidak Ada Data.</td>
					</tr>
					<?php 
				}
				else {
					for ($a=0; $a <count($result); $a++){
						if ($result[$a]->id_plant==$id_plant) {
							?>
								<tr style="height:25px;">
									<td align="center"><?php echo ($a+1); ?></td>
									<td><?php echo strtoupper($result[$a]->cNmPegawai);?></td>
									<td align="center"><?php echo strtoupper($result[$a]->cNmBag);?></td>
									<td style="width:60px;"></td>
									<td style="width:60px;"></td>
									<td align="center"><?php echo date_format(date_create($result[$a]->plan_start), 'H:i').' - '.date_format(date_create($result[$a]->plan_end), 'H:i'); ?></td>
									<td align="center"><?php echo strtoupper($result[$a]->job); ?></td>
									<td style="height:30px;"></td>
								</tr>
							<?php
						}					
					}
				}
				
			?>	
		</table>

		<br><br>

		<table>
			<tr>
				<th style="width:300px;">
					<table style="border-collapse: collapse;width:300px;font-size:9px;border: 1px solid black;">
						<tr>
							<td colspan="4">Tanggal : <?php print date ('d-M-Y'); ?></td>
						</tr>
						<tr>
							<td colspan="4" align="center">General Affair</td>
						</tr>
						<tr>
							<td align="center">Dibuat</td><td colspan="2" align="center">Dicek</td><td align="center">Disetujui</td>
						</tr>
						<tr>
							<td style="height:75px; width: 75px;"></td><td style="width:75px;"></td><td style="width:75px;"></td><td style="width:75px;"></td>
						</tr>
						<tr>
							<td align="center">ARI MELIANI</td><td align="center">LEO SANJAYA</td><td align="center">MAKI NAKAJIMA</td><td align="center">SAM FADIL ARDIANTO</td>
						</tr>
					</table>
				</th>
				<th style="width:120px;">
					&nbsp;
				</th>
				<th style="width:180px;" valign="top">
					<table style="border-collapse: collapse;width:100px;font-size:9px;border: 1px solid black;">
						<tr>
							<td style="width:60px; height:35px;" align="center">Dicek Security</td>
						</tr>
						<tr>
							<td style="height:50px;"></td>
						</tr>
						<tr>
							<td style="height:20px;"></td>
						</tr>
					</table>
				</th>
				<th style="width:35px;">
					&nbsp;
				</th>
				<th style="width:100px;" valign="top">
					<table style="border-collapse: collapse;width:100px;font-size:9px;border: 1px solid black;">
						<tr>
							<td style="width:60px; height:35px;" align="center">Dikembalikan Ke<br>GA</td>
						</tr>
						<tr>
							<td style="height:50px;"></td>
						</tr>
						<tr>
							<td align="center" style="height:20px;"></td>
						</tr>
					</table>
				</th>
			</tr>
		</table>
		<hr>
		<div style="width: 90%; font-size: 9px;"><?php echo "Print Date: ".date('d M Y H:i'); ?></div>
	</body>
</html>