<?php
	use yii\helpers\Html;
	use app\components\Helper;
?>
<h3 class="center">Daftar Penerbit</h3>
<table class="table-pdf" style="margin:auto; width:100%;">
	<thead>
		<tr>
			<th><?= strtoupper("No") ?></th>
			<th><?= strtoupper("Nama") ?></th>
			<th><?= strtoupper("Alamat") ?></th>
			<th><?= strtoupper("Telepon") ?></th>
			<th><?= strtoupper("email") ?></th>
			
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($model as $data){ ?>
		<tr>
			<td><?= $i ?></td>
			<td><?= $data->nama ?></td>
			<td><?= $data->alamat ?></td>
			<td><?= $data->telepon ?></td>
			<td><?= $data->email ?></td>
		</tr>
		<?php $i++; }?>
	</tbody>
</table>