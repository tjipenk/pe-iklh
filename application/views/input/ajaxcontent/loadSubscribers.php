<table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
												<th>E-mail</th>                                                										
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                        <?php if (count($categories)>0): ?>

                                                        

                                                        <?php foreach($categories as $pub): ?>

                                                        <tr data-id="<?php echo $pub['id']; ?>">
                                                            <th></th>
                                                            <td><?php echo $pub['firstname']." ".$pub['lastname']; ?></td>
                                                            <td><?php echo $pub['email']; ?></td>															
                                                        </tr>                                                        
                                                        
                                                        <?php endforeach; ?>
                                                        

                                                    <?php else: ?>

                                                    No categories.

                                                    <?php endif; ?>


                                        </tbody>
                                    </table>
									