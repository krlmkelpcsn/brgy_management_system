				<style type="text/css">
					.show2 {
						background-color: <?php echo $secondary_color; ?>!important;
						color: white;
					}
					.txtclr {
						color: <?php echo $secondary_color; ?>!important;
					}
				</style>
				<nav class="ttr-sidebar-navi">
					<ul>
						<li style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px; background-color: #e0e0e0; margin-top: 0px; margin-bottom: 0px;">
							<span class="ttr-label" style="color: black; font-weight: 500;">Main Navigation</span>
						</li>


                        
                        
                        <?php

                        $rows = $model->count_Inquries();
						if (!empty($rows)) {
							foreach ($rows as $row) {
								$unread = $row['unread'];
								$read = $row['read_already'];
								$total_inq = $unread + $read;
							}
					  	}

                        if ($position_id == 0) {
						?>
						
						
						
						
						
						
						
						<li class="" style="margin-top: 0px;">
							<a href="index" class="ttr-material-button <?php echo ($page == 'dashboard') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-home <?php echo ($page == 'dashboard') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'dashboard') ? "show2" : ""; ?>">Dashboard</span>
							</a>
						</li>

						<li>
							<a href="announcement" class="ttr-material-button <?php echo ($page == 'announcement') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-announcement <?php echo ($page == 'announcement') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'announcement') ? "show2" : ""; ?>">Announcements</span>
							</a>
						</li>

						<li>
							<a href="event" class="ttr-material-button <?php echo ($page == 'event') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-comment <?php echo ($page == 'event') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'event') ? "show2" : ""; ?>">Events</span>
							</a>
						</li>
						<li>
							<a href="officials" class="ttr-material-button <?php echo ($page == 'officials') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-user <?php echo ($page == 'officials') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'officials') ? "show2" : ""; ?>">Officials</span>
							</a>
						</li>
						<li>
							<a href="staffs" class="ttr-material-button <?php echo ($page == 'staffs') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-user <?php echo ($page == 'staffs') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'staffs') ? "show2" : ""; ?>">Staffs</span>
							</a>
						</li>
						<li>
							<a href="purok-leaders" class="ttr-material-button <?php echo ($page == 'pleaders') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-user <?php echo ($page == 'pleaders') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'pleaders') ? "show2" : ""; ?>">Purok Leaders</span>
							</a>
						</li>


                        <li>
							<a href="issuance" class="ttr-material-button <?php echo ($page == 'issuance') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-book <?php echo ($page == 'issuance') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'issuance') ? "show2" : ""; ?>">Issuance Details</span>
							</a>
						</li>

						<li>
							<a href="content-management" class="ttr-material-button <?php echo ($page == 'content') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-harddrives <?php echo ($page == 'content') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'content') ? "show2" : ""; ?>">Content Management</span>
							</a>
						</li>

                        <li class="<?php echo ($page == 'records') ? "show" : ""; ?>">
							<a href="#" class="ttr-material-button <?php echo ($page == 'records') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-agenda <?php echo ($page == 'records') ? "show2" : ""; ?>"></i></span>
			                	<span class="ttr-label <?php echo ($page == 'records') ? "show2" : ""; ?>">Records</span>
			                	<span class="ttr-arrow-icon"><i class="fa fa-angle-down <?php echo ($page == 'records') ? "show2" : ""; ?>"></i></span>
			                </a>
			                <ul>
			                	<li>
			                		<a href="blotters" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'blotters') ? "txtclr" : ""; ?>">Hearing/Summoning</span></a>
			                	</li>
			                	<li>
			                		<a href="residents" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'residents') ? "txtclr" : ""; ?>">Residents Management</span></a>
			                	</li>
			                	<li>
									
								<a href="households" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'households') ? "txtclr" : ""; ?>">Households Management</span></a>
								</li>
 								<li>
			                		<a href="residents-pending" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'pending') ? "txtclr" : ""; ?>">Pending Residents</span></a>
			                	</li>
			                </ul>
			            </li>
                        
                        <li>
							<a href="request-monitoring" class="ttr-material-button <?php echo ($page == 'request') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-file <?php echo ($page == 'request') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'request') ? "show2" : ""; ?>">Monitoring of Request</span>
							</a>
						</li>

						<li class="" style="margin-top: 0px;">
							<a href="inquiries" class="ttr-material-button <?php echo ($page == 'inquries') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-help <?php echo ($page == 'inquries') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'inquries') ? "show2" : ""; ?>">Inquiries <span class="badge badge-primary"><?php echo $unread; ?></span> </span>
							</a>
						</li>
						<!-- <li class="<?php echo ($page == 'inventory') ? "show" : ""; ?>">
							<a href="#" class="ttr-material-button <?php echo ($page == 'inventory') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-list <?php echo ($page == 'inventory') ? "show2" : ""; ?>"></i></span>
			                	<span class="ttr-label <?php echo ($page == 'inventory') ? "show2" : ""; ?>">Inventory Management</span>
			                	<span class="ttr-arrow-icon"><i class="fa fa-angle-down <?php echo ($page == 'inventory') ? "show2" : ""; ?>"></i></span>
			                </a>
			                <ul>
			                	<li>
			                		<a href="equipments" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'equipments') ? "txtclr" : ""; ?>">Equipments</span></a>
			                	</li>
			                	<li>
			                		<a href="borrowed" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'borrowed') ? "txtclr" : ""; ?>">Borrow Equipments</span></a>
			                	</li>
			                	<li>
			                		<a href="reports" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'reports') ? "txtclr" : ""; ?>">Lost Equipments</span></a>
			                	</li>
			                </ul>
			            </li> -->
						
						
						
						
						
						
						
						
						
						<?php
						}
						else {
						?>
						
						
						
						
						
						
						
						
						
						<li class="" style="margin-top: 0px;">
							<a href="index" class="ttr-material-button <?php echo ($page == 'dashboard') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-home <?php echo ($page == 'dashboard') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'dashboard') ? "show2" : ""; ?>">Dashboard</span>
							</a>
						</li>




                        <li class="<?php echo ($page == 'records') ? "show" : ""; ?>">
							<a href="#" class="ttr-material-button <?php echo ($page == 'records') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-agenda <?php echo ($page == 'records') ? "show2" : ""; ?>"></i></span>
			                	<span class="ttr-label <?php echo ($page == 'records') ? "show2" : ""; ?>">Records</span>
			                	<span class="ttr-arrow-icon"><i class="fa fa-angle-down <?php echo ($page == 'records') ? "show2" : ""; ?>"></i></span>
			                </a>
			                <ul>
			                	<li>
			                		<a href="blotters" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'blotters') ? "txtclr" : ""; ?>">Hearing/Summoning</span></a>
			                	</li>
			                	<li>
			                		<a href="residents" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'residents') ? "txtclr" : ""; ?>">Residents Management</span></a>
			                	</li>
								<li>
									
									<a href="households" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'households') ? "txtclr" : ""; ?>">Households Management</span></a>
									</li>
			                	<li>
			                		<a href="residents-pending" class="ttr-material-button"><span class="ttr-label <?php echo ($secondnav == 'pending') ? "txtclr" : ""; ?>">Pending Residents</span></a>
			                	</li>
			                </ul>
			            </li>
                        
                        <li>
							<a href="request-monitoring" class="ttr-material-button <?php echo ($page == 'request') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-file <?php echo ($page == 'request') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'request') ? "show2" : ""; ?>">Monitoring of Request</span>
							</a>
						</li>

 				
					
						<li class="" style="margin-top: 0px;">
							<a href="inquiries" class="ttr-material-button <?php echo ($page == 'inquries') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-help <?php echo ($page == 'inquries') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'inquries') ? "show2" : ""; ?>">Inquiries <span class="badge badge-primary"><?php echo $unread; ?></span> </span>
							</a>
						</li>

						
						
						
						
						
						
						<?php
						}
                        ?>


















									




						<li class="ttr-seperate"></li>
						<br><br><br><br>
					</ul>
				</nav>

















			<!-- 	<nav class="ttr-sidebar-navi">
					<ul>
						<li style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px; background-color: #e0e0e0; margin-top: 0px; margin-bottom: 0px;">
							<span class="ttr-label" style="color: black; font-weight: 500;">Main Navigation</span>
						</li>




						<li>
							<a href="#" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-harddrives"></i></span>
			                	<span class="ttr-label">Content Management</span>
			                	<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
			                </a>
			                <ul>
			                	<li>
			                		<a href="content-management" class="ttr-material-button"><span class="ttr-label">Story, Logo, Vision, Mission</span></a>
			                	</li>
			                	<li>
			                		<a href="org-structure" class="ttr-material-button"><span class="ttr-label">Org. Structure</span></a>
			                	</li>
			                	<li>
			                		<a href="guidelines" class="ttr-material-button"><span class="ttr-label">Guidelines</span></a>
			                	</li>
			                	<li>
			                		<a href="instructions" class="ttr-material-button"><span class="ttr-label">Services</span></a>
			                	</li>
			                	<li>
			                		<a href="contact" class="ttr-material-button"><span class="ttr-label">Contacts</span></a>
			                	</li>
			                </ul>
			            </li>


						<li>
							<a href="settings" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-settings"></i></span>
								<span class="ttr-label">Settings</span>
							</a>
						</li>
						<li class="ttr-seperate"></li>
					</ul>
				</nav> -->