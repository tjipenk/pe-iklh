
									<table class="table datatable table-striped" id="datatable">
                                        <thead>
                                            <tr>
                                                <th colspan="2" align="right"></th>
                                                <th>Kode Sungai</th>
                                                <th class="hidden-sd hidden-xs">Provinsi</th>
												<th class="hidden-sd hidden-xs">Koordinat</th>
												<th class="hidden-sd hidden-xs">Lokasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
										<?php if (count($sungai)>0): ?>
                                            <?php foreach($sungai as $pub): ?>
                                                <tr data-id="<?php echo $pub['id']; ?>">
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php echo $pub['sungai']; ?></td>
                                                    <td class="hidden-sd hidden-xs"><?php echo $this->lap_prov_model->get_nama_wilayah($pub['id_prov'])[0]['nama']; ?></td>
                                                   													
                                                    <td class="hidden-sd hidden-xs"><?php echo $pub['lintang']."; ".$pub['bujur']; ?></td>															
                                                    <td class="hidden-sd hidden-xs"><?php echo $pub['lokasi']; ?></td>															
                                                </tr>       
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
	