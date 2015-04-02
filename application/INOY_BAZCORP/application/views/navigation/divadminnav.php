<ul>
   <li class='active'><a href="<?php echo site_url('dashboard/' . $this->session->userdata('jms_job_type')); ?>"><span>Dashboard</span></a></li>
	<li class='has-sub'><a href='#'><span>Report</span></a>
      <ul>
         <li><a href="<?php echo site_url('report/cummulative'); ?>"><span>Cummulative Chart</span></a></li>
         <li><a href="<?php echo site_url('report/incremental/week/' . date('Y')); ?>"><span>Incremental Chart</span></a></li>
         <li class='last'><a href="<?php echo site_url('report/summary/9000/' . date('Y')); ?>"><span>Summary Chart</span></a></li>
      </ul>
   </li>
</ul>
