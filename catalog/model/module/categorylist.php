<?php
class ModelModuleCategoryList extends Model {

	public function getCategories($limit = 0) {
		$category_data = $this->cache->get('categorylist.' . (int)$this->config->get('config_store_id') . '.' . (int)$this->config->get('config_language_id') . '.' . (int)$limit);

		if(!$category_data) {
			$sql = "SELECT DISTINCT c.category_id, cd.name, c.image FROM " . DB_PREFIX . "category c";
			$sql .= " LEFT JOIN " . DB_PREFIX . "category_description cd USING(category_id) ";
			$sql .= " WHERE c.parent_id = 0 AND cd.language_id =" . (int)$this->config->get("config_language_id") . " ";
			$sql .= " ORDER BY c.sort_order";
			if((int)$limit > 0) {
				$sql .= " LIMIT " . (int)$limit;
			}
			$query = $this->db->query($sql);
			$category_data = $query->rows;

			$this->cache->set('categorylist.' . (int)$this->config->get('config_store_id') . '.' . (int)$this->config->get('config_language_id') . '.' . (int)$limit, $category_data);
		}

		return $category_data;
	}
}

?>