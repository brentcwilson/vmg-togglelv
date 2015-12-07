<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * VMG GTM Utilities
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Accessory
 * @author		Brent C. Wilson
 * @link		http://www.vectormediagroup.com
 */
 
class Vmg_togglelv_acc {
	
	public $name			= 'VMG Toggle Low Variables';
	public $id				= 'vmg_togglelv';
	public $version			= '1.0';
	public $description		= 'Toggle visibility of Low Variables';
	public $sections		= array();
	
	private $EE;
	private $hideVarsAt     = 3; // Hide LVs when there are >= this number
	private $classMinimized = 'vmg-togglelv-minimized'; // Class used to control LV visibility
	
	/**
	 * Do the magic
	 */
	public function set_sections()
	{
		$this->EE =& get_instance();

		$js = <<<EOJS
<style>
	#low-varlist tbody td:first-child .low-label {
		cursor: pointer;
	}
	#low-varlist .vmg-togglelv-minimized td:nth-child(2),
	#low-varlist .placeholder {
		display: none;
	}
	#low-varlist .vmg-togglelv-minimized .placeholder {
		display: table-cell;
	}
</style>
<script type='text/javascript' charset='utf-8'>
	$(document).ready(function() {
		var hideVarsAt = {$this->hideVarsAt};
		var classMinimized = '{$this->classMinimized}';

		var body = $('#low-varlist tbody');
		var rows = $('tr', body);
		var head = $('#low-varlist thead');

		if (rows.length >= hideVarsAt) {
			// Hide me!
			rows.add(head).addClass(classMinimized);

			// Placeholder so the cell dimensions don't change
			$('td:nth-child(2)', body).after('<td class="placeholder"/>');

			// Click event on LV label for toggling visibility
			rows.on('click', '.low-label', function(e) {
				$(this).closest('tr').toggleClass(classMinimized);
			});

			// Apply directly to the forehead!
			// Apply directly to the forehead!
			// Apply directly to the forehead!
			head.on('click', function(e) {
				if ($(this).hasClass(classMinimized)) {
					$(this).add(rows).removeClass(classMinimized);
				} else {
					$(this).add(rows).addClass(classMinimized).find('tr');
				}
			});
		}
	});
</script>
EOJS;
		$this->EE->cp->add_to_head($js);
	}
	
}
 
/* End of file acc.vmg_togglelv.php */
/* Location: /system/expressionengine/third_party/vmg_togglelv/acc.vmg_togglelv.php */