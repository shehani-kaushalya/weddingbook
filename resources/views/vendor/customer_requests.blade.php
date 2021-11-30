@extends('layouts.frontend_app')

@section('content')
<style type="text/css">
    .fc-view-container {
        border: 1px solid #dbdbdb;
        border-top: none;
    }
    .fc-right .fc-today-button, 
    .fc-right .fc-prev-button, 
    .fc-right .fc-next-button{
        border: 1px solid #4a4a4a !important;
    }
    .fc-button .fc-icon {
        vertical-align: baseline;
    }
</style>
<body class="page">
    <main class="page__wrapper">
        <div class="page__wrapper-column">
        </div>
        <div class="page__wrapper-column">
            {{-- @include('frontend.vendor_nav_district') --}}
            <div class="u-mt block">
                <div class="row">
                    <div class="col">
                        <div id='calendar'></div>
                        <div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Customer request::</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <dt>Name</dt>
                                        <dd class="_name"></dd>
                                        
                                        <dt>Telephone</dt>
                                        <dd class="_telephone"></dd>
                                        
                                        <dt>Email</dt>
                                        <dd class="_email"></dd>

                                        <dt>Address</dt>
                                        <dd class="_address"></dd>

                                        <dt>Date & Time</dt>
                                        <dd class="_duration"></dd>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@stop

@section('custom_js')
<!-- fullcalendar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="{{asset('admin/plugins/fullcalendar-bootstrap/main.min.js')}}"></script>

<script>
    $(document).ready(function () {
        var calendar = $('#calendar').fullCalendar({
            headerToolbar: {
              start: 'title',
              center: '',
              end: 'today prev,next'
            },
            editable: true,
            events: [
                    @foreach($schedules as $schedule)
                        {
                            id: '<?= $schedule["id"] ?>',
                            title: '<?= $schedule["name"] ?>',
                            start: '<?= $schedule["date"] ?> <?= $schedule["start"] ?>',
                            end: '<?= $schedule["date"] ?> <?= $schedule["end"] ?>',
                            date: '<?= $schedule["date"] ?>',
                            duration: '<?= $schedule["duration"] ?>',
                            status: '<?= $schedule["status"] ?>',
                            backgroundColor: '<?= $schedule["status"] == 1 ? "#3dc931" : "" ?>',
                            borderColor: '<?= $schedule["status"] == 1 ? "#3dc931" : "" ?>',
                            telephone: '<?= $schedule["telephone"] ?>',
                            email: '<?= $schedule["email"] ?>',
                            address: '<?= $schedule["address"] ?>',
                        },
                    @endforeach
                ],
            displayEventTime: false,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            eventClick: function (event) {
                // console.log('event >>>>', event)
                if(event.status == 0) {
                    if(confirm("Do you want to accept this request? Cancel will reject the request!")) {
                        console.log('event >>>> accept')
                        $.ajax({
                            type: "put",
                            url: '{{route('schedule_request')}}',
                            data: {
                                id: event.id,
                                status: 1,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                alert("Request accepted");
                                location.reload();
                            }
                        });
                    } 
                    else {
                        console.log('event >>>> reject')
                        $.ajax({
                            type: "put",
                            url: '{{route('schedule_request')}}',
                            data: {
                                id: event.id,
                                status: 0,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                alert("Request rejected");
                            }
                        });
                    }
                }
                else {
                    $('._name').text(event.title);
                    $('._telephone').text(event.telephone);
                    $('._email').text(event.email);
                    $('._address').text(event.address);
                    $('._duration').text(event.date+' '+event.duration);

                    $('#event-modal').modal('show')
                }
            }
        });
        $('.fc-icon-left-single-arrow').text('❮').css('font-size', '16px');
        $('.fc-icon-right-single-arrow').text('❯').css('font-size', '16px');
    });
</script>
@stop
