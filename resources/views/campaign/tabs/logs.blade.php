<div class="row">
    <div class="kt-widget1 col-md-12" style="padding: 20px 10px;">
        <h5>Activity Logs</h5>
    </div>
    <div class="kt-timeline-v2">
        <div class="kt-timeline-v2__items kt-padding-top-25 kt-padding-bottom-30">
            @foreach($activity as $act)
            <div class="kt-timeline-v2__item">
                <span class="kt-timeline-v2__item-time">{{ $act->created_at->format('H:i') }}</span>
                <div class="kt-timeline-v2__item-cricle">
                    <i class="fa fa-genderless kt-font-danger"></i>
                </div>
                <div class="kt-timeline-v2__item-text kt-padding-top-5">
                    {!! $act->description !!}<br />
                    at <span class="kt-font-info">{{ $act->created_at->format('H:i:s d:m:Y') }}</span>, By <span class="kt-font-success">{{ $act->created_by }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>