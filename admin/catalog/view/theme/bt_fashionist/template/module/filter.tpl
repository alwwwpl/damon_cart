<div class="boss_filter bt-box">
  <div class="box-heading"><span><?php echo $heading_title; ?></span></div>
  <div class="list">
    <?php foreach ($filter_groups as $filter_group) { ?>
    <a class="title"><?php echo $filter_group['name']; ?></a>
    <div class="">
      <div id="filter-group<?php echo $filter_group['filter_group_id']; ?>">
        <?php foreach ($filter_group['filter'] as $filter) { ?>
        <?php if (in_array($filter['filter_id'], $filter_category)) { ?>
        <label class="checkbox">
          <input name="filter[]" type="checkbox" value="<?php echo $filter['filter_id']; ?>" checked="checked" />
          <?php echo $filter['name']; ?></label>
        <?php } else { ?>
        <label class="checkbox">
          <input name="filter[]" type="checkbox" value="<?php echo $filter['filter_id']; ?>" />
          <?php echo $filter['name']; ?></label>
        <?php } ?>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
  </div>
  <div class="text-left">
    <button type="button" id="button-filter" class="btn btn-shopping"><?php echo $button_filter; ?></button>
  </div>
</div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	filter = [];
	
	$('input[name^=\'filter\']:checked').each(function(element) {
		filter.push(this.value);
	});
	
	location = '<?php echo $action; ?>&filter=' + filter.join(',');
});
//--></script> 
