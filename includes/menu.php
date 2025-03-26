<?php
echo '
<div id="menu" class="menu">
<br>
 <center><a href="https://'.$domain.'/leads/admin.php"><img src="https://www.liveandinvestoverseas.com/wp-content/uploads/2017/07/LIO-slogan-newsite.png" width="220" class="img-menu" style="margin-left: -20px;"/> </center></a>
 
	<!-- Contenedor -->
	<ul id="accordion" class="accordion">
		<li class="'.$pro_drop.'">
			<div class="link"><i class="fa fa-tasks"></i>Projects<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="https://'.$domain.'/leads/projects/list-project.php">Projects</a></li>
				<li><a href="https://'.$domain.'/leads/projects/add-project.php">Create New</a></li>
				<li><a href="https://'.$domain.'/leads/projects/update-project.php">Update Project</a></li>
				 
			</ul>
		</li>
		<li class="'.$lead_drop.'">
			<div class="link"><i class="fa fa-database"></i>Leads<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="https://'.$domain.'/leads/list/list-leads.php">Leads</a></li>
				 
			</ul>
		</li>
		<li>
			<div class="link"><i class="fa fa-user"></i>User Profile<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="#">Profile</a></li>
				
			</ul>
		</li>
		<li><div class="link"><i class="fa fa-pie-chart"></i>Reporting<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="https://'.$domain.'/leads/reporting/filter-1.php">Filter #1</a></li>
				
			</ul>
		</li>
	</ul>

</div>'
?>