<div class="table-responsive">
	<table id="tableusuario"  class="table table-striped">
		<!-- Cabecera de la Tabla -->
		<thead class="thead-dark">
			<tr>
				<th scope="col">Ciudad</th>
				<th scope="col">Descripcion</th>
                <th scope="col">Temperatura C°</th>
				<th scope="col">Fecha de consulta</th>				
			</tr>
		</thead>
	
		<!-- Cuerpo de la Tabla -->
		<tbody> 
			
				<?php $ct = 0;
					foreach ($this->weather->Select($_SESSION['SUid']) as $rows): 					
					?>

					<tr>
						<td scope="row"><?php echo $rows->city; ?></td>
						<td scope="row"><?php echo $rows->weather_desc; ?></td>
						<td scope="row"><?php echo $rows->temperature; ?> </td>
                        <td scope="row"><?php echo $rows->date_log;?></td>
					</tr>

				<?php endforeach;?>
		</tbody>
	</table>
</div>