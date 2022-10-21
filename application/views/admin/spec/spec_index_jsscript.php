<script type="text/javascript">
$('.spec_message').hide();
$('.editspec').on('click', function(event) {
  var id = $(this).attr('data-id');
  $.ajax({
    url: "<?php echo base_url() . 'admin/spec/editspecvalue/' ?>",
    type: "post",
    data: {
      "id": id,
      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    },
    success: function(response) {
      var data = JSON.parse(response);
      console.log(data);
      if (data != 'false') {
        $('.modal-title').text(data.modaltitle + ': ' + id);
        // spec_values
        // {id: '4', spvid: '7', spec_name: 'color', spec_value
        var spec_values = data.spec_values;
        var specItems = '';
        var url_post = "<?php echo base_url() . 'admin/spec/updatespecvalue' ?>";

        $('.spec_container .spec_forms').remove();
        var specItems = buildForm(id, spec_values, url_post);
        $('.spec_container').append(specItems);
        $('#editSpecValueModal').modal('show');

        $('#editSpecValueForm #submit').on('click', function(event) {
          event.preventDefault();
          var form = $(this).closest('#editSpecValueForm');
          var url = form.attr('action');
          var formvalues = form.serialize();

          $.post(url, formvalues, function() {
            $('.spec_message').show();
            $('.spec_message').text('đã cập nhật thông tin');
          }).fail(function(response) {
            alert(response.responseText);
          });
          return false;
        });
      }
    }
  })
});

function buildForm(specid, spec_values, url_post) {
  var specItems = '';
  $.each(spec_values, function(index, val) {
    // spec_values
    // {id: '4', spvid: '7', spec_name: 'color', spec_value
    specItems += '<form id="editSpecValueForm" class="row spec_forms" action="' + url_post + '" method="post">';
    specItems +=
      '<input name="<?php echo $this->security->get_csrf_token_name(); ?>" type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>">';
    specItems += '<input name="spvid" type="hidden" value="' + val[
      'spvid'] + '">';
    specItems += '<input name="spec_id" id="spec_id" type="hidden" value="' + specid + '">';
    specItems += '<div class ="col-md-3 col-sm-12" >';
    specItems += '<label class ="form-control model_name">' + val['model_name'] +
      '</label>';
    specItems += '</div>';
    specItems += '<div class ="col-md-3 col-sm-12" >';
    specItems += '<label class ="form-control spec_name">' + val['spec_name'] +
      '</label>';
    specItems += '</div>';
    specItems += '<div class="col-md-3 col-sm-12">';
    specItems += '<input name = "spec_value_name" id = "spec_value_name" class="form-control" value="' + val[
      'spec_value_name'] + '">';
    specItems += '</div> ';
    specItems += '<div class="col-md-3 col-sm-12">';
    specItems +=
      '<button id="submit" type="button" class="btn btn-primary">Cập nhật</button>';
    specItems += '</div>';
    specItems += "</form>";
  });
  return specItems;
}

$('.spec-delete').on('click', function() {
  var id = $(this).attr('data-id');
  if (confirm('Bạn có muốn xoá id ' + id + '?')) {
    $.ajax({
      url: "<?=base_url() . 'admin/spec/delete_spec/'?>" + id,
      type: "post",
      data: {
        "delete_id": id,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
      },
      success: function(response) {
        if (response == 'succeed') {
          location.reload();
        } else {
          alert('lỗi xoá spec');
        }
      }
    });
  }
});
</script>