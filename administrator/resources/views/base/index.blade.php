@extends('base.base')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $base_name; ?>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <div class="m-b-20 m-t--20">
                                <a href="<?php echo Config::get('const.admin_root_path') . 'book/create'; ?>" class="btn btn-primary m-t-15 waves-effect">新規作成</a>
                            </div>
                            <table class="table text-enter">
                                <tr>
                                    <?php foreach ($columns as $column): ?>
                                    <th class="text-center"><?php echo $column; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                                <?php foreach ($books as $book): ?>
                                <tr>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info btn-circle-lg waves-effect waves-circle waves-float"><a href="<?php echo Config::get('const.admin_root_path') . 'book/' . $book->id . '/edit'; ?>" style="color: white;"><i class="material-icons" style="font-size: 30px !important; left: -14px !important; top: 4px !important;">edit</i></a></button>
                                    </td>
                                    <td><?php echo $book->name; ?></td>
                                    <td><?php echo $book->price; ?></td>
                                    <td><?php echo $book->author; ?></td>
                                    <td class="text-center">
                                        <form action="<?php echo Config::get('const.admin_root_path') . 'book/' . $book->id; ?>" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <button style="padding: 5px 10px;" type="submit" class="btn btn-danger btn-lg waves-effect" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
