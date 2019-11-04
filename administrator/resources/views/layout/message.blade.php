<?php if(!empty($fields)): ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">
            <ul>
                <?php foreach($fields as $field): ?>
                    <li><?php echo $field; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>
