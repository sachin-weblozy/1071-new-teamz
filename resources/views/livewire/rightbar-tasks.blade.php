<div class="p-2">
    @forelse($tasks as $task)
    <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
        <p class="text-muted mb-0">{{ $task->title }}</p>
    </a>

    @empty 
    No Tasks Found
    @endforelse

    <div class="text-center pt-2">
        <a href="javascript: void(0);" class="btn btn-primary btn-sm">Show All</a>
    </div>
    <script>
        $(document).ready(function(){
        $(".checktask").click(function(){
            var task_id = $(this).closest('.login-one-inputs').find('.taskid').val();
            var stats = $(this).closest('.login-one-inputs').find('.checktask').is(':checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/update-taskstatus",
                data: {
                    'task_id': task_id,
                    'status': stats,
                },
                success: function(response){
                    // window.location.reload();
                    // swal(
                    //     'Success',
                    //     response.status,
                    //     'success'
                    // );
                }
            });
        });
    });
    </script>
</div>