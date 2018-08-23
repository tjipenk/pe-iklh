
									<table class="" id="datatable">
                                        <thead>
                                            <tr>
                                                <th align="right">Option</th>
                                                <th hidden>Provinsi</th>
                                                <th>Lokasi</th>
                                                <th>Tanggal</th>
                                                <th>TSS</th>
												<th>DO</th>
												<th>BOD</th>
												<th>COD</th>
												<th>T-F</th>
												<th>Fecal Coli</th>
												<th>Total Coli</th>
												<th>File</th>
												<th>IKA</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            
										<?php if (count($sungai)>0): ?>
                                            <?php foreach($sungai as $pub): ?>
                                                <tr data-id="<?php echo $pub['id_sungai']; ?>">
													<?php
														if($pub['validated'] == 0){
													?>
                                                            <td class=""><a style="cursor:pointer;" class="removerutilizador" onclick="reject(<?=$pub['id_sungai']?>)"><span class="label label-danger">Tolak</span></a> | <a style="cursor:pointer;" class="editstory" onclick="validate(<?=$pub['id_sungai']?>)"><span class="label label-warning">Validasi</span></a></td>
                                                            
													<?php
														}
														else{
													?>
															<td><i>Tervalidasi</i></td>
													<?php
														}
													?>
                                                            <td hidden><?php echo $pub['nama']; ?></td>
                                                            <td><?php echo $pub['kode_sungai'].'; '.$pub['lokasi']; ?></td>
                                                            <td><?php echo $pub['tanggal']; ?></td>
                                                            <td><?php echo $pub['tss'];?></td>
                                                            <td><?php echo $pub['do'];?></td>																				
                                                            <td><?php echo $pub['bod'];?></td>																				
                                                            <td><?php echo $pub['cod'];?></td>																				
                                                            <td><?php echo $pub['tf'];?></td>																				
                                                            <td><?php echo $pub['fcoli'];?></td>
                                                            <td><?php echo $pub['tcoli'];?></td>																				
                                                            <td align='center'><?php if($pub['file']=='kosong') { ?>
                                                                <strong>No File</strong>
                                                                <?php } else { ?>
                                                                <a href="<?php echo base_url(); ?>upload/<?php echo $pub['file']; ?>" target="_blank"><img src="<?php echo base_url(); ?>images/file-icon.png" height="30px" width="30px" alt="View Data" title="View Data"  /></a>
                                                                <?php } ?></td>		
                                                                 																				
                                                            <td align='center'><?php if($pub['validated']==0) {
                                                                echo "diverifikasi";
                                                            }
                                                            else {echo ($this->admin_model->hitung_ika($pub['id_sungai'])['ika'] );
                                                            } ?></td>															
                                                        </tr>        
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
	