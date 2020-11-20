<section class="content">
<form action="<?= BASE_ADMIN_URL . (isset($user) ? 'user?action=edit' : 'user/them-moi?action=add')  ?>" method="post" enctype="multipart/form-data">
    <div class="row">

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thông tin user</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputName">Username</label>
                    <input type="text" name="username" placeholder="Nhập username" class="form-control" <?= @(isset($user) ? 'disabled' : '') ?> value="<?= @$user['username'] ?>" />
                </div>
                <div class="form-group">
                    <label for="inputDescription">Họ tên</label>
                    <input type="text" name="fullname" placeholder="Nhập họ tên" class="form-control" value="<?= @$user['fullname'] ?>"/>
                </div>
                <div class="form-group">
                    <label for="inputDescription">Mật khẩu <?= @(isset($user) ? 'mới' : '')  ?></label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu" class="form-control"/>
                </div>
                <input type="hidden" name="id" class="form-control" value="<?= @$user['id'] ?>"/>
                <div class="form-group">
                    <label for="inputProjectLeader">Quyền hạn</label>
                    <select name="permission"  class="form-control">
                        <option value="1"  <?= @($user['is_admin'] == 1) ? 'selected' : '' ?>>Admin</option>
                        <option value="0" <?= @($user['is_admin'] == 0) ? 'selected' : '' ?>>Khách hàng</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

      
    </div>
    <?php if(isset($error)){ ?>
        <p class="bg-danger ui-draggable ui-draggable-handle" style="padding: 15px;"><?= @$error ?></p>
    <?php }?>
    <button type="submit" class="form-control submit_product btn-primary">Lưu</button>
    </form>
</section>
