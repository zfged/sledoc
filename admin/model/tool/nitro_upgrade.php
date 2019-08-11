<?php
class ModelToolNitroUpgrade extends ModelToolNitro {

  public function run_upgrade() {
    // NitroPack 1.x -> NitroPack 2.0
    $this->rescue_amazon_persistence();
    $this->rescue_rackspace_persistence();
    $this->rescue_ftp_persistence();
  }

  public function rescue_amazon_persistence() {
    $exists_query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "nitro_amazon_files'");
    if ($exists_query->num_rows == 0) return;

    $this->cdn_init_db();

    $this->db->query("INSERT INTO `" . DB_PREFIX . "nitro_cdn_files` SELECT '' as id, `file`, `realpath`, '1' as cdn, `size`, `uploaded` FROM `" . DB_PREFIX . "nitro_amazon_files`");

    $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "nitro_amazon_files`");
  }

  public function rescue_rackspace_persistence() {
    $this->loadCDN();

    $persistence = getRackspacePersistence();

    $this->cdn_init_db();

    foreach ($persistence as $realpath) {
      if (!file_exists($realpath)) continue;

      $file = substr($realpath, strlen(NITRO_SITE_ROOT));
      $size = filesize($realpath);

      $this->db->query("INSERT INTO `" . DB_PREFIX . "nitro_cdn_files` SET `file` = '" . trim($file) . "', `realpath` = '" . trim($realpath) . "', cdn = '2', `size` = " . $size . ", `uploaded` = 1");
    }

    if (is_writable(NITRO_RACKSPACE_PERSISTENCE)) {
      unlink(NITRO_RACKSPACE_PERSISTENCE);
    } else if (file_exists(NITRO_RACKSPACE_PERSISTENCE)) {
      $this->session->data['error'] = '<strong>Important:</strong> Please remove the file ' . NITRO_RACKSPACE_PERSISTENCE;
    }
  }

  public function rescue_ftp_persistence() {
    $this->loadCDN();

    $persistence = getFTPPersistence();

    $this->cdn_init_db();

    foreach ($persistence as $realpath) {
      if (!file_exists($realpath)) continue;

      $file = substr($realpath, strlen(NITRO_SITE_ROOT));
      $size = filesize($realpath);

      $this->db->query("INSERT INTO `" . DB_PREFIX . "nitro_cdn_files` SET `file` = '" . trim($file) . "', `realpath` = '" . trim($realpath) . "', cdn = '3', `size` = " . $size . ", `uploaded` = 1");
    }

    if (is_writable(NITRO_FTP_PERSISTENCE)) {
      unlink(NITRO_FTP_PERSISTENCE);
    } else if (file_exists(NITRO_FTP_PERSISTENCE)) {
      $this->session->data['error'] = '<strong>Important:</strong> Please remove the file ' . NITRO_FTP_PERSISTENCE;
    }
  }

}