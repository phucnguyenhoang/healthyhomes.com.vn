<?php $isEdit = !empty($post['id']); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title mb-0">
        <i class="fas fa-<?php echo $isEdit ? 'edit' : 'plus-circle'; ?> mr-2 text-secondary"></i>
        <?php echo $isEdit ? 'Edit Post' : 'New Post'; ?>
    </h2>
    <a href="<?php echo base_url('admin/blogs'); ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to list
    </a>
</div>

<?php if (!empty($error)): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <i class="fas fa-exclamation-triangle mr-1"></i> <?php echo htmlspecialchars($error); ?>
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data"
      action="<?php echo base_url($isEdit ? 'admin/blogs/edit/' . $post['id'] : 'admin/blogs/create'); ?>">

<div class="row">
    <!-- Main column -->
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label class="font-weight-bold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control"
                           value="<?php echo htmlspecialchars($post['title'] ?? ''); ?>"
                           placeholder="Post title" required>
                </div>

                <div class="form-group mb-0">
                    <label class="font-weight-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="Short summary shown in post listings..."><?php echo htmlspecialchars($post['description'] ?? ''); ?></textarea>
                    <small class="text-muted">This text appears in post cards and as the meta description fallback.</small>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white font-weight-bold">
                <i class="fas fa-align-left mr-1 text-secondary"></i> Content
            </div>
            <div class="card-body">
                <textarea id="content" name="content"><?php echo $post['content'] ?? ''; ?></textarea>
            </div>
        </div>

    </div>

    <!-- Sidebar column -->
    <div class="col-lg-4">

        <!-- Publish -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white font-weight-bold">
                <i class="fas fa-toggle-on mr-1 text-secondary"></i> Publish
            </div>
            <div class="card-body">
                <div class="form-group mb-0">
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="statusDraft" name="status" value="0" class="custom-control-input"
                               <?php echo (($post['status'] ?? 0) == 0) ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="statusDraft">
                            <span class="badge badge-warning text-dark">Draft</span>
                            <small class="text-muted d-block">Not visible to public</small>
                        </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="statusPublish" name="status" value="1" class="custom-control-input"
                               <?php echo (($post['status'] ?? 0) == 1) ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="statusPublish">
                            <span class="badge badge-success">Published</span>
                            <small class="text-muted d-block">Visible at /bai-viet</small>
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white text-right">
                <button type="submit" class="btn btn-dark btn-sm px-4">
                    <i class="fas fa-save mr-1"></i> <?php echo $isEdit ? 'Update' : 'Save'; ?>
                </button>
            </div>
        </div>

        <!-- Thumbnail -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white font-weight-bold">
                <i class="fas fa-image mr-1 text-secondary"></i> Thumbnail
            </div>
            <div class="card-body">
                <?php if (!empty($post['thumbnail'])): ?>
                <div class="mb-2">
                    <img src="<?php echo $post['thumbnail']; ?>" class="img-fluid rounded" id="thumbPreview" alt="Current thumbnail">
                </div>
                <?php else: ?>
                <div class="text-center text-muted py-2 mb-2" id="thumbPlaceholder">
                    <i class="fas fa-image fa-2x"></i><br><small>No thumbnail</small>
                </div>
                <img src="" class="img-fluid rounded d-none" id="thumbPreview" alt="Thumbnail preview">
                <?php endif; ?>
                <input type="file" name="thumbnail" class="form-control-file" id="thumbInput"
                       accept="image/*">
                <small class="text-muted">Images wider than 1024px will be resized automatically.</small>
            </div>
        </div>

        <!-- Tags -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white font-weight-bold">
                <i class="fas fa-tags mr-1 text-secondary"></i> Tags
            </div>
            <div class="card-body">
                <input type="text" name="tags" class="form-control"
                       value="<?php echo htmlspecialchars($post['tags'] ?? ''); ?>"
                       placeholder="news, tips, product">
                <small class="text-muted">Comma-separated tags.</small>
            </div>
        </div>

        <!-- SEO -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white font-weight-bold">
                <i class="fas fa-search mr-1 text-secondary"></i> SEO
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="small font-weight-bold">SEO Keywords</label>
                    <input type="text" name="seo_keywords" class="form-control form-control-sm"
                           value="<?php echo htmlspecialchars($post['seo_keywords'] ?? ''); ?>"
                           placeholder="keyword1, keyword2">
                </div>
                <div class="form-group mb-0">
                    <label class="small font-weight-bold">Meta Description</label>
                    <textarea name="meta_description" class="form-control form-control-sm" rows="3"
                              placeholder="Meta description for search engines (max 300 chars)"
                              maxlength="300"><?php echo htmlspecialchars($post['meta_description'] ?? ''); ?></textarea>
                    <small class="text-muted">Leave blank to use the Description field.</small>
                </div>
            </div>
        </div>

    </div><!-- /col-lg-4 -->
</div>
</form>

<script>
// Thumbnail preview
document.getElementById('thumbInput').addEventListener('change', function () {
    var file = this.files[0];
    if (!file) return;
    var reader = new FileReader();
    reader.onload = function (e) {
        var preview = document.getElementById('thumbPreview');
        var placeholder = document.getElementById('thumbPlaceholder');
        preview.src = e.target.result;
        preview.classList.remove('d-none');
        if (placeholder) placeholder.classList.add('d-none');
    };
    reader.readAsDataURL(file);
});
</script>
