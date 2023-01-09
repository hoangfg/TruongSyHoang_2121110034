<?php require_once('../views/backend/header.php'); ?>

<form action="index.php?option=customer&cat=process" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm danh mục</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Thêm danh mục</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Save[Thêm]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=customer">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php include_once('../views/backend/messageAlert.php') ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input name="username" id="username" type="text" class="form-control " required placeholder="vd: abcxyz123">
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input name="password" id="password" type="password" class="form-control " required placeholder="vd: t3wahSetyeT4">
                            </div>
                            <div class="mb-3">
                                <label for="password">Confirm password</label>
                                <input name="password_re" id="password_re" type="text" class="form-control " required placeholder="vd: t3wahSetyeT4">
                            </div>
                            <div class="mb-3">
                                <label for="password">Email</label>
                                <input name="email" id="email" type="email" class="form-control " required placeholder="vd: abc123xyz@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input name="phone" id="phone" type="tel" class="form-control " required placeholder="vd: 0918146697">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input name="name" id="name" type="text" class="form-control " required placeholder="vd: Hoàng Trương">
                            </div>
                            <div class="mb-3">
                                <label for="gender">Gender</label><br>
                                <input type="radio" name="gender" id="gender" value="0" checked="checked"><label for="0">Male</label>
                                <input type="radio" name="gender" id="gender" value="1"><label for="1">Female</label>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input name="address" id="address" type="text" class="form-control " required placeholder="vd: Đường Số 147Phước Long B, Quận 9, Thành phố Hồ Chí Minh">
                            </div>
                            <div class="mb-3">
                                <label for="image">Avatar</label>
                                <input name="image" id="image" type="file" class="form-control btn-sm">
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Kích hoạt</option>
                                    <option value="2">Chưa kích hoạt</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Save[Thêm]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=customer">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>

</form>

<?php require_once('../views/backend/footer.php'); ?>