            <div class="card">
				<div class="card-header  white">					
				<?php $query = DBRead('ecommerce_vendas', '*');?>
				<style type="text/css">.fixed-table-loading{display: none;}</style>
				<div class="card-body p-0">
						<div>
							<table id="BootstrapTable" data-toggle="table" data-pagination="true" data-locale="pt-BR" data-cache="false" data-search="true" data-show-export="true" data-export-data-type="all" data-export-types="['csv', 'excel', 'pdf']" data-mobile-responsive="true" data-click-to-select="true" data-toolbar="#toolbar" data-show-columns="true" class="table m-0 table-striped">
								<thead>
									<tr class="first-line">	
										<th class="text-center">Id da venda</th>									
										<th class="text-center">Comprador</th>
										<th class="text-center">Valor da venda</th>										
										<th>Ação</th>
									</tr>
								</thead>
								<tbody>	<?php foreach($query as $vhs => $mima):?>							
									<tr>
										<td class="text-center">
										<?php echo $mima['id'];?>
										</td>																			
										
										<td class="text-center">
										<?php echo $mima['nome'];?>											
										</td>

										<td class="text-center">
										<?php echo "R$ ".number_format($mima['valor'], 2, ",", ".");?>		
										</td>
										<td>
											<div class="dropdown">
												<a class="" href="#" data-toggle="dropdown">
													<i class="icon-apps blue lighten-2 avatar"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
													<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'configuraçao')) { ?>
													<a class="dropdown-item" onclick="DeletarItem(<?php echo $mima['id']; ?>, 'DeletarLead');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir</a>
													<?php } ?>
												</div>
											</div>
										</td>
									</tr>
								<?php endforeach ?>									
								</tbody>
							</table data-toggle="table">
						</div>
					</div>				
			</div>

<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/locale/bootstrap-table-pt-BR.min.js"></script>
<script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/FileSaver/FileSaver.min.js"></script>
<script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/js-xlsx/xlsx.core.min.js"></script>
<script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
<script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/tableExport.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/jquery.multifield.min.js"></script>
<script type="text/javascript" src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>assets/plugins/iconpicker/bootstrap-iconpicker.bundle.min.js"></script>