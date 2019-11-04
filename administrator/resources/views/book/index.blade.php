@extends('layout/head')
@section('content')

<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">書籍一覧</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <table class="table text-enter">
                <tr>
                    <?php foreach ($columns as $column): ?>
                        <th class="text-center"><?php echo $column; ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php foreach ($books as $book): ?>
                   <tr>
                       <td class="text-center">
                           <a href="<?php echo Config::get('const.admin_root_path') . 'book/' . $book->id . '/edit'; ?>">編集</a>
                       </td>
                       <td><?php echo $book->name; ?></td>
                       <td><?php echo $book->price; ?></td>
                       <td><?php echo $book->author; ?></td>
                       <td class="text-center">
                           <form action="<?php echo Config::get('const.admin_root_path') . 'book/' . $book->id; ?>" method="post">
                               <input type="hidden" name="_method" value="DELETE">
                               <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                               <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                           </form>
                       </td>
                   </tr>
                <?php endforeach; ?>
            </table>
            <div>
                <a href="<?php echo Config::get('const.admin_root_path') . 'book/create'; ?>" class="btn btn-default">新規作成</a>
            </div>
        </div>
    </div>
</div>
@endsection