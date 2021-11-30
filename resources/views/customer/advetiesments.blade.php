<style type="text/css">
    .vendor-card {
        cursor: pointer;
    }
</style>
<div class="main-content-column">
    <div class="tabs-wrapper">
        <div class="tabs">
            <div class="tab">
                <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
                <!-- <label for="tab-1" class="tab-label">****************** New ****************** </label> -->
                <!--style="text-align:center" position="relative"-->
                <label for="tab-1" class="tab-label"  >     DONT MISS YOUR BEST CHOICE      </label>
                <div class="tab-content">
                    @foreach($advetiesments as $advetiesment)
                        <div class="vendor-card" onclick="openModal(title = '{{ $advetiesment->title }}', content = '{{ $advetiesment->content }}', image = '{{asset($advetiesment->image)}}')">
                            <div class="vendor-card__slider">
                                <div class="day-block">Click Here!</div>
                                <img src="{{asset($advetiesment->image)}}" />
                            </div>
                            <div class="vendor-card__content">
                                <!-- <div class="reviews-block">
                                    <span class="reviews-block__icon">*****</span>
                                    <span class="reviews-block__text">{{ $advetiesment->vendor->reviews->count() }} Reviews</span>
                                </div> -->

                                <div class="location-block text-left">
                                    <span class="s5">{{ $advetiesment->title }}</span>
                                    <span class="s7"><small>{{ $advetiesment->content }}</small></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ad-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <img src="" id="modal-image" class="img-fluid img-thumbnail" />
                    </div>
                    <div class="col-12">
                        <p class="mt-2" id="modal-content"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function openModal(title, content, image) {
        $('#modal-title').text(title);
        $('#modal-content').text(content);
        $('#modal-image').attr('src', image);

        $('#ad-modal').modal('show');
    }
</script>