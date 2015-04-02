<ul>
   <li class='menu-group'><a href="<?php echo site_url('dashboard/' . $this->session->userdata('jms_job_type')); ?>"><span>Document</span></a>
        <ul class="menu-child">
            <li class="sub-menu"><a href="#"><input type="hidden" value="purchase_order" /><span>Purchase Order</span></a></li>
            <li><a href="#"><span>Good Receive</span></a></li>
            <li><a href="#"><span>Payment Receipt</span></a></li>
        </ul>
   </li>
   <li class='menu-group'><a href="<?php echo site_url('dashboard/' . $this->session->userdata('jms_job_type')); ?>"><span>Master Data</span></a>
        <ul class="menu-child">
            <li><a href="<?php echo site_url('report/cummulative'); ?>"><span>Product</span></a></li>
            <li><a href="<?php echo site_url('report/cummulative'); ?>"><span>Product Category</span></a></li>
        </ul>
   </li>
</ul>