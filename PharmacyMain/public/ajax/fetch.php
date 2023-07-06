
<?php  
$b_num = $_POST['b_num'];
$h_id = $_POST['h_id'];
if($b_num != 0) {  ?>
<p class="lead">Enter the name/number of the buildings </p>
<?php for($i=1;$i<=$b_num;$i++){ ?>
    <form id="my-form">
    <? @csrf_field() ?>
    <div class="form-group">
    <?php echo("Hostel no.".$i) ?><input type="text" class="form-control" id="b_num" placeholder="hostel name/number" name="b_num">
    <input type="hidden" value="<?php $i ?>" name="building_number">
    </div>
<?php } ?>
<?php } ?>
<input type="hidden" value="<?php $h_id ?>" name="hostel_id">
<p class="lead">
        <button class="btn btn-primary" id="submit" type="submit">Submit</button>
</p>
</form>
