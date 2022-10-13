$(document).ready(function(){
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  });

  let ids = [];

  $("#remove-endpoints").click(function(){
    ids = [];

    $("input[name='endpoints']").each(function(){
      if ($(this).prop("checked")) {
        if (!ids.includes($(this).val())) {
          ids.push($(this).val());
        }
      }
    });

    if (ids.length > 0) {
      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, remove it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax
          ({
              type: "DELETE",
              url: 'endpoints/' + ids.toString(),
              async: false,
              data: { _token: "{{ csrf_token() }}" },
              success: function () {
                window.location.reload();
              }
          });
        } else {
          $("input[name='endpoints']").each(function(){
            $(this).prop('checked', false);
          });
        }
      });
    }
  });
});