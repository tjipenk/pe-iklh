
									<table class="table datatable table-striped" id="datatable">
                                        <thead>
                                            <tr>
                                                <th align="right">Option</th>
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
                                                    <td>
														<a style="cursor:pointer;" class="removerutilizador" onclick="delete_sungai(<?=$pub['id']?>)"><span class="label label-danger">Hapus</span></a> | 
														<a style="cursor:pointer;" class="editstory" href="<?php echo base_url(); ?>admin_prov/editsungai/<?php echo $pub['id']; ?>"><span class="label label-warning">Edit</span></a>
													</td>
                                                    <td><?php echo $pub['sungai']; ?></td>
                                                    <td class="hidden-sd hidden-xs"><?php echo $this->admin_model->get_nama_wilayah($pub['id_prov'])[0]['nama']; ?></td>
                                                   													
                                                    <td class="hidden-sd hidden-xs"><?php echo $pub['lintang']."; ".$pub['bujur']; ?></td>															
                                                    <td class="hidden-sd hidden-xs"><?php echo $pub['lokasi']; ?></td>															
                                                </tr>       
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
	