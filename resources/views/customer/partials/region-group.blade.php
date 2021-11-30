<div class="region-group">
    <span class="t3" >Districts</span>
    <ul class="region-group-locations">
        @foreach($districts as $key => $district)
        <li>
            <a href="{{route('filter', $district->id)}}" class="">{{ $district['name'] }}</a>
            @if($district->cities && $district->cities->count() > 0 )
                <ul>
                    @foreach($district->cities as $key => $city)
                        <li><a href="{{route('filter.city', [$district->id, $city->id])}}" dis_data_district_category="{{ $city->district_id }}" dis_data_category="{{ $city->id }}" >{{ $city->name }}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
        @endforeach
    </ul>
</div>

<style type="text/css">
    ul.region-group-locations li > ul {
        position: absolute;
        left: -5000px;
        /*top: 0;*/
        opacity: 0;
        width: 230px;
        visibility: hidden;
        box-shadow: 0 1px 10px 1px rgb(196 196 196 / 40%);
        -webkit-transition: opacity .3s, visibility 0s .3s, left 0s .3s;
        transition: opacity .3s, visibility 0s .3s, left 0s .3s;
        margin-left: 5px;
        padding: 10px 15px;
        border: 1px solid #e096a9d1;
        margin-left: 30px;
        margin-top: -35px;
        z-index: 1000;
        background: #fedae8;
    }
    ul.region-group-locations li:hover > ul {
        visibility: visible;
        left: 300px;
        opacity: 1;
        -webkit-transition: opacity .5s;
        transition: opacity .5s;
    }
    ul.region-group-locations li > ul li {
        display: block;
        float: none;
    }
    ul.region-group-locations li > ul li > a {
        width: 100% !important;
    }
</style>