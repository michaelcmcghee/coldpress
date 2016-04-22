<?php

return array(
	'name' => 'Coldpress',
	'version' =>'1.0.0',
	'author' =>'Michael McGhee',
	'author_url' => 'http://www.papercutinteractive.com/',
	'description' => 'Creates a folder, coldpressed_img, in the root directory that contains a compressed version of the requested image. Coldpress works on any jpg, gif, or png files.',
	'namespace' => 'Coldpress\Coldpress',
	'plugin.usage' => array(
		'description' => 'Place the coldpress tag pair around a field with the type of File (images only).',
		'example' => '{exp:coldpress}{homepage_image}{/exp:coldpress}'
	)
);
/* End of file addon.setup.php */ 
/* Location: /__ee_admin/user/addons/coldpress/addon.setup.php */
?>