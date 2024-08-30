<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\Modal;

$this->title = 'User Management';
?>

<div class="container-fluid py-4">
    <h1 class="dashboard-title text-center mb-5"><?= Html::encode($this->title) ?></h1>

    <!-- Create User Button -->
    <div class="row mb-4">
        <div class="col-md-12 text-end">
            <?= Html::a('<i class="fas fa-user-plus"></i> Create New User', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <!-- User Table -->
    <div class="card shadow-sm p-4">
        <div class="user-index table-responsive">
            <table class="table table-hover table-striped table-bordered align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= Html::encode($user['id']) ?></td>
                            <td><?= Html::encode($user['username']) ?></td>
                            <td><?= Html::encode($user['email']) ?></td>
                            <td><?= Html::encode(date('Y-m-d H:i:s', $user['created_at'])) ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <?= Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $user['id']], [
                                        'class' => 'btn btn-outline-info btn-sm',
                                        'title' => 'View',
                                        'role' => 'button',
                                    ]) ?>
                                    <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id' => $user['id']], [
                                        'class' => 'btn btn-outline-primary btn-sm',
                                        'title' => 'Update',
                                        'role' => 'button',
                                    ]) ?>
                                    <button class="btn btn-outline-danger btn-sm" title="Delete" onclick="showDeleteModal(<?= Html::encode($user['id']) ?>)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Delete Confirmation -->
<?php
Modal::begin([
    'id' => 'deleteModal',
    'title' => '<h4 class="modal-title text-danger">Confirm Deletion</h4>',
    'footer' => Html::button('Cancel', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal'])
        . Html::button('Delete', ['class' => 'btn btn-danger', 'id' => 'confirm-delete']),
    'size' => Modal::SIZE_DEFAULT,
    'options' => ['class' => 'modal-dark'], // Adding a dark theme for modal
]);
?>

<p class="text-center">Are you sure you want to delete this user? This action cannot be undone.</p>

<?php Modal::end(); ?>

<!-- Inline JavaScript -->
<script>
function showDeleteModal(userId) {
    $('#deleteModal').modal('show');
    $('#confirm-delete').data('user-id', userId);
}

$('#confirm-delete').on('click', function() {
    const userId = $(this).data('user-id');
    const url = '<?= Url::to(['delete']) ?>?id=' + userId;
    $.post(url, function() {
        location.reload();  // Reload the page after deletion
    }).fail(function() {
        alert('Error occurred while trying to delete the user. Please try again.');
    });
});
</script>

<!-- Styling -->
<style>
    .dashboard-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .table thead th {
        background-color: #f8f9fa;
        color: #333;
        text-align: center;
    }

    .table tbody td {
        vertical-align: middle;
        text-align: center;
    }

    .btn-group .btn {
        border-radius: 50px;
        margin: 0 2px;
        font-size: 0.85rem;
    }

    .btn-outline-info {
        border-color: #17a2b8;
        color: #17a2b8;
    }

    .btn-outline-info:hover {
        background-color: #17a2b8;
        color: white;
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .modal-dark .modal-content {
        background-color: #343a40;
        color: white;
    }

    .modal-dark .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .modal-dark .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .modal-dark .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .modal-dark .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
</style>
