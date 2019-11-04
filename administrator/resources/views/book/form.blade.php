@extends('layout/head')
@section('content')

<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <?php if($target === 'store'): ?>
            <h3 class="ops-title">書籍登録</h3>
            <?php elseif($target === 'update'): ?>
            <h3 class="ops-title">書籍編集</h3>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

            <?php if($target === 'store'): ?>
            <form action="<?php echo Config::get('const.admin_root_path') . 'book'; ?>" method="post">
            <?php elseif($target === 'update'): ?>
            <form action="<?php echo Config::get('const.admin_root_path') . 'book/'. $book->id; ?>" method="post">
                <input type="hidden" name="_method" value="PUT">
            <?php endif; ?>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="form-group">
                    <label for="name">書籍名</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $book->name; ?>">
                    @include('layout/message', ['fields' => $errors->get('name')])
                </div>
                <div class="form-group">
                    <label for="price">価格</label>
                    <input type="text" class="form-control" name="price" value="<?php echo $book->price; ?>">
                    @include('layout/message', ['fields' => $errors->get('price')])
                </div>
                <div class="form-group">
                    <label for="author">著者名</label>
                    <input type="text" class="form-control" name="author" value="<?php echo $book->author; ?>">
                    @include('layout/message', ['fields' => $errors->get('author')])
                </div>
                <button type="submit" class="btn btn-default">登録</button>
                <p class="btn btn-danger"><a style="color: white;" href="<?php echo Config::get('const.admin_root_path') . 'book'; ?>">戻る</a></p>
            </form>
        </div>
    </div>
</div>
@endsection