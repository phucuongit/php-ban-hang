<section class="content">
<form action="/admin/user/them-moi?action=add" method="post" enctype="multipart/form-data">
    <div class="row">

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thông tin user</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputName">Username</label>
                    <input type="text" name="username" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="inputDescription">Họ tên</label>
                    <input type="text" name="fullname" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="inputDescription">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="inputProjectLeader">Quyền hạn</label>
                    <select name="permission"  class="form-control">
                        <option value="1">Admin</option>
                        <option value="0">Khách hàng</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

      
    </div>
    <?php if(isset($error)){ ?>
        <p class="bg-danger ui-draggable ui-draggable-handle" style="padding: 15px;"><?= @$error ?></p>
    <?php }?>
    <button type="submit" class="form-control submit_product btn-primary">Save</button>
    </form>
</section>
