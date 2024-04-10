
<!--

<div class="modal fade" id="modal-default-quo">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Quotation</h4>
              </div>
              <div class="modal-body-quo">
               


              </div>
            
            </div>
           /.modal-content 
          </div>
          /.modal-dialog 
        </div>
         /.modal 
        -->

        <div class="modal modal-primary fade" id="modal-primary-quo">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="invoice">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">QUOTATION FOR  <?php  echo $class_desc.' - '.$product_desc; ?></h4>
               By  <?php echo $_SESSION['me_fname'].' '.$_SESSION['me_sname']; ?>
              </div>
             
              <div class="modal-body-quo" >
          


               </div>
              
             
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
