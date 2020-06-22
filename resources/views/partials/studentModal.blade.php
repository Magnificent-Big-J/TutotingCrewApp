<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4" >Full Name : </label>
                        <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Email: </label>
                        <div class="col-md-8">
                            <input type="text" name="email" id="email" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Phone Number: </label>
                        <div class="col-md-8">
                            <input type="text" name="phone" id="phone" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Location: </label>
                        <div class="col-md-8">
                            <input type="text" name="location" id="location" class="form-control" />
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
