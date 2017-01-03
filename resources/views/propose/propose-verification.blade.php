@extends('layouts.lay_admin')

@section('content')
    <section id="page-content">

        <!-- Start page header -->
        <div class="header-content">
            <h2><i class="fa fa-star"></i> {{ $pageTitle }} </h2>
            <div class="breadcrumb-wrapper hidden-xs">
                <span class="label">Direktori anda:</span>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{url('/')}}">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        {{ $pageTitle }}
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Verifikasi Proposal</li>
                </ol>
            </div><!-- /.breadcrumb-wrapper -->
        </div><!-- /.header-content -->
        <!--/ End page header -->

        <div class="body-content animated fadeIn">

            {{--@foreach($dedication_partners as $key_1 => $dedication_partners_1)--}}
            {{--@foreach($dedication_partners_1 as $key_2 => $dedication_partners_2)--}}
            {{--@if(old($key_2, $key_1))--}}
            {{--@php($dedication_partners[$key_1][$key_2] = old($key_2, $key_1))--}}
            {{--@endif--}}
            {{--@endforeach--}}
            {{--@endforeach--}}
                @include('form-input.panel-errors')

            <form class="" action="{{url('proposes', $propose->id) . '/verification'}}" method="POST" enctype="multipart/form-data">
                @include('form-input.propose-scheme')

                @include('form-input.propose-member')

                @include('form-input.propose-detail')

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">

                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-footer">
                                <div class="col-sm-offset-4 col-md-offset-3">
                                    <a href="{{url($deleteUrl)}}" class="btn btn-danger btn-slideright">Cancel</a>
                                    <button name="reject" type="submit" class="btn btn-warning btn-slideright" value="x">Reject</button>
                                    <button name="accept" type="submit" class="btn btn-success btn-slideright" value="x">Accept</button>
                                </div><!-- /.col-sm-offset-3 -->
                            </div><!-- /.form-footer -->
                        </div><!-- /.panel -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </form>
        </div><!-- /.body-content -->

        <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->
    </section><!-- /#page-content -->
@endsection