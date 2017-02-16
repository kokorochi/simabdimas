{{--Get Old Value And Place It To VARIABLE--}}
@if(
$errors->has('period_id')           || old('period_id') ||
$errors->has('is_own')              || old('is_own') ||
$errors->has('own-years')           || old('own-years') ||
$errors->has('own-research_type') || old('own-research_type') ||
$errors->has('own-scheme')          || old('own-scheme') ||
$errors->has('own-sponsor')         || old('own-sponsor') ||
$errors->has('own-member')          || old('own-member') ||
$errors->has('own-annotation')      || old('own-annotation') ||
$errors->has('period_id')           || old('period_id')
)
    @php
        $propose_relation->propose->period_id             = old('period_id');
        $propose_relation->propose->is_own                = old('is_own');
        $propose_relation->propose_own->years             = old('own-years');
        $propose_relation->propose_own->research_type     = old('own-research_type');
        $propose_relation->propose_own->scheme            = old('own-scheme');
        $propose_relation->propose_own->sponsor           = old('own-sponsor');
        $propose_relation->propose_own->member            = old('own-member');
        $propose_relation->propose_own->annotation        = old('own-annotation');
    @endphp
@endif
{{--Get Old Value And Place It To VARIABLE--}}
<div class="row">
    <div class="col-md-12">
        <div class="panel rounded shadow">
            <div class="panel-heading">
                <div class="pull-left">
                    <h3 class="panel-title">Scheme</h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-sm" data-action="collapse" data-container="body" data-toggle="tooltip"
                       data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></a>
                </div>
                <div class="clearfix"></div>
            </div><!-- /.panel-heading -->

            <div class="panel-body no-padding">
                <div class="form-body form-horizontal form-bordered">

                    <!-- Own Data -->
                    @if($propose_relation->propose->is_own === '1' || $disabled === null)
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-7">
                                <div class="ckbox ckbox-primary">
                                    <input name="is_own" id="checkbox-primary1" type="checkbox" value="1"
                                            {{ $propose_relation->propose->is_own === '1' ? 'checked="checked"' : null }} {{$disabled}}>
                                    <label for="checkbox-primary1">Mandiri</label>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <div id="own-wrapper" class="col-sm-12">
                            <label for="own-years" class="col-sm-4 col-md-3 control-label">Tahun</label>
                            <div class="col-sm-7 mb-10">
                                <input name="own-years" class="form-control input-sm" type="text"
                                       value="{{ $propose_relation->propose_own->years }}" {{$disabled}}>
                                @if($errors->has('own-years'))
                                    <label class="error" for="years" style="display: inline-block;">
                                        {{ $errors->first('own-years') }}
                                    </label>
                                @endif
                            </div>

                            <label for="own-research_type" class="col-sm-4 col-md-3 control-label">Jenis
                                Penelitian</label>
                            <div class="col-sm-7 mb-10">
                                <select name="own-research_type" class="form-control input-sm" {{$disabled}}>
                                    @foreach($propose_relation->research_types as $research_type)
                                        <option value="{{$research_type->id}}" {{$propose_relation->propose_own->research_type == $research_type->id ? 'selected' : null}}>{{$research_type->research_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="own-scheme" class="col-sm-4 col-md-3 control-label">Scheme</label>
                            <div class="col-sm-7 mb-10">
                                <input name="own-scheme" class="form-control input-sm" type="text"
                                       value="{{ $propose_relation->propose_own->scheme }}" {{$disabled}}>
                                @if($errors->has('own-scheme'))
                                    <label class="error" for="scheme" style="display: inline-block;">
                                        {{ $errors->first('own-scheme') }}
                                    </label>
                                @endif
                            </div>

                            <label for="own-sponsor" class="col-sm-4 col-md-3 control-label">Sumber Dana</label>
                            <div class="col-sm-7 mb-10">
                                <input name="own-sponsor" class="form-control input-sm" type="text"
                                       value="{{ $propose_relation->propose_own->sponsor }}" {{$disabled}}>
                                @if($errors->has('own-sponsor'))
                                    <label class="error" for="sponsor" style="display: inline-block;">
                                        {{ $errors->first('own-sponsor') }}
                                    </label>
                                @endif
                            </div>

                            <label for="own-member" class="col-sm-4 col-md-3 control-label">Anggota</label>
                            <div class="col-sm-7 mb-10">
                                <input name="own-member" class="form-control input-sm" type="text"
                                       maxlength="2" data-inputmask="'alias': 'decimal', 'rightAlign': false"
                                       value="{{ $propose_relation->propose_own->member }}" {{$disabled}}>
                                @if($errors->has('own-member'))
                                    <label class="error" for="member" style="display: inline-block;">
                                        {{ $errors->first('own-member') }}
                                    </label>
                                @endif
                            </div>

                            <label for="own-annotation" class="col-sm-4 col-md-3 control-label">Keterangan</label>
                            <div class="col-sm-7">
                                <textarea name="own-annotation" class="form-control input-sm" rows="5"
                                          placeholder="Enter text ..." {{$disabled}}>{{ $propose_relation->propose_own->annotation }}</textarea>
                                @if($errors->has('own-annotation'))
                                    <label class="error" for="annotation" style="display: inline-block;">
                                        {{ $errors->first('own-annotation') }}
                                    </label>
                                @endif
                            </div>
                        </div> <!-- /#own-wrapper -->

                        @if($propose_relation->propose->is_own === null && ! ($propose_relation->periods->isEmpty()))
                            <div id="scheme-wrapper" class="col-sm-12">
                                <label for="period_id" class="col-sm-4 col-md-3 control-label">Scheme</label>
                                <div class="col-sm-7 mb-10">
                                    <select name="period_id" class="form-control input-sm" {{$disabled}}>
                                        @foreach($propose_relation->periods as $item)
                                            <option value="{{$item->id}}" {{$propose_relation->propose->period_id == $item->id ? 'selected' : null}}>{{$item->scheme}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label for="category_name" class="col-sm-4 col-md-3 control-label">Kategori</label>
                                <div class="col-sm-7 mb-10">
                                    <input name="category_name" class="form-control input-sm" type="text" disabled
                                           value="{{ $propose_relation->period->categoryType->category_name }}">
                                </div>

                                <label for="years" class="col-sm-4 col-md-3 control-label">Tahun</label>
                                <div class="col-sm-7 mb-10">
                                    <input name="years" class="form-control input-sm" type="text" disabled
                                           value="{{ $propose_relation->period->years }}">
                                </div>

                                <label for="research_name" class="col-xs-12 col-sm-4 col-md-3 control-label">Jenis
                                    Penelitian</label>
                                <div class="col-sm-7 mb-10">
                                    <input name="research_name" class="form-control input-sm" type="text" disabled
                                           value="{{ $propose_relation->period->researchType->research_name }}">
                                </div>

                                <label for="scheme" class="col-sm-4 col-md-3 control-label">Scheme</label>
                                <div class="col-sm-7 mb-10">
                                    <input name="scheme" class="form-control input-sm" type="text" disabled
                                           value="{{ $propose_relation->period->scheme }}">
                                </div>

                                <label for="sponsor" class="col-sm-4 col-md-3 control-label">Sumber Dana</label>
                                <div class="col-sm-7 mb-10">
                                    <input name="sponsor" class="form-control input-sm" type="text" disabled
                                           value="{{ $propose_relation->period->sponsor }}">
                                </div>

                                <label for="min_member" class="col-sm-4 col-md-3 control-label">Jumlah Anggota</label>
                                <div class="col-sm-3 col-md-3">
                                    <input name="min_member" class="form-control input-sm" type="text" disabled
                                           value="{{ $propose_relation->period->min_member }}">
                                </div>
                                <label class="col-sm-1 control-label" style="text-align: center;"> - </label>
                                <div class="col-sm-3 col-md-3">
                                    <input name="max_member" class="form-control input-sm mb-10" type="text" disabled
                                           value="{{$propose_relation->period->max_member }}">
                                </div>

                                <label for="total_amount" class="col-sm-4 col-md-3 control-label">Jumlah Dana
                                    Maksimal</label>
                                <div class="col-sm-7">
                                    <input name="total_amount" class="form-control input-sm mb-10"
                                           data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'rightAlign': false"
                                           type="text" value="{{$propose_relation->period->total_amount}}" disabled>
                                </div>

                                {{--<label for="score" class="col-sm-4 col-md-3 control-label">Skor Minimal</label>--}}
                                {{--<div class="col-sm-7">--}}
                                    {{--<input name="score" class="form-control input-sm mb-10"--}}
                                           {{--maxlength="5"--}}
                                           {{--data-inputmask="'alias': 'decimal', 'rightAlign': false"--}}
                                           {{--type="text" value="{{$period->score}}" disabled>--}}
                                {{--</div>--}}

                                <label for="external" class="col-sm-4 col-md-3 control-label">Dosen Luar
                                    Diperbolehkan</label>
                                <div class="col-md-7 mb-10">
                                    <div class="rdio rdio-theme circle">
                                        <div class="radio-inline">
                                            <input id="external_no" name="allow_external" type="radio"
                                                   value="0"
                                                   {{$propose_relation->period->allow_external == false ? 'checked' : ''}} disabled>
                                            <label for="external_no">Tidak</label>
                                        </div>
                                        <div class="radio-inline">
                                            <input id="external_yes" name="allow_external" type="radio"
                                                   value="1"
                                                   {{$propose_relation->period->allow_external == true ? 'checked' : ''}} disabled>
                                            <label for="external_yes">Ya</label>
                                        </div>
                                    </div>
                                </div>

                                <label for="annotation" class="col-sm-4 col-md-3 control-label">Keterangan</label>
                                <div class="col-sm-7">
            <textarea id="input-annotation" name="annotation" class="form-control input-sm" rows="5"
                      placeholder="Enter text ..." disabled>{{ $propose_relation->period->annotation }}</textarea>
                                </div>
                            </div> <!-- /#scheme-wrapper -->
                        @endif
                    </div>
                </div><!-- /.form-body -->
            </div>
        </div>
    </div><!-- /.col-md-12 -->
</div><!-- /.row -->