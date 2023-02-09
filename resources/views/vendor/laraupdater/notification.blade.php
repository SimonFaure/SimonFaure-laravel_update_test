<div id="update_notification" class="toast" style="display:none; position: absolute; bottom: 10px; right: 10px;">
    <div class="toast-header">
        <strong class="me-auto">{{trans("laraupdater.Update_Available")}}</strong>
        <span id="update_version" class="badge rounded-pill bg-info text-dark"></span>
        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
    </div>
    <div class="toast-body">
        <span id="update_description"></span>
        <hr>
        <button type="button" onclick="update();" class="btn btn-info btn-sm update_btn">{{trans('laraupdater.Update_Now')}}</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: 'updater.check',
            async: false,
            success: function(response) {
                if (response != '') {
                    $('#update_version').text(response.version);
                    $('#update_description').text(response.description);
                    $('#update_notification').show();
                }
            }
        });
    });

    function update() {
        $("#update_description").show();
        $(".update_btn").html('{{trans("laraupdater.Updating")}}');
        $.ajax({
            type: 'GET',
            url: 'updater.update',
            success: function(response) {
                if (response != '') {
                    $('#update_description').append(response);
                    $(".update_btn").html('{{trans("laraupdater.Updated")}}');
                    $(".update_btn").attr("onclick", "");
                }
            },
            error: function(response) {
                if (response != '') {
                    $('#update_description').append(response);
                    $(".update_btn").html('{{trans("laraupdater.error_try_again")}}');
                }
            }
        });
    }
</script>