<!-- Today 
                <div class="row" style="margin-bottom:15px;">
                    
                    <div id="filtrag" class="col-md-12 col-sm-12" style="text-align:left;">
                        
                        <div class="row">
                        <div class="col-md-6 col-sm-12" style="padding-left:0;">
                        <ul class="filterlinks">
                            <li><h3><a href="javascript:void(0);" onclick="jQuery.filtr('Most Recent');" class="sel">RECENT</h3></a></li>
                            <li><h3><a href="javascript:void(0);" onclick="jQuery.filtr('Most Popular');">POPULAR</h3></a></li>
                            <?php if($this->session->userdata('logged_in')) { ?><li><h3><a href="javascript:void(0);" onclick="jQuery.filtr('Feed');">FOLLOW FEED</h3></a></li><?php } ?>
                            <li><h3><a href="javascript:void(0);" onclick="jQuery.filtr('Most Voted');">VOTED</h3></a></li>
                            <li><h3><a href="javascript:void(0);" onclick="jQuery.filtr('Most Comment');">COMMENTS</h3></a></li>
                        </ul>
                        </div>
                        <div class="col-md-2 col-sm-12" style="min-height: 35px;">
                        <div id="dayfilter" class="dropdown">
                          <button class="filterposts dropdown-toggle" style="padding-right:0;" type="button" data-toggle="dropdown"><span class="txt"><?php echo $this->lang->line('alltime_text'); ?></span>
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('All');"><?php echo $this->lang->line('alltime_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Today');"><?php echo $this->lang->line('today_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Yesterday');"><?php echo $this->lang->line('yesterday_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Week');"><?php echo $this->lang->line('week_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Month');"><?php echo $this->lang->line('month_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Year');"><?php echo $this->lang->line('year_text'); ?></a></li>                            
                          </ul>
                        </div>
                        </div>

                        <div class="col-md-4 col-sm-12" style="padding-right:0;">
                            

                            

                        </div>

                    </div>
                </div>
                <br />-->