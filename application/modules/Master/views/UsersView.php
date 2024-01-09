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
                                <label for="user_name" class="form-label">Username</label>
                                <input type="hidden" id="user_id" name="user_id">
                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="user_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="user_fullname" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="user_fullname" name="user_fullname" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="user_password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role_id" class="form-label">Role</label>
                                <select class="form-select" id="role_id" name="role_id">
                                    <option value="">Select role</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="user_status" class="form-label">User Status</label>
                                <select class="form-select" id="user_status" name="user_status">
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Role</th>
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