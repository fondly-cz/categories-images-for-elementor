<?php

use ElementorPro\Modules\DynamicTags\Module;
use ElementorPro\Modules\DynamicTags\Tags\Base\Data_Tag;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class CategoryImageTag extends Data_Tag
{

	public function get_name()
	{
		return 'category-image';
	}

	public function get_title()
	{
		return esc_html__('Category Image', 'categories-images-for-elementor');
	}

	public function get_group()
	{
		return Module::ARCHIVE_GROUP;
	}

	public function get_categories()
	{
		return [Module::IMAGE_CATEGORY, Module::MEDIA_CATEGORY, Module::URL_CATEGORY];
	}

	public function get_value(array $options = [])
	{
		global $wp_query;

		$term_taxonomy_id = $wp_query->loop_term->term_taxonomy_id;

		$thumbnail_id = z_taxonomy_image_id($term_taxonomy_id);

		$image_data = "";

		if ($thumbnail_id) {
			$image_data = [
				'id' => $thumbnail_id,
				'url' => z_taxonomy_image_url($term_taxonomy_id),
			];
		} else {
			// TODO maybe add fallback image
			//$image_data = $this->get_settings('fallback');
		}
		return $image_data;
	}
}
