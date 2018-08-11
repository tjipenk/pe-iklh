<div class="container" id="pagecontent">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3">
                    <div class="account-wall">                        
                        
                        <h3>Tambah petugas</h3>
                        <br />
                        <i class="user-img icons-faces-users-03"></i>
                        <?php echo form_open(base_url()."/user/registerdata",array("method"=>"POST"));?>
                 
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="name" class="form-control form-white" placeholder="Nama depan" required="" autofocus="">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="lastname" class="form-control form-white lastname" placeholder="Nama belakang" >
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="slug" name="slug" id="slug" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_slug'); ?>" required="">                           
                            </div>
                            

                            <div class="append-icon" style="margin-top:10px;">
                                <p>Kecamatan tempat bertugas
                                <select name="kecamatan"  class="form-control form-white password">
                                   <?php

                                   foreach ($kecamatan as $key => $value) {
                                    ?>

                                        <option value="<?php echo $value['id'];?>"><?php echo $value['nama'];?></option>
                                    <?php
                                       # code...
                                   }
                                   ?>
                                </select>
                             
                            </div>
                            <hr/>


                            <div class="append-icon" style="margin-top:10px;">
                                <input type="password" name="password" class="form-control form-white password" placeholder="<?php echo $this->lang->line('input_password'); ?>" required="">
                                <i class="icon-lock"></i>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="password" name="password2" class="form-control form-white password2" placeholder="Konfirmasi password" required="">
                                <i class="icon-lock"></i>
                            </div>
                            

                           
                          

                            <div class="clearfix" style="margin-top: 40px">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <p class="pull-left m-t-20">

                                    <button type="submit" id="submit-form" class="button btn m-t-20 button-green"><?php echo $this->lang->line('register_button'); ?></button></p>
                                <p class="pull-right m-t-20"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line('cancel_button'); ?></a></p>
                            </div>

                           

                        </form>
                    </div>
                </div>
            </div>
            
        </div>
