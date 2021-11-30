
@foreach($messages as $message)
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            @if($message->from == \Illuminate\Support\Facades\Auth::id())
                <div class="d-flex msg justify-content-end">
                    <div style="color: #fff">
                        <p style="margin-top: auto;
    margin-bottom: auto;
    margin-right: 10px;
    border-radius: 25px;
    background-color: #78e08f;
    padding: 10px;
    position: relative;
}"> {{$message->message}}</p>
                        <span class="msg_time_send">{{$message->created_at->diffForHumans()}}</span>
                    </div>
                    <div class="img_cont_msg">
                        <img src="http://www.iconarchive.com/download/i69390/aha-soft/free-large-boss/Admin.ico" class="rounded-circle user_img_msg">
                    </div>
                </div>
            @else
                <div class="d-flex msg justify-content-start">
                    <div class="img_cont_msg">
                        <img src="https://readyrefrigeration.ca/sites/default/files/styles/headshot/adaptive-image/public/nobody.jpg" class="rounded-circle user_img_msg">

                    </div>
                    <div style="color: #fff;">
                        <p style="margin-top: auto;
    margin-bottom: auto;
    margin-left: 10px;
    border-radius: 25px;
    background: #007bff;
    padding: 10px;
    position: relative;">{{$message->message}}</p>
                        <span class="msg_time">{{$message->created_at->diffForHumans()}}</span>
                    </div>
                </div>
            @endif
        @else
            @if($message->from == \Illuminate\Support\Facades\Auth::id())
                <div class="d-flex msg justify-content-end">
                    <div style="color: #fff; max-width: 90%;">
                        <p style="margin-top: auto;
    margin-bottom: auto;
    margin-right: 10px;
    border-radius: 25px;
    background-color: #78e08f;
    padding: 10px;
    position: relative;"> {{$message->message}}</p>
                        <span class="msg_time_send">{{$message->created_at->diffForHumans()}}</span>
                    </div>
                    <div class="img_cont_msg">
                        <img src="https://readyrefrigeration.ca/sites/default/files/styles/headshot/adaptive-image/public/nobody.jpg" class="rounded-circle user_img_msg">
                    </div>
                </div>
            @else
                <div class="d-flex msg justify-content-start">
                    <div class="img_cont_msg">
                        <img src="http://www.iconarchive.com/download/i69390/aha-soft/free-large-boss/Admin.ico" class="rounded-circle user_img_msg">
                    </div>
                    <div style="color: #fff;">
                        <p style="margin-top: auto;
    margin-bottom: auto;
    margin-left: 10px;
    border-radius: 25px;
    background: #007bff;
    padding: 10px;
    position: relative;">{{$message->message}}</p>
                        <span class="msg_time">{{$message->user->first_name}} - {{$message->created_at->diffForHumans()}}</span>
                    </div>
                </div>
            @endif
        @endif
@endforeach