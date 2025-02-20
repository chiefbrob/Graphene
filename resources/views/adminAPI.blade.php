@extends('default.APIServer')
@section('content')

<div>
  <div class="app_name"></div>
<!-- Split button -->
<div class="btn-group pull-right">
  <button type="button" class="btn btn-primary" id="save">Save</button>
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">    
    <li><a href="/api/proxy/{{ $slug }}/apis/{!! $id !!}/versions/latest" target="_blank">Export</a></li>
    <li><a href="#" id="import">Import</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#" id="versions">Versions</a></li>
    <li><a href="#" id="instances">Instances</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#" id="publish">Publish (new version)</a></li>
    <!-- <li><a href="#">Visit</a></li> -->
  </ul>
</div>
  <span class="label label-default" style="float:right;margin-right:15px;" id="version"></span>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#routes" aria-controls="routes" role="tab" data-toggle="tab"><i class="fa fa-map-marker"></i> <span class="hidden-xs hidden-sm">Routes<span></a></li>
  <li role="presentation"><a href="#resources" aria-controls="resources" role="tab" data-toggle="tab"><i class="fa fa-database"></i> <span class="hidden-xs hidden-sm">Resources<span></a></li>
  <li role="presentation"><a href="#functions" aria-controls="functions" role="tab" data-toggle="tab"><i class="fa fa-code"></i> <span class="hidden-xs hidden-sm">Functions</span></a></li>
  <li role="presentation"><a href="#files" aria-controls="files" role="tab" data-toggle="tab"><i class="fa fa-file"></i> <span class="hidden-xs hidden-sm">Files</span></a></li>
  <li role="presentation"><a href="#options" aria-controls="options" role="tab" data-toggle="tab"><i class="fa fa-gear"></i> <span class="hidden-xs hidden-sm">Options</span></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane files" id="files"></div>
    <div role="tabpanel" class="tab-pane functions" id="functions"></div>
    <div role="tabpanel" class="tab-pane active " id="routes">
      <div class="row"><div class="col-md-12 routes "></div></div>
    </div>    
    <div role="tabpanel" class="tab-pane" id="resources">
      <div class="row"><div class="col-md-12 resources "></div></div>
    </div>
    <div role="tabpanel" class="tab-pane options" id="options" style="margin-top:5px">
    <div class="">
      <div class="row">
          <div class="col-md-2 col-sm-8 col-xs-12">
            <div class="target"></div>
          </div>
          <div class="col-md-6 col-sm-8 col-xs-12">
            <div style="display:none;position: absolute;top: -5px;left: 0;right: 0;bottom: -20px;z-index:-1;background: #eaeaea;border: solid #9aa5b1;border-width: 0 1px;"></div>
            <div class="btn-group pull-right" role="group" style="margin-bottom:20px" aria-label="...">
                  <a class="btn btn-default" onclick="new gform(_.extend(myform,{name:'modal'}) ).modal().on('cancel',function(e){e.form.trigger('close')})"><i class="fa fa-eye"></i><span class="visible-lg"> View</span></a>
                  <a class="btn btn-danger" onclick="new gform({legend:'Descriptor',fields:[{type:'textarea',name:'descriptor',label:false,size:25 }],data:{descriptor:JSON.stringify(myform,null,'\t')}}).modal().on('save',function(e){myform  = JSON.parse(e.form.get('descriptor')); e.form.trigger('close');renderBuilder(); }).on('cancel',function(e){e.form.trigger('close')})"><i class="fa fa-pencil"></i><span class="visible-lg"> Edit</span></a>
                </div>
            <ul id="sortableList" class="form-types-group">
                    <li style="color:#22aa10" data-type="input"><i class="fa fa-font"></i> Input</li>
                    <li style="color:#ee1515" data-type="collection"><i class="fa fa-list"></i> Options</li>
                    <li style="color:#0088ff" data-type="bool"><i class="fa fa-check-square-o"></i> Boolean</li>
                    <li style="color:#555" data-type="section"><i class="fa fa-list-ol"></i> Section</li>
                  </ul>			

            <div class="panel panel-primary">
       
              <div class="panel-body" style="min-height:80px;position:relative">
                <form>
                <div id="editor" style="position:relative;z-index:1" class="form-horizontal widget_container cobler_select"></div>
                <div><i class="fa fa-arrow-circle-o-up fa-2x pull-left text-muted"></i>Click or Drag Form Elements HERE</div>
                <style>

                  .form-types-group{
                    list-style-type: none;
                    height:60px;
                    padding-left:0;
                  }
                  .form-types-group li{
                    cursor:pointer;
                    display:block;
                    text-align: center;
                    padding:10px;
                    line-height: 40px;
                    width:80px;
                    height:60px;
                    float:left;
                    border:solid 1px;
                    border-radius:3px;
                    background:#fff;
                    margin-right:10px;
                  }
                  .form-types-group li i{
                    position: relative;
                    display:block;
                  }

                                  .margin-bottom{margin-bottom:15px !important}
                                  #editor + div {
                      display: none;
                      position: absolute;
                      top: 15px;
                      left: 15px;
                      right: 15px;
                      padding: 11px;
                      text-align: center;
                      border:dashed 1px #080;
                      border-radius:30px;
                  }

                  #editor:empty + div{
                      display: block;
                  }
                </style>
                </form>

              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-4">
            <div class="panel panel-default">

              <div class="panel-body">
                <div class=" source view view_source" id="alt-sidebar">

                  <div id="mainform"></div>
                  <div id="form"></div>
                  </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

</div>
@endsection

@section('end_body_scripts_top')
  <script type="text/javascript" src='/assets/js/vendor/ractive.min.js?cb={{ config("app.cache_bust_id") }}'></script>    
  <script type="text/javascript" src='/assets/js/vendor/sortable.js?cb={{ config("app.cache_bust_id") }}'></script>
  <script type='text/javascript' src='/assets/js/templates/admin.js?cb={{ config("app.cache_bust_id") }}'></script>
  <script type='text/javascript' src='/assets/js/cob/cob.js?cb={{ config("app.cache_bust_id") }}'></script>
  <script type='text/javascript' src='/assets/js/cob/content.cob.js?cb={{ config("app.cache_bust_id") }}'></script>
  <script type='text/javascript' src='/assets/js/cob/image.cob.js?cb={{ config("app.cache_bust_id") }}'></script>
  <script type="text/javascript" src='/assets/js/fileManager.js?cb={{ config("app.cache_bust_id") }}'></script> 


  <script type='text/javascript' src='/assets/js/vendor/moment.js?cb={{ config("app.cache_bust_id") }}'></script>
  <script type='text/javascript' src='/assets/js/vendor/moment_datepicker.js?cb={{ config("app.cache_bust_id") }}'></script>
  <script type='text/javascript' src='/assets/js/vendor/math.min.js?cb={{ config("app.cache_bust_id") }}'></script>
  <script type='text/javascript' src='/assets/js/vendor/popper.min.js?cb={{ config("app.cache_bust_id") }}'></script>
  <script type='text/javascript' src='/assets/js/vendor/colorpicker.min.js?cb={{ config("app.cache_bust_id") }}'></script>
  <script type='text/javascript' src='/assets/js/vendor/svg-pan-zoom.min.js?cb={{ config("app.cache_bust_id") }}'></script>
  
@endsection

@section('end_body_scripts_bottom')
  <script>var loaded = {!! $api_version !!};
          var api = {!! $api !!};
          var slug = "{!! $slug !!}";
          var server = "{{ $config->server }}";
          workflow = true;
          </script>
            <script type='text/javascript' src='/assets/js/form.cob.js?cb={{ config("app.cache_bust_id") }}'></script>

  <script type='text/javascript' src='/assets/js/APIServer_api_edit.js?cb={{ config("app.cache_bust_id") }}'></script>

@endsection

@section('bottom_page_styles')
  <style>
  fieldset hr{display:none}
  fieldset > legend{font-size: 30px}
  fieldset fieldset legend{    font-size: 21px}
  /* #myModal .modal-dialog{width:900px} */
  </style>
@endsection