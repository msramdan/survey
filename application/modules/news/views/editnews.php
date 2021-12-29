<div class="panel">
  <div class="panel-body">
    <?php echo form_open_multipart('news/updatenews/'.$news->id); ?>
      <div class="col-lg-8">
       <div class="form-group">
        <label for="exampleInputEmail1">Judul Konten</label>
        <input type="text" class="form-control" name="judul" placeholder="Judul" value="<?php echo $news->judul ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Konten</label>
        <textarea name="konten" class="form-control" rows="15" style="resize: vertical;"><?php echo $news->konten ?></textarea>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-group">
        <label for="exampleInputFile">Gambar Konten ( Potrait Image Recomended )</label> 
        <input type="hidden" name="old_image"  value="<?php echo $news->img ?>">
        <input type="file" name="image" onchange="readURL(this);">
      </div>
      <div class="display-img">
        <img id="img" src="<?php echo base_url('assets/img/').$news->img ?>" style="width: 100%" />
      </div>
    </div>
  </div>
  <div class="panel-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
  </form>
</div>
</div>

<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#img')
        .attr('src', e.target.result)
        .attr('hidden', false)
        .width(auto)
        .height(auto);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>