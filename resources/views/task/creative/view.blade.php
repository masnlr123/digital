<!doctype html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>{{ $creative_task->task_name }}</title>
    <style type="text/css">
.external-showcase .creative-showcase{
    background: #000;
    min-height: 100vh;
    text-align: center;
}
.creative-item{
    display: table;
    width: 100%;
    min-height: 85vh;
    max-height: 98vh;
}
.creative_show_block{
  display: table-cell;
  vertical-align: middle;
    text-align: center;
}
.no-padding{
  padding:0px;
}
.external-showcase{
  margin:0px;
}
.external-showcase .creative-showcase img{

    
    max-width: 80%;
    max-height: 87vh !important;
    margin-top: 15px;
}
.creative_caption{
    background: #3F51B5;
    z-index: 9999;
    color: #fff;
    padding: 6px;
}
.creative-item{
/*  
    height: 320px;
    max-height: 320px;
    background: #eaeaea;*/
}
.sidebar{

    background: #eee;
    display: block;
    min-height: 100vh;
    padding: 0;
}
.sidebar .row{

    padding: 0 10px;
    margin: 0 15px;
}
.kt-widget1__title{

    font-size: 21px;
    text-transform: capitalize;
}
.kt-widget1__item{

    border-bottom: 1px solid #c3c3c3;
    margin-bottom: 10px;
    padding-bottom: 7px;
    min-height: 70px;
}
.task-title{
  text-transform: capitalize;
    color: #126fcc;
    font-size: 22px;
}
h3{
  font-size: 22px;
}
.task-heading{
    border-bottom: 1px solid #bdbdbd;
    width: 100%;
    padding: 10px 30px 5px !important;
    border-bottom: 1;
    background: #e0e0e0;
    margin: 0 !important;
}
    </style>
  </head>
  <body>
    <div class="row external-showcase">
      <div class="col-md-8 no-padding">
    <div class="creative-showcase">
                            <div id="demo{{$creative_task->id}}" class="carousel slide creative-carousel" data-ride="carousel">

  <!-- The slideshow -->
  <div class="carousel-inner"> 
    <?php $i = 0; foreach($creatives as $creative): ?>
    <div class="carousel-item <?php if($i == 0){ echo 'active'; } ?>">
        <div class="creative_caption">
        <?php
        $creative_name = str_replace('_', ' ', $creative->name);
        $creative_name = str_replace('-', ' ', $creative_name);
        $creative_name = str_replace('.jpg', ' ', $creative_name);
        $creative_name = str_replace('.png', ' ', $creative_name);
        $creative_name = str_replace('.gif', ' ', $creative_name);
        $creative_name = ucfirst($creative_name);
        $search_ext_mp4 = '.mp4';
        $search_ext_avi = '.mp4';
        if(preg_match("/{$search_ext_mp4}/i", $creative->location)) {
            $media_output = '<video width="720" height="450" controls>';
            $media_output .= '<source src="'.url($creative->location).'" type="video/mp4">';
            $media_output .= 'Your browser does not support the video tag.';
            $media_output .= '</video>';
        }
        elseif(preg_match("/{$search_ext_avi}/i", $creative->location)) {
            $media_output = '<video width="720" height="450" controls>';
            $media_output .= '<source src="'.url($creative->location).'" type="video/avi">';
            $media_output .= 'Your browser does not support the video tag.';
            $media_output .= '</video>';
        }
        else{
            $media_output = '<img src="'.url($creative->location).'" alt="Craetives">';
        }
        ?>
    <h3>{{ $creative_name }}</h3>
            <!-- <p>{{ $creative->comment }}</p> -->
  </div>
  <div class="creative-item">
        <div class="creative_show_block">
            <?php echo $media_output; ?>
        </div>
    </div>
</div>
    <?php $i++; endforeach; ?>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo{{$creative_task->id}}" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo{{$creative_task->id}}" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
                     </div>
                 </div>
                 <div class="col-md-4 sidebar">
                   <div class="row task-heading">
                    <div class="">
                      <h3 class="task-title">{{ $creative_task->task_name }}</h3>
                    </div>
                   </div>
                   <div class="row">
        <div class="kt-widget1 col-md-6" style="padding:20px 10px;">
            <div class="kt-widget1__item">
                <div class="kt-widget1__info">
                    <h3 class="kt-widget1__title">project</h3>
                    <span class="kt-widget1__desc">{{ $creative_task->project }}</span>
                </div>
            </div>
            <div class="kt-widget1__item">
                <div class="kt-widget1__info">
                    <h3 class="kt-widget1__title">Task Category</h3>
                    <span class="kt-widget1__desc">{{ $creative_task->task_cat }}</span>
                </div>
            </div>
            <div class="kt-widget1__item">
                <div class="kt-widget1__info">
                    <h3 class="kt-widget1__title">Task For</h3>
                    <span class="kt-widget1__desc">{{ $creative_task->task_for }}</span>
                </div>
            </div>
            <div class="kt-widget1__item">
                <div class="kt-widget1__info">
                    <h3 class="kt-widget1__title">Creative Type</h3>
                    <span class="kt-widget1__desc">{{ $creative_task->creative_type }}</span>
                </div>
            </div>
        </div>

        <div class="kt-widget1 col-md-6" style="padding:20px 10px;">
            <div class="kt-widget1__item">
                <div class="kt-widget1__info">
                    <h3 class="kt-widget1__title">Campaign</h3>
                    <span class="kt-widget1__desc">{{ $creative_task->campaign }}</span>
                </div>
            </div>
            <div class="kt-widget1__item">
                <div class="kt-widget1__info">
                    <h3 class="kt-widget1__title">Campaign Type</h3>
                    <span class="kt-widget1__desc">{{ $creative_task->campaign_type }}</span>
                </div>
            </div>
            <div class="kt-widget1__item">
                <div class="kt-widget1__info">
                    <h3 class="kt-widget1__title">Channel</h3>
                    <span class="kt-widget1__desc">{{ $creative_task->channel }}</span>
                </div>
            </div>
            <div class="kt-widget1__item">
                <div class="kt-widget1__info">
                    <h3 class="kt-widget1__title">Creative Size</h3>
                    <span class="kt-widget1__desc">{{ $creative_task->creative_size }}</span>
                </div>
            </div>
        </div>

    </div>

                   <!--<div class="row">-->
                   <!-- <a href="{{ route('creative_approval', $creative_task->id) }}" class="btn btn-success">Click to Approve -></a>-->
                   <!--</div>-->

                 </div>
             </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>