<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1><?= $titleName; ?></h1>
                <!-- <span>Customized Bootstrap forms to match Neptune's styles.</span> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form • <?= $titleName; ?></h5>
                </div>
                <div class="card-body">
                    <form id="form" method="post" class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role_name" class="form-label">Role</label>
                                <input type="hidden" id="role_id" name="role_id">
                                <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Role">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="redirect_to" class="form-label">Redirect To</label>
                                <input type="text" class="form-control" id="redirect_to" name="redirect_to" placeholder="Redirect To">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role_status" class="form-label">Role Status</label>
                                <select class="form-select" id="role_status" name="role_status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="btnCancel" type="button" class="btn btn-default">Cancel</button>
                            <button id="btnSubmit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= $titleName; ?> Data </h5>
                </div>
                <div class="card-body">
                    <table id="table-data" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Role</th>
                                <th>Redirect To</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Role</th>
                                <th>Redirect To</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>