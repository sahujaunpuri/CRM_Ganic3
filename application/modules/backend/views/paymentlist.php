<section class="content-header">
  <div class="row">
    <div class="col-md-3">
      <h2>
        <?php echo ucwords($this->uri->segment(3)); ?> Payment
        <!-- <small>Preview of UI elements</small> --> 
      </h2>
    </div>
  </div>
  <?php 
    $list = array('active'=>ucwords($this->uri->segment(3)).' Payment');
    echo breadcrumb($list); 
    ?>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div id="message_area">
        <?php get_flash_message('message'); ?>
      </div>
      <div class='box box-primary' id='buttons_panel'>
        <div class='box-header'>
          <?php if($this->uri->segment(3)=="confirmed"): ?>
            <button class='btn btn-warning $btn_style' id='view'>
              <i class='fa fa-eye' aria-hidden='true'></i> View
            </button>
            <button class='btn btn-primary $btn_style' id='edit'>
              <i class='fa fa-pencil' aria-hidden='true'></i> Edit
            </button>
            <button class='btn btn-success $btn_style' id='post'>
              <i class='fa fa-check' aria-hidden='true'></i> Post
            </button> 
            <button class='btn btn-success $btn_style' id='post_all'>
              <i class='fa fa-check' aria-hidden='true'></i> POST ALL
            </button> 
            <button class='btn bg-maroon $btn_style' id='delete'>
              <i class='fa fa-trash' aria-hidden='true'></i> Delete
            </button> 
            <button class='btn bg-purple $btn_style' id='email'>
              <i class='fa fa-inbox' aria-hidden='true'></i> Send Email To Customer
            </button> 
            <button class='btn bg-navy $btn_style' id='print'>
              <i class='fa fa-print' aria-hidden='true'></i> Print
            </button> 
            <button class='btn btn-info $btn_style' id='refresh'>
              <i class='fa fa-refresh' aria-hidden='true'></i> Refresh
            </button> 
          <?php endif; ?>

          <?php if($this->uri->segment(3)=="posted"): ?>
            <button class='btn bg-navy $btn_style' id='print'>
              <i class='fa fa-print' aria-hidden='true'></i> Print
            </button> 
            <button class='btn btn-info $btn_style' id='refresh'>
              <i class='fa fa-refresh' aria-hidden='true'></i> Refresh
            </button> 
          <?php endif; ?>
          <?php if($this->uri->segment(3)=="deleted"): ?>
            <button class='btn bg-navy $btn_style' id='print'>
              <i class='fa fa-print' aria-hidden='true'></i> Print
            </button> 
            <button class='btn btn-info $btn_style' id='refresh'>
              <i class='fa fa-refresh' aria-hidden='true'></i> Refresh
            </button> 
          <?php endif; ?>
          
          
        </div>
      </div>
      <div class="box box-warning">
        <div class="box-body">
          <div id="list_table">
                <table class="table " id="datatable" width="100%">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Payment Reference No</th>
                      <th>Supplier</th>
                      <th>Bank</th>
                      <th>Cheque</th>
                      <th>Other Reference </th>
                      <th>Amount</th>
                      <th>Purchase Invoices</th>
                      <th>Created On</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <form autocomplete="off"method="post" action="#" enctype="multipart/form-data" class="validate">
                <div id="form_data"></div>
              </form>
           </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  jQuery(document).ready(function() {
    hideButtons();
    clearMessages();
    var form = $("form");
    var form_action = '';
    var url = '';
    table = $('#datatable').DataTable({ 
    "scrollX": true,
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [[0,"desc"]], //Initial no order.
  
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo base_url('common/datatable/ajax_list/payment_list/').$this->uri->segment(3); ?>",
      "type": "POST"
    },
  
    //Set column definition initialisation properties.
    "columnDefs": [
    { 
        "targets": [], //index no. of column
        "orderable": false, //set not orderable
      },
      { 
        "targets": [0], //index no. of column
        "visible": false, //set not orderable
      },
      ],
  
    });

    // ==================== magic goes here ============================================
    /* delete button */
     $("#delete").on('click',function(){
      var url = '<?php echo base_url()."common/Ajax/backend_ajax/delete_payment" ?>';
        showData("delete",url);
     });
     /*... over here ...*/

     /* confirm button */
     $("#post").on('click',function(){
      var url = '<?php echo base_url()."common/Ajax/backend_ajax/post_payment" ?>';
        showData("confirm",url);
     });

     $("#post_all").on('click',function(){
      var url = '<?php echo base_url()."common/Ajax/backend_ajax/post_payment" ?>';
        table.rows().select();
        showData("All Confirm",url);
     });
     /*... over here ...*/

     /* reject button */
     $("#reject").on('click',function(){
      var url = '<?php echo base_url()."common/Ajax/receiptlist_ajax/reject" ?>';
        showData("reject",url);
     });
     /*... over here ...*/

     /* view button */
     $("#view").on('click',function(){
        var url = '<?php echo base_url()."backend/payment_manage/view/" ?>';
        showData("receipt_view",url);
     });
     /*... over here ...*/
 
     /* edit button */
     $("#edit").on('click',function(){
        var url = '<?php echo base_url()."backend/payment_manage/edit/" ?>';
        showData("receipt_edit",url);
     });
     /*... over here ...*/

    /* email button */
     $("#email").on('click',function(){
        var url = '<?php echo base_url()."common/Ajax/receiptlist_ajax/print_receipt/email" ?>';
        showData("email",url);
     });
     /*... over here ...*/

     /* print button */
     $("#print").on('click',function(){
        var url = '<?php echo base_url()."common/Ajax/receiptlist_ajax/print_receipt" ?>';
        showData("print",url);
     });
     /*... over here ...*/
  });
</script>