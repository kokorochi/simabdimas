@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
    <section id="page-content">

        <!-- Start page header -->
        <div class="header-content">
            <h2><i class="fa fa-black-tie"></i> {{ $pageTitle }} </h2>
            <div class="breadcrumb-wrapper hidden-xs">
                <span class="label">Direktori anda:</span>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{url('/')}}">Beranda</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        {{ $pageTitle }}
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Daftar</li>
                </ol>
            </div><!-- /.breadcrumb-wrapper -->
        </div><!-- /.header-content -->
        <!--/ End page header -->

        <!-- Start body content -->
        <div class="body-content animated fadeIn">
            <div class="panel rounded shadow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Daftar {{$pageTitle}}</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-action="collapse" data-container="body" data-toggle="tooltip"
                                data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(!$researches->isEmpty())
                                <div class="table-responsive mb-20">
                                    <table class="table table-striped table-success">
                                        <thead>
                                        <tr>
                                            <th class="text-center border-right">Id</th>
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">Scheme</th>
                                            <th class="text-center">Status Penelitian</th>
                                            <th class="text-center">Status Luaran</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($researches as $research)
                                                @php
                                                    $propose = $research->propose()->first();
                                                    if($propose->is_own === null)
                                                    {
                                                        $period = $propose->period()->first();
                                                    }
                                                    else
                                                    {
                                                        $period = $propose->proposesOwn()->first();
                                                    }
                                                    $status_code = $propose->flowStatus()->orderBy('item', 'desc')->first()->status_code;
                                                @endphp
                                                <tr>
                                                    <td class="text-center border-right">{{ $research->id }}</td>
                                                    <td class="text-center border-right">{{ $period->years }}</td>
                                                    <td class="text-center border-right">{{ $propose->title }}</td>
                                                    <td class="text-center border-right">{{ $period->scheme }}</td>
                                                    <td class="text-center border-right">{{ $propose->flowStatus()->orderBy('item', 'desc')->first()
                                                       ->statusCode()->first()->description }}</td>
                                                    <td class="text-center">{!!$research->output_status!!}</td>
                                                    <td class="text-center">
                                                        <a href="{{url($deleteUrl . '/' . $research->id .'/edit')}}"
                                                           class="btn btn-primary btn-xs" data-toggle="tooltip"
                                                           data-placement="top" data-original-title="Ubah">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="{{url($deleteUrl . '/' . $research->id .'/output')}}"
                                                           class="btn btn-success btn-xs" data-toggle="tooltip"
                                                           data-placement="top" data-original-title="Unggah Luaran">
                                                            <i class="fa fa-upload"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="text-center border-right">Id</th>
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">Scheme</th>
                                            <th class="text-center">Status Penelitian</th>
                                            <th class="text-center">Status Luaran</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.table-responsive -->
                                <!--/ End table horizontal scroll -->
                            @else
                                <blockquote><p>{{ $data_not_found }}</p></blockquote>
                            @endif
                        </div>
                    </div><!-- /.row -->

                </div><!-- /.panel-body -->
            </div><!-- /.panel -->

        </div><!-- /.body-content -->
        <!--/ End body content -->

        <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->

    </section><!-- /#page-content -->
@endsection
<!--/ END PAGE CONTENT -->
